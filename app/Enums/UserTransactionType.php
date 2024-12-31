<?php
namespace App\Enums;

enum UserTransactionType:string{
    case Deposit = 'deposit';  //واریز

    case Withdraw = 'withdraw';  //برداشت
}

?>
