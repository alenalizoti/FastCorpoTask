<?php
declare(strict_types=1);
namespace App\Enums;

enum  EventType : string
{
    case Login  = 'login';
    case Logout = 'logout';
    case Register = 'registration';
    case PageView = 'view_page';
    case ButtonClick = 'button_click';
}
