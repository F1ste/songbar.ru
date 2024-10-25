<?php 

namespace App\Enum;

enum RoleEnum: string {
    case ADMIN = 'admin';
    case LITE = 'lite';
    case MEDIUM = 'medium';
    case VIP = 'VIP';
}