<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PetstoreService
{
    protected Client $client;

    protected string $baseUrl;

    public function __construct(Client $client, string $baseUrl = 'https://petstore.swagger.io/v2')
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    private function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $response = $this->client->request($method, "{$this->baseUrl}/{$endpoint}", [
                'json' => $data,
            ]);

            $body = $response->getBody();
            $result = json_decode($body, true);

            if (! is_array($result)) {
                throw new Exception('API response is not in valid format');
            }

            return $result;
        } catch (RequestException $e) {
            throw new Exception('API request failed: '.$e->getMessage());
        }
    }

    public function getAllPets(): array
    {
        return $this->makeRequest('GET', 'pet/findByStatus?status=available');
    }

    public function getPetById(int $id): array
    {
        return $this->makeRequest('GET', "pet/{$id}");
    }

    public function createPet(array $data): array
    {
        return $this->makeRequest('POST', 'pet', $data);
    }

    public function updatePet(array $data): array
    {
        return $this->makeRequest('PUT', 'pet', $data);
    }

    public function deletePet(int $id): array
    {
        return $this->makeRequest('DELETE', "pet/{$id}");
    }
}
