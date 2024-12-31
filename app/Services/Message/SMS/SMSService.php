<?php
namespace App\Services\Message\SMS ;

use App\Services\Message\MessageInterface;

class SMSService implements MessageInterface
{
    private $receirver;
    private $content;

    public function sendMessage()
    {
        $melipayamak= new MelipayamakService();
        $melipayamak->sendSimpleSMS($this->receirver,$this->content);
    }
    public function getReceirver(){
        return $this->receirver;
    }
    public function setReceirver($receirver){
        $this->receirver = $receirver;
    }
    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }
}
?>
