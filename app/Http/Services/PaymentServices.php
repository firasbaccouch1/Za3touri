<?php
namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class PaymentServices {

private $Base_Url;
private $Headers;
private $request_client;

public function __construct(Client $request_client){
$this->request_client = $request_client;
$this->Base_Url = env('fatoora_base_url');
$this->Headers = [
    'Content-Type' => 'application/json',
    'authorization' => 'bearer '. env('fatoora_token')
];
}


public function BuildRequest($url,$method,$data=[]){
    $request = new Request($method,$this->Base_Url.$url,$this->Headers);
    if (!$data) {
        return 'no data given';
    }
    $response = $this->request_client->send($request,[
        'json' => $data
    ]);
    if ($response->getStatusCode() != 200) {
       return 'status is Not 200';
    }
    $response = json_decode($response->getBody(),true);
    return $response;
}
public function sendPayment($data){
return $response = $this->BuildRequest('/v2/SendPayment','POST',$data);
}

public function getPaymentStatus($data){
return $response = $this->BuildRequest('/v2/getPaymentStatus','POST',$data);
}

    





}