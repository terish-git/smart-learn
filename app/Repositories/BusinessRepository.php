<?php

namespace App\Repositories;

use App\Models\Business;

class BusinessRepository
{

    public function updateProfile($user, array $data)
    {
        return Business::updateOrCreate(
            ['user_id' => $user->id], // Find by user_id
            [
                'name' => $data['name'],
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
            ]
        );
    }

    public function findByUserId($id)
    {
        return Business::where('user_id', $id)->first();
    }
}