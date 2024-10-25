<?php

namespace App\Policies;

use App\Models\User;
use App\Enum\RoleEnum;
use Illuminate\Auth\Access\Response;


class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }
    public function before(User $user, $ability)
    {
        if ($user->hasRole([RoleEnum::ADMIN->value, RoleEnum::VIP->value])) {
            return true;
        }

        return null;
    }

    public function createCatalog(User $user) {
        if ($user->hasRole([RoleEnum::LITE->value, RoleEnum::MEDIUM->value])) {
            return Response::allow();
        }
    
        return Response::denyAsNotFound();
    }
    
    public function updateDesign(User $user) {
        if ($user->hasRole([RoleEnum::MEDIUM->value])) {
            return Response::allow();
        }
    
        return Response::denyAsNotFound();
    }
    public function updateInfo(User $user) {
        if ($user->hasRole([RoleEnum::MEDIUM->value])) {
            return Response::allow();
        }
    
        return Response::denyAsNotFound();
    }
    public function updateCustomHTML(User $user) {
        if ($user->hasRole([RoleEnum::MEDIUM->value])) {
            return Response::allow();
        }
    
        return Response::denyAsNotFound();
    }
    public function updateDomainName(User $user) {
        if ($user->hasRole([RoleEnum::MEDIUM->value])) {
            return Response::allow();
        }
    
        return Response::denyAsNotFound();
    }
}
