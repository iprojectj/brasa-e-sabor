{
	"info": {
		"_postman_id": "437e81e0-9c5f-4f7f-96e7-944de796f347",
		"name": "invictuspay.app.br Public API - 1.0",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json",
		"_exporter_id": "3841384"
	},
	"item": [
		{
			"name": "Transações",
			"item": [
				{
					"name": "Request de pagamento",
					"request": {
						"method": "POST",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n  \"amount\": 15000,\r\n  \"offer_hash\": \"7becb\", //hash da oferta\r\n  \"payment_method\": \"pix\", // credit_card, billet, pix\r\n  \"card\": {\r\n    \"number\": \"4111 1111 1111 1111\",\r\n    \"holder_name\": \"Teste Holder name\",\r\n    \"exp_month\": 12,\r\n    \"exp_year\": 2025,\r\n    \"cvv\": \"123\"\r\n  },\r\n  \"customer\": {\r\n    \"name\": \"Customer name\", //obrigatorio\r\n    \"email\": \"email@email.com\", //obrigatorio\r\n    \"phone_number\": \"21999999999\", //obrigatorio\r\n    \"document\": \"09115751031\", //obrigatorio\r\n    \"street_name\": \"Nome da Rua\",\r\n    \"number\": \"sn\",\r\n    \"complement\": \"Lt19 Qd 134\",\r\n    \"neighborhood\": \"Centro\",\r\n    \"city\": \"Itaguaí\",\r\n    \"state\": \"RJ\",\r\n    \"zip_code\": \"23822180\"\r\n  },\r\n  \"cart\": [\r\n    {\r\n      \"product_hash\": \"7tjdfkshdv\", //hash do produto\r\n      \"title\": \"Produto Teste API Publica\",\r\n      \"cover\": null,\r\n      \"price\": 10000,\r\n      \"quantity\": 1,\r\n      \"operation_type\": 1, // 1- venda principal / 2- orderbump / 3- upsell\r\n      \"tangible\": false\r\n    }\r\n  ],\r\n  \"installments\": 1,\r\n  \"expire_in_days\": 1,\r\n  \"transaction_origin\": \"api\",\r\n  \"tracking\": {\r\n    \"src\": \"\",\r\n    \"utm_source\": \"\",\r\n    \"utm_medium\": \"\",\r\n    \"utm_campaign\": \"\",\r\n    \"utm_term\": \"\",\r\n    \"utm_content\": \"\"\r\n  }\r\n  //,\"postback_url\": \"\", // URL PARA RECEBER ATUALIZAÇÃO DAS TRANSAÇÕES\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/transactions?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transactions"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Reembolso",
					"request": {
						"method": "POST",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n    \"amount\": 10000,\r\n    \"payment_method\": \"credit_card\",\r\n    \"card\": {\r\n        \"number\": \"4111 1111 1111 1111\",\r\n        \"holder_name\": \"Teste Holder name\",\r\n        \"exp_month\": 12,\r\n        \"exp_year\": 23,\r\n        \"cvv\": 123\r\n    },\r\n    \"customer\": {\r\n        \"name\": \"Fabiano Lacerda\",\r\n        \"email\": \"fbinformatica.info@gmail.com\",\r\n        \"phone_number\": \"21975794613\",\r\n        \"document\": \"12317117792\",\r\n        \"street_name\": \"Nome da Rua\",\r\n        \"number\": \"sn\",\r\n        \"complement\": \"Lt19 Qd 134\",\r\n        \"neighborhood\": \"Centro\",\r\n        \"city\": \"Itaguaí\",\r\n        \"state\": \"RJ\"\r\n    },\r\n    \"cart\": [\r\n        {\r\n            \"id\": \"1\",\r\n            \"title\": \"Produto Teste API Publica\",\r\n            \"cover\": null,\r\n            \"price\": 10000,\r\n            \"quantity\": 1,\r\n            \"operation_type\": 1,\r\n            \"tangible\": false\r\n        }\r\n    ],\r\n    \"installments\": 12,\r\n    \"expire_in_days\": 1,\r\n    \"postback_url\": \"https://enf8p6q9i44zv.x.pipedream.net/\" // URL PARA RECEBER ATUALIZAÇÃO DAS TRANSAÇÕES\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/transactions/:hash/refund?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transactions",
								":hash",
								"refund"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							],
							"variable": [
								{
									"key": "hash",
									"value": "2tlgsdix25"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Listar transações",
					"protocolProfileBehavior": {
						"disableBodyPruning": true
					},
					"request": {
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/transactions?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transactions"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Consultar transação",
					"protocolProfileBehavior": {
						"disableBodyPruning": true
					},
					"request": {
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/transactions/:hash?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transactions",
								":hash"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							],
							"variable": [
								{
									"key": "hash",
									"value": "fnieypcwky"
								}
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Produtos e Ofertas",
			"item": [
				{
					"name": "Ofertas",
					"item": [
						{
							"name": "Cadastrar oferta",
							"request": {
								"method": "POST",
								"header": [
									{
										"key": "Accept",
										"value": "application/json",
										"type": "text"
									}
								],
								"body": {
									"mode": "raw",
									"raw": "{\r\n    \"title\": \"Titulo da oferta\",\r\n    \"cover\": \"https://d2zt257clo56ws.cloudfront.net/450215437/products/gsjkwtfeevrqh767h7dtspyu1\",\r\n    \"amount\": 1000 // inteiro em centavos\r\n}",
									"options": {
										"raw": {
											"language": "json"
										}
									}
								},
								"url": {
									"raw": "{{endpoint}}/public/v1/products/:hash/offers?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"host": [
										"{{endpoint}}"
									],
									"path": [
										"public",
										"v1",
										"products",
										":hash",
										"offers"
									],
									"query": [
										{
											"key": "api_token",
											"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
										}
									],
									"variable": [
										{
											"key": "hash",
											"value": "jrhjcj6hja"
										}
									]
								}
							},
							"response": []
						},
						{
							"name": "Atualizar uma oferta",
							"request": {
								"method": "PUT",
								"header": [
									{
										"key": "Accept",
										"value": "application/json",
										"type": "text"
									}
								],
								"body": {
									"mode": "raw",
									"raw": "{\r\n    \"title\": \"Titulo da oferta\",\r\n    \"cover\": \"https://d2zt257clo56ws.cloudfront.net/450215437/products/gsjkwtfeevrqh767h7dtspyu1\",\r\n    \"amount\": 2500 // inteiro em centavos\r\n}",
									"options": {
										"raw": {
											"language": "json"
										}
									}
								},
								"url": {
									"raw": "{{endpoint}}/public/v1/products/:hash/offers?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"host": [
										"{{endpoint}}"
									],
									"path": [
										"public",
										"v1",
										"products",
										":hash",
										"offers"
									],
									"query": [
										{
											"key": "api_token",
											"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
										}
									],
									"variable": [
										{
											"key": "hash",
											"value": "wxxrw"
										}
									]
								}
							},
							"response": []
						}
					]
				},
				{
					"name": "Lista produtos",
					"request": {
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/products?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"products"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Consultar produto",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS5mb3JucGF5LmNvbS9hcGkvbWFzdGVyL2F1dGgvbG9naW5CeVVzZXIiLCJpYXQiOjE3MDU1MTk3MzAsImV4cCI6MTcwODExMTczMCwibmJmIjoxNzA1NTE5NzMwLCJqdGkiOiJvR3dCY09vb1lRWmNSNlJYIiwic3ViIjoiNjEzIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.81NVBGVnVdImrhmKP40NIZl8k5yMibM19LTEzltziuA",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/products/:hash?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"products",
								":hash"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							],
							"variable": [
								{
									"key": "hash",
									"value": "qqiwj1isv0"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Listar categorias de produtos",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaS5mb3JucGF5LmNvbS9hcGkvbWFzdGVyL2F1dGgvbG9naW5CeVVzZXIiLCJpYXQiOjE3MDU1MTk3MzAsImV4cCI6MTcwODExMTczMCwibmJmIjoxNzA1NTE5NzMwLCJqdGkiOiJvR3dCY09vb1lRWmNSNlJYIiwic3ViIjoiNjEzIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.81NVBGVnVdImrhmKP40NIZl8k5yMibM19LTEzltziuA",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/products/categories?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"products",
								"categories"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Cadastrar produto",
					"request": {
						"method": "POST",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n    \"title\": \"Titulo do produto\",\r\n    \"cover\": \"https://d2zt257clo56ws.cloudfront.net/450215437/products/gsjkwtfeevrqh767h7dtspyu1\",\r\n    \"sale_page\": \"https://google.com\",\r\n    \"payment_type\": 1, // 1 = Pagamento Único\r\n    \"product_type\": \"digital\", // digital, fisico \r\n    \"delivery_type\": 1, // 1 = Área da membros da plataforma, 2 = Área de membros externa\r\n    \"id_category\": 1, // consultar no endpoint /products/categories\r\n    \"amount\": 1000 // inteiro em centavos\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/products?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"products"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Atualizar produto",
					"request": {
						"method": "PUT",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n    \"title\": \"Titulo do produto atualizado\",\r\n    \"cover\": \"https://d2zt257clo56ws.cloudfront.net/450215437/products/gsjkwtfeevrqh767h7dtspyu1\",\r\n    \"sale_page\": \"https://google.com\"\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/products/:hash?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"products",
								":hash"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							],
							"variable": [
								{
									"key": "hash",
									"value": "jrhjcj6hja"
								}
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Saldo",
			"item": [
				{
					"name": "Consultar saldo",
					"request": {
						"auth": {
							"type": "noauth"
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/balance?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"balance"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								}
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Saque",
			"item": [
				{
					"name": "Solicitar saque",
					"request": {
						"method": "POST",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/transfers?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr&amount=1001",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transfers"
							],
							"query": [
								{
									"key": "api_token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
								},
								{
									"key": "amount",
									"value": "1001"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Consultar uma solicitação de saque",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/transfers/:transferHash",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transfers",
								":transferHash"
							],
							"variable": [
								{
									"key": "transferHash",
									"value": "1vdtwum6lf"
								}
							]
						}
					},
					"response": []
				},
				{
					"name": "Consultar uma solicitação de saque",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/transfers/:transferHash",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"transfers",
								":transferHash"
							],
							"variable": [
								{
									"key": "transferHash",
									"value": "1vdtwum6lf"
								}
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Contas bancárias",
			"item": [
				{
					"name": "Cadastrar dados bancários",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"type": "string"
								}
							]
						},
						"method": "POST",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Content-Type",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n    \"type\": \"pix\",\r\n    \"pix_key_type\": \"document\",\r\n    \"pix_key\": \"48304700000104\"\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/bank-accounts",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"bank-accounts"
							]
						}
					},
					"response": []
				},
				{
					"name": "Listar dados bancários",
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Content-Type",
								"value": "application/json",
								"type": "text"
							}
						],
						"url": {
							"raw": "{{endpoint}}/public/v1/bank-accounts",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"bank-accounts"
							]
						}
					},
					"response": []
				},
				{
					"name": "Buscar conta",
					"protocolProfileBehavior": {
						"disableBodyPruning": true
					},
					"request": {
						"auth": {
							"type": "bearer",
							"bearer": [
								{
									"key": "token",
									"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
									"type": "string"
								}
							]
						},
						"method": "GET",
						"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Content-Type",
								"value": "application/json",
								"type": "text"
							}
						],
						"body": {
							"mode": "raw",
							"raw": "{\r\n    \"type\": \"pix\",\r\n    \"pix_key_type\": \"document\",\r\n    \"pix_key\": \"0000000000\"\r\n}",
							"options": {
								"raw": {
									"language": "json"
								}
							}
						},
						"url": {
							"raw": "{{endpoint}}/public/v1/bank-accounts/:bankAccountHash",
							"host": [
								"{{endpoint}}"
							],
							"path": [
								"public",
								"v1",
								"bank-accounts",
								":bankAccountHash"
							],
							"variable": [
								{
									"key": "bankAccountHash",
									"value": "n2cviv3bvy"
								}
							]
						}
					},
					"response": []
				}
			]
		},
		{
			"name": "Calculo das parcelas",
			"request": {
				"method": "GET",
				"header": [
					{
						"key": "Accept",
						"value": "application/json",
						"type": "text"
					}
				],
				"url": {
					"raw": "{{endpoint}}/public/v1/installments?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr&amount=10000&interest_type=simple",
					"host": [
						"{{endpoint}}"
					],
					"path": [
						"public",
						"v1",
						"installments"
					],
					"query": [
						{
							"key": "api_token",
							"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
						},
						{
							"key": "amount",
							"value": "10000"
						},
						{
							"key": "interest_type",
							"value": "simple"
						}
					]
				}
			},
			"response": []
		},
		{
			"name": "Iniciar Checkout",
			"request": {
				"method": "GET",
				"header": [],
				"url": {
					"raw": "{{endpoint}}/public/v1/checkout/dv5mv",
					"host": [
						"{{endpoint}}"
					],
					"path": [
						"public",
						"v1",
						"checkout",
						"dv5mv"
					]
				}
			},
			"response": []
		},
		{
			"name": "Meus dados",
			"request": {
				"method": "GET",
				"header": [
					{
						"key": "Accept",
						"value": "application/json",
						"type": "text"
					}
				],
				"url": {
					"raw": "{{endpoint}}/public/v1/me?api_token=4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr",
					"host": [
						"{{endpoint}}"
					],
					"path": [
						"public",
						"v1",
						"me"
					],
					"query": [
						{
							"key": "api_token",
							"value": "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr"
						}
					]
				}
			},
			"response": []
		}
	],
	"event": [
		{
			"listen": "prerequest",
			"script": {
				"type": "text/javascript",
				"exec": [
					""
				]
			}
		},
		{
			"listen": "test",
			"script": {
				"type": "text/javascript",
				"exec": [
					""
				]
			}
		}
	],
	"variable": [
		{
			"key": "endpoint",
			"value": "https://api.invictuspay.app.br/api"
		},
		{
			"key": "api_token",
			"value": ""
		}
	]
}