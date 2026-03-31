<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case USER = 'USER';
    case PROVIDER = 'PROVIDER';
    case TEMP = 'TEMP';
}
