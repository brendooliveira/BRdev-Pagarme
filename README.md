# BRdev-Pagarme
Api Pagarme V5

```bash
"brdev/pagarme": "1.2"
```

or run

```bash
composer require brdev/pagarme
```

#### 
```php
<?php
$pagarme = new BRdev\Pagarme\Client($token);

```

#### Created new costumer
```php
$user = $pagarme->costumer("Luciano hang","luciano2@outlook.com","108.383.820-29","CPF","15981070774");
$user->callback();
```

#### Get costumer
```php
$getUser = $pagarme->getCostumer($cusId);
$getUser->callback();
```

#### Update costumer
```php
$updateUser = $pagarme->UpdateCostumer($cusId,"Vinicius Nogueira","vinicius1@outlook.com","108.383.820-29","CPF","15981070774");
$updateUser->callback();
```

#### Created creditCard
```php
$creditCard = $pagarme->createdCreditCard($cusId,"5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-000","SP","itapetininga","Rua dos Bobos");
$creditCard->callback();
```

#### Created creditCard
```php
$getCreditCard = $pagarme->getCreditCard($cusId,$cardId);
$getCreditCard->callback();
```

#### Update creditCard
```php
$updateCreditCard = $pagarme->updateCreditCard($cusId,$cardId,"5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-200","SP","itapetininga","Rua dos Bobos");
$updateCreditCard->callback();
```

#### Renew creditCard
```php
$renewCreditCard = $pagarme->renewCreditCard($cusId,$cardId);
$renewCreditCard->callback();
```

#### Delete creditCard
```php
$deleteCreditCard = $pagarme->deleteCreditCard($cusId,$cardId);
$deleteCreditCard->callback();
```

#### Transaction creditCard
```php
$trasactionCredit = $pagarme->transactionCrediCard($cusId,$cardId,uniqid(),"test","10000","1",8);
$trasactionCredit->callback();
```

#### Transaction PIX
```php
$trasactionPIX = $pagarme->transactionPix($cusId,uniqid(),"testando","10000","1","800");
$trasactionPIX->callback();
```
#### Transaction Boleto
```php
$transactionBoleto = $pagarme->transactionBoleto("cus_---",uniqid(),"testando a api","1000","1");
$transactionBoleto->callback();
```

#### Transaction creditCardSplit
```php
$pagarme->transactionCrediCardSplit("cus_--","card_---",uniqid(),"testando split","1000","1","2","rp_---","5","rp_-----","95");
```

#### Transaction PixSplit
```php
$pagarme->transactionPixSplit("cus_---",uniqid(),"testando split","1000","1","800","rp_---","2","rp_---","98");
```

#### Transaction BoletoSplit
```php
$splitBoleto = $pagarme->transactionBoletoSplit("cus_----",uniqid(),"testando split","1000","1","rp_-----","2","rp_-----","100");
```

#### Get Order
```php
$getOrder = $pagarme->getOrder("or_----");
$getOrder->callback();
```

#### Closed Order
```php
$closeOrder = $pagarme->closeOrder("or_----","canceled");
$closeOrder->callback();
```

#### Chargeback
```php
$deleteCharge = $pagarme->deleteCharge("ch_------");
$closeOrder->callback();
```

#### created Recipients
```php
$createdRecipients = $pagarme->CreatedRecipients("Meu nome Jose","jose@hotmail.com","108.383.820-29","123","0001","12345","1");
$createdRecipients->callback();
```

#### Edit Recipients
```php
$EditRecipients = $pagarme->EditRecipients("rp_------","Jose Santos","jose@hotmail.com");
$EditRecipients->callback();
```

#### Get Recipients
```php
$EditRecipients = $pagarme->EditRecipients("rp_------","Jose Santos","jose@hotmail.com");
$EditRecipients->callback();
```

#### Edit Recipients Bank
```php
$EditRecipientsBank = $pagarme->EditRecipientBank("rp_-------","Jose Santos","108.383.820-29","260","0002","12345","1");
$EditRecipientsBank->callback();
```

#### Get Balance
```php
$getBalance = $pagarme->getBalance("rp_-----");
$getBalance->callback();
```

#### withdrawals
```php
$withdrawals = $pagarme->withdrawals("rp_------", "1000");
$withdrawals->callback();
```

#### Get withdrawals
```php
$GetWithdrawals = $pagarme->GetWithdrawals("rp_-------", "ID");
$GetWithdrawals->callback();
```

### Autor
---

<a href="https://github.com/brendooliveira">
 <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/98026621?v=4" width="100px;" alt=""/>
 <br />
 <sub><b>Brendo Oliveira</b></sub></a> <a href="https://github.com/brendooliveira" title="GitHub">🚀</a>


Feito com ❤️ por Brendo Oliveira 👋🏽 Entre em contato!


[![Linkedin Badge](https://img.shields.io/badge/-Brendo-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/brendooliveira/)](https://www.linkedin.com/in/brendooliveira/) 
[![Outlook Badge](https://img.shields.io/badge/-brendo.dev@outlook.com-blue?style=flat-square&logo=Gmail&logoColor=white&link=mailto:brendo.dev@outlook.com)](mailto:brendo.dev@outlook.com)
