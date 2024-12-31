<?php
namespace App\Enums;

enum ProductStatus:string{
    case Waiting = 'waiting'; //درانتظار تایید
    case Verified = 'verified'; //تایید شده
    case StopProduction = 'stop_production'; //توقف تولید

    case Rejected = 'rejected'; //رد شدن به دلیل بی کیفیت بودن محصول
}

?>
