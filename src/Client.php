<?php

namespace BRdev\Pagarme;

class Client 
{
    /** @var string */
    private $apiurl;

    /** @var string */
    private $apikey;
    
    /** @var string */
    private $endpoint;
    
    /** @var array */
    private $build;
    
    /** @var string */
    private $callback;

    public function __construct(string $token)
    {
        $this->apiurl = "https://api.pagar.me/core/v5";
        $this->apikey = base64_encode($token.":");
    }

    public function costumer(
        string $name,
        string $email, 
        string $numberDocument, 
        string $typeDocument, 
        string $numberPhone, 
        string $type = "individual"
        )
    {

        $this->build = [
            "code" => uniqid(),
            "name" => $name,
            "email" => $email,
            "document" => $this->number($numberDocument),
            "document_type" => $typeDocument,
            "type" => $type,
            "phones" => [
                "mobile_phone" => [
                    "country_code" => "55",
                    "area_code" => substr($numberPhone, 0, 2),
                    "number" => substr($numberPhone, 2, 9)
                ]
            ]
        ];

        $this->endpoint = "/customers";
        $this->post();

        if (empty($this->callback->id)) {
            return $this->callback->message;
        }

        return $this;
    }

    public function getCostumer($id)
    {
        $this->endpoint = "/customers/$id";
        $this->get();

        return $this;
    }

    public function UpdateCostumer(
        $id, 
        string $name,
        string $email, 
        string $numberDocument, 
        string $typeDocument, 
        string $numberPhone, 
        string $type = "individual"        
        )
    {
        $this->build = [
            "code" => uniqid(),
            "name" => $name,
            "email" => $email,
            "document" => $this->number($numberDocument),
            "document_type" => $typeDocument,
            "type" => $type,
            "phones" => [
                "mobile_phone" => [
                    "country_code" => "55",
                    "area_code" => substr($numberPhone, 0, 2),
                    "number" => substr($numberPhone, 2, 9)
                ]
            ]
        ];

        $this->endpoint = "/customers/$id";
        $this->put();

        return $this;
    }

    public function createdCreditCard(
        $cusID,
        string $card_number,
        string $card_holder_name,
        string $card_exp_date,
        string $card_cvv,
        string $billing_address_zip_code,
        string $billing_address_state,
        string $billing_address_city,
        string $billing_address_line_1,
        string $billing_address_line_2 = null,
        string $billing_address_country = "BR"
        )
    {
        $this->build = [
            "number" => $this->number($card_number),
            "holder_name" => filter_var($card_holder_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "exp_month" => substr($this->number($card_exp_date), "0", "2"),
            "exp_year" => substr($this->number($card_exp_date), "4", "4"),
            "cvv" => $this->number($card_cvv),
            "billing_address" => [
                "country" => $billing_address_country,
                "zip_code" => $this->number($billing_address_zip_code),
                "state" => $billing_address_state,
                "city" => $billing_address_city,
                "line_1" => $billing_address_line_1,
                "line_2" => $billing_address_line_2
            ],
            "options" => [
                "verify_card" => true
            ]
        ];

        $this->endpoint = "/customers/$cusID/cards";
        $this->post();

        if (empty($this->callback->id) || $this->callback->status != "active") {
            return $this->callback->message;
        }

        return $this;
    }

    public function getCreditCard($cus_id,$card_id)
    {
        $this->endpoint = "/customers/$cus_id/cards/$card_id";
        $this->get();

        return $this;
    }

    public function updateCreditCard(
        string $cus_id,
        string $card_id,
        string $card_number,
        string $card_holder_name,
        string $card_exp_date,
        string $card_cvv,
        string $billing_address_zip_code,
        string $billing_address_state,
        string $billing_address_city,
        string $billing_address_line_1,
        string $billing_address_line_2 = null,
        string $billing_address_country = "BR"
        )
        {
            $this->build = [
                "number" => $this->number($card_number),
                "holder_name" => filter_var($card_holder_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                "exp_month" => substr($this->number($card_exp_date), "0", "2"),
                "exp_year" => substr($this->number($card_exp_date), "4", "4"),
                "cvv" => $this->number($card_cvv),
                "billing_address" => [
                    "country" => $billing_address_country,
                    "zip_code" => $this->number($billing_address_zip_code),
                    "state" => $billing_address_state,
                    "city" => $billing_address_city,
                    "line_1" => $billing_address_line_1,
                    "line_2" => $billing_address_line_2
                ],
                "options" => [
                    "verify_card" => true
                ]
            ];

            $this->endpoint = "/customers/$cus_id/cards/$card_id";
            $this->put();
    
            return $this;
    }

    public function deleteCreditCard($cus_id,$card_id)
    {
        $this->endpoint = "/customers/$cus_id/cards/$card_id";
        $this->delete();

        return $this;
    }

    public function renewCreditCard($cus_id,$card_id)
    {
        $this->endpoint = "/customers/$cus_id/cards/$card_id/renew";
        $this->post();

        return $this;
    }

    public function transactionCrediCard(
        string $cusId,
        string $hashCard,
        string $code,
        string $description,
        string $amount_cents,
        string $quantity,
        int $installments
    )
    {

        $this->build = [
            "items" => [
                [
                    "code" => $this->number($code),
                    "description" => $this->char($description),
                    "amount" => $this->number($amount_cents),
                    "quantity" => $this->number($quantity)
                ]
            ],
            "customer_id" => $cusId,
            "payments" => [
                [
                    "payment_method" => "credit_card",
                    "credit_card" => [
                        "card_id" => $hashCard,
                        "statement_descriptor" => $this->char($description),
                        "recurrence" => true,
                        "antifraud_enabled" => false,
                        "installments" => $installments
                    ]
                ]
            ]
        ];

        $this->endpoint = "/orders";
        $this->post();

        if (empty($this->callback->status) || $this->callback->status != "paid") {
            return $this->callback->message;
        }

        return $this;
    }

    public function transactionPix(
        string $cusId,
        string $code,
        string $description,
        string $amount_cents,
        string $quantity,
        string $timeExpires
    )
    {

        $this->build = [
            "items" => [
                [
                    "code" => $this->number($code),
                    "description" => $this->char($description),
                    "amount" => $this->number($amount_cents),
                    "quantity" => $this->number($quantity)
                ]
            ],
            "customer_id" => $cusId,
            "payments" => [
                [
                    "payment_method" => "pix",
                    "pix" => [
                        "expires_in" => (int)$this->number($timeExpires)
                    ]
                ]
            ]
        ];

        $this->endpoint = "/orders";
        $this->post();

        if (empty($this->callback->status)) {
            return null;
        }

        return $this;
    }

    public function getOrder(string $orderId)
    {
        $this->endpoint = "/orders/$orderId";
        $this->get();

        return $this;
    }

    //status paid canceled failed Caso não enviado, valor default será paid.
    public function closeOrder(string $orderId, string $status = "paid")
    {   
        $this->build = [
            "status" => $status
        ];
    

        $this->endpoint = "/orders/$orderId/closed";
        $this->patch();

        return $this;
    }

    public function callback()
    {
        return $this->callback;
    }

    /**
     * @param string $number
     * @return string
     */
    private function number(?string $number): string
    {
        return preg_replace("/[^0-9]/", "", $number);
    }

    /**
     * @param string $number
     * @return string
     */
    private function char(?string $char, int $limit = 13): string
    {
        $charsReplaced = preg_replace("/[^a-zA-Z ]/", "", $char);
        return (strlen($charsReplaced)) >= $limit ? substr($charsReplaced, 0, $limit - 1) : $charsReplaced;
    }



    public function post(): void
    {
        $url = $this->apiurl . $this->endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->build));

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '. $this->apikey;
        $headers[] = 'Content-Type: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }

    public function get(): void
    {
        $url = $this->apiurl . $this->endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '. $this->apikey;
        $headers[] = 'Content-Type: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }


    public function put(): void
    {
        $url = $this->apiurl . $this->endpoint;
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => json_encode($this->build),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Basic $this->apikey",
            "Content-Type: application/json"
        ],
        ]);

        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }

    public function delete(): void
    {
        $url = $this->apiurl . $this->endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '. $this->apikey;
        $headers[] = 'Content-Type: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }

    public function patch(): void
    {
        $url = $this->apiurl . $this->endpoint;
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PATCH",
        CURLOPT_POSTFIELDS => json_encode($this->build),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Basic $this->apikey",
            "Content-Type: application/json"
        ],
        ]);

        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }
}
