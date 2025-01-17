<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetstoreService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://petstore.swagger.io/v2';
    }

    public function getAllPets()
    {
        return Http::get("{$this->baseUrl}/pet/findByStatus?status=available")->json();
    }

    public function getPetById($id)
    {
        return Http::get("{$this->baseUrl}/pet/{$id}")->json();
    }

    public function createPet($data)
    {
        return Http::post("{$this->baseUrl}/pet", $data)->json();
    }

    public function updatePet($data)
    {
        return Http::put("{$this->baseUrl}/pet", $data)->json();
    }

    public function deletePet($id)
    {
        return Http::delete("{$this->baseUrl}/pet/{$id}")->json();
    }
}
