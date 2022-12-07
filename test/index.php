<?php

use BRdev\Pagarme\Client;

require __DIR__."/../vendor/autoload.php";

$token = "---sk_test---";
$pagarme = new Client($token);

$user = $pagarme->costumer("Luciano hang","luciano2@outlook.com","108.383.820-29","CPF","15981070774");

//$getUser = $pagarme->getCostumer($user->callback()->id);

//$updateUser = $pagarme->UpdateCostumer($user->callback()->id,"Vinicius Nogueira","vinicius1@outlook.com","108.383.820-29","CPF","15981070774");

//$creditCard = $pagarme->createdCreditCard("-----","5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-000","SP","itapetininga","Rua dos Bobos");

//$getCreditCard = $pagarme->getCreditCard("cus_id----","card_------");

//$updateCreditCard = $pagarme->updateCreditCard("cus_id----","card_------","5425 6489 5749 2251","Vinicius Nogueira","01/2024","123","18220-200","SP","itapetininga","Rua dos Bobos");

//$renewCreditCard = $pagarme->renewCreditCard("cus_id----","card_------");

//$deleteCreditCard = $pagarme->deleteCreditCard("cus_id----","card_------");

//$trasactionCredit = $pagarme->transactionCrediCard("cus_id----","card_------",uniqid(),"testando","10000","1",8);

//$trasactionPIX = $pagarme->transactionPix("cus_id----",uniqid(),"testando","10000","1","800");

//$getOrder = $pagarme->getOrder("or_PZVrzjpiAix7q1me");

$closeOrder = $pagarme->closeOrder("or_dj7lW2dtKZs7JvQm");
var_dump($closeOrder->callback());