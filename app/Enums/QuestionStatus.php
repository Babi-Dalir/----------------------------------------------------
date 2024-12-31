<?php
namespace App\Enums;

enum QuestionStatus:string{
    case Draft = 'draft';
    case Approved = 'approved'; //تایید
    case Rejected = 'rejected';
}

?>
