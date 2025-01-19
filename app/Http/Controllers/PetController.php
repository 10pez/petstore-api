<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Services\PetstoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PetController extends Controller
{
    public function __construct(protected PetstoreService $petstoreService) {}

    public function index(): View
    {
        $pets = $this->petstoreService->getAllPets();

        return view('pets.index', compact('pets'));
    }

    public function show(int $id): View
    {
        $pet = $this->petstoreService->getPetById($id);

        return view('pets.show', compact('pet'));
    }

    public function create(): View
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $photoUrls = is_string($validatedData['photoUrls']) ? explode(',', $validatedData['photoUrls']) : [];

        $data = [
            'id' => 0,
            'category' => [
                'id' => 0,
                'name' => $validatedData['category'] ?? 'default',
            ],
            'name' => $validatedData['name'],
            'photoUrls' => array_map('trim', $photoUrls),
            'tags' => array_map(fn ($tag) => ['id' => 0, 'name' => trim($tag)], explode(',', $validatedData['tags'] ?? '')), // Przekształcamy tagi w tablicę
            'status' => $validatedData['status'],
        ];

        $response = $this->petstoreService->createPet($data);

        return redirect()->route('pets.index')->with('success', __('messages.pet_added'));
    }

    public function edit(int $id): View
    {
        $pet = $this->petstoreService->getPetById($id);

        return view('pets.edit', compact('pet'));
    }

    public function update(UpdatePetRequest $request, int $id): RedirectResponse
    {
        $validatedData = $request->validated();

        $data = [
            'id' => $id,
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'category' => ['name' => $validatedData['category']],
            'tags' => array_map(fn ($tag) => ['name' => trim($tag)], explode(',', $validatedData['tags'] ?? '')),
            'photoUrls' => array_map('trim', explode(',', $validatedData['photoUrls'] ?? '')),
        ];

        $this->petstoreService->updatePet($data);

        return redirect()->route('pets.index')->with('success', __('messages.pet_updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->petstoreService->deletePet($id);

        return redirect()->route('pets.index');
    }
}
