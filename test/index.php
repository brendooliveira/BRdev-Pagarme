<?php

use BRdev\Pagarme\Client;

require __DIR__."/../vendor/autoload.php";

//---sk_test---

$token = "-----sk_test----";
$pagarme = new Client($token);


//$user = $pagarme->costumer("Luciano hang","luciano2@outlook.com","108.383.820-29","CPF","15981070774");

//$getUser = $pagarme->getCostumer($user->callback()->id);

//$updateUser = $pagarme->UpdateCostumer($user->callback()->id,"Vinicius Nogueira","vinicius1@outlook.com","108.383.820-29","CPF","15981070774");

//$creditCard = $pagarme->createdCreditCard("-----","5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-000","SP","itapetininga","Rua dos Bobos");

//$getCreditCard = $pagarme->getCreditCard("cus_id----","card_------");

//$updateCreditCard = $pagarme->updateCreditCard("cus_id----","card_------","5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-200","SP","itapetininga","Rua dos Bobos");

//$renewCreditCard = $pagarme->renewCreditCard("cus_id----","card_------");

//$deleteCreditCard = $pagarme->deleteCreditCard("cus_id----","card_------");

//$trasactionCredit = $pagarme->transactionCrediCard("cus_id----","card_------",uniqid(),"testando","10000","1",8);

//$trasactionPIX = $pagarme->transactionPix("cus_id----",uniqid(),"testando","10000","1","800");

//$boleto = $pagarme->transactionBoleto("cus_-------",uniqid(),"testando a api","1000","1");

//$getOrder = $pagarme->getOrder("or_-------");

//$closeOrder = $pagarme->closeOrder("or_-----");

//$deleteCharge = $pagarme->deleteCharge("ch_-----");

//$createdRecipients = $pagarme->CreatedRecipients("Meu nome Jose","jose@hotmail.com","108.383.820-29","123","0001","12345","1");

//$EditRecipients = $pagarme->EditRecipients("rp_-----","Jose Santos","jose@hotmail.com");

//$getRecipients = $pagarme->getRecipient("rp_-------");

//$EditRecipientsBank = $pagarme->EditRecipientBank("rp_-------","Jose Santos","108.383.820-29","260","0002","12345","1");

//$getBalance = $pagarme->getBalance("rp_-------");

//$withdrawals = $pagarme->withdrawals("rp_-------", "1000");

//$GetWithdrawals = $pagarme->GetWithdrawals("rp_-------", "ID");
//var_dump($withdrawals->callback());