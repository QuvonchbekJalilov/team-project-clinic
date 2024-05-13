<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role == "admin";
    }

    public function view(User $user, Doctor $doctor)
    {
        return $user->role == 'admin';
    }

    public function create(User $user)
    {
        return auth()->user()->role == 'admin';
    }

    public function update(User $user, Doctor $doctor)
    {
        return auth()->user()->role == 'admin';
    }

    public function delete(User $user, Doctor $doctor)
    {
        return auth()->user()->role == 'admin';
    }
}

