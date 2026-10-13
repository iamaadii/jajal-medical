<?php

namespace App\Policies;

use App\Models\MedicalCase;
use App\Models\User;

class CasePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array(strtolower($user->role), ['admin', 'engineer', 'viewer']);
    }

    public function view(User $user, MedicalCase $case): bool
    {
        return in_array(strtolower($user->role), ['admin', 'engineer', 'viewer']);
    }

    public function create(User $user): bool
    {
        return in_array(strtolower($user->role), ['admin', 'engineer']);
    }

    public function update(User $user, MedicalCase $case): bool
    {
        return in_array(strtolower($user->role), ['admin', 'engineer']);
    }

    public function delete(User $user, MedicalCase $case): bool
    {
        return strtolower($user->role) === 'admin';
    }
}
