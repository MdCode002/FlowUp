<?php
 
 namespace App\classe;

 class Paytech
{
    private $api_key = "91ceff428329b1b4e240b4004826606cf72bdd819449c75cde34fb1b112a0b04";
    private $api_secret = "72ebc96ee62c89d4432dd9e77d6a72a6c6a2a500419ec3e1d69547b0958703e5";


    public function post($url, $data = [], $header = [])
    {
        $strPostField = http_build_query($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strPostField);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length: ' . mb_strlen($strPostField)
        ]));

        return curl_exec($ch);
    }
 
 public function PayoutPaytech($total, $id, $idUser)
 {
     $postFields = array(
         "item_name"    => "Commande",
         "item_price"   => $total,
         "currency"     => "xof",
         "ref_command"  =>  "Comande" . $id . $total,
         "command_name" =>  "Commande",
         "env"          =>  "test",
         "success_url"  =>  "https://dencko.alwaysdata.net/app/Views/Home.php",
         "ipn_url"           =>  "https://dencko.alwaysdata.net/app/controller/verificationPayment.php",
         "cancel_url"   =>  "https://dencko.alwaysdata.net/app/Views/Home.php",
         "custom_field" =>   $id,
         "custom_field2" =>   $idUser
     );

     $jsonResponse = $this->post('https://paytech.sn/api/payment/request-payment', $postFields, [
         "API_KEY: " . $this->api_key,
         "API_SECRET: " . $this->api_secret
     ]);
     $responseData = json_decode($jsonResponse, true);
     if ($responseData['success'] == 1) {
         $redirectUrl = $responseData['redirect_url'];
         header("Location: " . $redirectUrl);
         exit();
     }

     die($jsonResponse);
 }
}