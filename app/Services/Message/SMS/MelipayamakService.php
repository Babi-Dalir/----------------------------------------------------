<?php
namespace App\Services\Message\SMS ;
use Melipayamak;


class MelipayamakService
{
    public function sendSimpleSMS($receirver,$content){

        try{
            $sms=Melipayamak::sms();
            $to=$receirver;
            $from='50004001014556';
            $text=$content;
            $response=$sms->send($to,$from,$text);
            $json=json_decode($response);
            echo $json->Value; //RecId or Erorr Number

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}

?>
