document.addEventListener('DOMContentLoaded', () => {
  const donationButtons = document.querySelectorAll('.donation-button');

  // modal elements
  const modal = document.getElementById('pix-modal');
  const modalBackdrop = modal && modal.querySelector('.modal-backdrop');
  const modalPanel = document.querySelector('.modal-panel');
  const modalClose = document.getElementById('modal-close');
  const modalQrcode = document.getElementById('modal-qrcode');
  const modalPixText = document.getElementById('modal-pix-text');
  const modalBtnCopy = document.getElementById('modal-btn-copy');
  const modalStatus = document.getElementById('modal-status');
  const modalAmount = document.getElementById('modal-amount');
  const modalTimer = document.getElementById('modal-timer');
  const modalSuccess = document.getElementById('modal-success');
  // countdown interval id
  let timerInterval = null;
  // copy button timeout id
  let copyTimeout = null;

  function startCountdown(start, timeout) {
    stopCountdown();
    const update = () => {
      const remaining = Math.max(0, timeout - (Date.now() - start));
      const mm = String(Math.floor(remaining / 60000)).padStart(2,'0');
      const ss = String(Math.floor((remaining % 60000)/1000)).padStart(2,'0');
      if (modalTimer) modalTimer.textContent = `${mm}:${ss}`;
      if (remaining <= 0) {
        stopCountdown();
        if (modalStatus) modalStatus.textContent = 'Expirado';
      }
    };
    update();
    timerInterval = setInterval(update, 1000);
  }

  function stopCountdown(){
    if (timerInterval) { clearInterval(timerInterval); timerInterval = null; }
  }

  // silent log helper (console only)
  function log(...args){ console.log(...args); }

  function openModal(){
    if (!modal) return;
    modal.style.display = 'flex';
    // allow CSS animation
    requestAnimationFrame(() => modal.classList.add('show'));
    modal.setAttribute('aria-hidden', 'false');
    modalSuccess.style.display = 'none';
    // Remove any unexpected buttons that might have been injected (e.g. 'ver tempo')
    try {
      const allowed = new Set(['modal-close','modal-btn-copy']);
      if (modalPanel) {
        const btns = modalPanel.querySelectorAll('button');
        btns.forEach(b => {
          const id = b.id || '';
          const txt = (b.textContent || '').trim().toLowerCase();
          if (!allowed.has(id) || /ver\s*tempo/i.test(txt)) {
            b.remove();
          }
        });
      }
    } catch (e) { /* ignore */ }

    // Observe modal panel for injected unwanted buttons and remove them
    if (modalPanel && !modalPanel.__watchingExtraButtons) {
      try {
        const mo = new MutationObserver(muts => {
          muts.forEach(m => {
            (m.addedNodes || []).forEach(n => {
              if (n && n.nodeType === 1 && n.nodeName === 'BUTTON') {
                const id = n.id || '';
                const txt = (n.textContent || '').trim().toLowerCase();
                if (!['modal-close','modal-btn-copy'].includes(id) || /ver\s*tempo/i.test(txt)) {
                  n.remove();
                }
              }
              // also check for buttons inside added elements
              if (n && n.querySelectorAll) {
                const inner = n.querySelectorAll('button');
                inner.forEach(b => {
                  const id = b.id || '';
                  const txt = (b.textContent || '').trim().toLowerCase();
                  if (!['modal-close','modal-btn-copy'].includes(id) || /ver\s*tempo/i.test(txt)) b.remove();
                });
              }
            });
          });
        });
        mo.observe(modalPanel, { childList: true, subtree: true });
        modalPanel.__watchingExtraButtons = true;
      } catch (e) { /* ignore */ }
    }
  // focus primary action shortly after opening
  setTimeout(() => { if (modalBtnCopy && typeof modalBtnCopy.focus === 'function') modalBtnCopy.focus(); }, 300);
  }
  function closeModal(){
    if (!modal) return;
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
  stopCountdown();
    // wait for animation then hide
    setTimeout(() => {
      modal.style.display = 'none';
      modalQrcode.innerHTML = '';
    }, 240);
  }

  modalClose && modalClose.addEventListener('click', closeModal);
  modalBackdrop && modalBackdrop.addEventListener('click', closeModal);

  async function copyToClipboard(text){
    try { await navigator.clipboard.writeText(text); log('Pix copiado'); return true; }
    catch(e){ log('Falha ao copiar', e && e.message ? e.message : e); return false; }
  }

  modalBtnCopy && modalBtnCopy.addEventListener('click', async () => {
    if (!modalBtnCopy) return;
    const originalText = modalBtnCopy.textContent;
    const ok = await copyToClipboard(modalPixText.value);
    if (ok) {
      // clear any previous timeout so it stays visible for full 5s after latest copy
      if (copyTimeout) { clearTimeout(copyTimeout); copyTimeout = null; }
      modalBtnCopy.textContent = 'CÓDIGO PIX COPIADO';
      copyTimeout = setTimeout(() => {
        modalBtnCopy.textContent = originalText;
        copyTimeout = null;
      }, 5000);
    }
  });

  donationButtons.forEach(btn => {
    btn.addEventListener('click', async () => {
      const reais = Number(btn.dataset.value || btn.textContent.replace(/[^0-9]/g,''));
      const amount_cents = Math.round(reais * 100);
  const clickTs = new Date().toISOString();

    // prepare UI
      openModal();
      modalQrcode.innerHTML = '';
      modalPixText.value = '';
  modalStatus.textContent = 'Gerando';
  log('Solicitando geração', amount_cents);

      try {
        const sentTs = new Date().toISOString();
        const resp = await fetch('/api/generate', {
          method: 'POST', headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ amount_cents, click_ts: clickTs })
        });
        const respReceivedTs = new Date().toISOString();
        const body = await resp.json();
        if (!body.ok) throw body;
        const { id, pixCode, pixSvg } = (body.data || {});
        if (!id || !pixCode) throw new Error('Resposta inválida do servidor');

  modalPixText.value = pixCode;
  if (modalAmount) modalAmount.textContent = (amount_cents/100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

        if (pixSvg && typeof pixSvg === 'string' && pixSvg.trim().length>0) {
          modalQrcode.innerHTML = pixSvg;
          // record render timestamp and send log
          const renderTs = new Date().toISOString();
          try {
            await fetch('/api/log', {
              method: 'POST', headers: {'Content-Type': 'application/json'},
              body: JSON.stringify({ pix: id || pixCode, clickTs, sentTs: sentTs || null, respTs: respReceivedTs || null, renderTs })
            });
          } catch (e) { console.warn('Falha ao enviar log de latência', e); }
        } else {
          modalQrcode.textContent = 'QR não disponível';
          const renderTs = new Date().toISOString();
          try { await fetch('/api/log', { method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({ pix: id || pixCode, clickTs, sentTs: sentTs || null, respTs: respReceivedTs || null, renderTs, note: 'QR não disponível' }) }); } catch(e){}
        }

  modalStatus.textContent = 'Aguardando pagamento';
  if (modalStatus) modalStatus.classList.add('blink');
  log('QR gerado, iniciando polling', id);

    // Polling
    const start = Date.now();
  const timeout = 30 * 60 * 1000; // 30 minutes
    // start a live countdown (1s)
    startCountdown(start, timeout);
        let done = false;

        const poll = async () => {
          if (done) return;
          if (Date.now() - start > timeout) {
            modalStatus.textContent = 'Expirado';
            log('Tempo esgotado');
            stopCountdown();
            return;
          }

          try {
            const sresp = await fetch(`/api/status?txid=${encodeURIComponent(id)}`);
            const sbody = await sresp.json();
            log('status', sbody);
            const status = sbody && (sbody.status || sbody.state || (sbody.data && sbody.data.status));
            if (status && String(status).toLowerCase() === 'paid') {
              done = true;
              modalStatus.textContent = 'Pago!';
              // stop blinking
              if (modalStatus) modalStatus.classList.remove('blink');
              modalSuccess.style.display = 'block';
              log('Pagamento detectado');
              stopCountdown();
              // close modal after short delay so user sees success
              setTimeout(() => closeModal(), 2500);
              return;
            }
          } catch (err) {
            log('Erro no polling', err && err.message ? err.message : err);
          }

          setTimeout(poll, 2500);
        };

        poll();
      } catch (err) {
        modalStatus.textContent = 'Erro';
        log('Erro', err && err.error ? JSON.stringify(err.error) : (err && err.message ? err.message : err));
      }
    });
  });
});
