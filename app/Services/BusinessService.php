<?php

namespace App\Services;

use App\Repositories\BusinessRepository;
use Illuminate\Support\Facades\Auth;

class BusinessService
{
    protected $businessRepository;

    public function __construct(BusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }

    public function updateProfile($user, $data)
    {
        return $this->businessRepository->updateProfile($user, $data);
    }
}
