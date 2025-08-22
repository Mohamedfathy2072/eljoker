<?php
    namespace App\Enums;
    enum NotificationTypes:string{
        case USER = 'user';
        case ALL = 'all';
        case LAWYER = 'lawyer';
        case ADMIN = 'admin';
        case CUSTOMER = 'customer';
    }
?>