<?php

namespace App\Http\Controllers;

use App\Services\PetstoreService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    protected $petstoreService;

    public function __construct(PetstoreService $petstoreService) {
        $this->petstoreService = $petstoreService;
    }

    public function index() {
        $pets = $this->petstoreService->getAllPets();
        return view('pets.index', compact('pets'));
    }

    public function show($id)
    {
        $pet = $this->petstoreService->getPetById($id);
        return view('pets.show', compact('pet'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'photoUrls' => 'nullable|string',
        ]);

        $data = [
            'id' => 0,
            'category' => [
                'id' => 0,
                'name' => $validatedData['category'] ?? 'default',
            ],
            'name' => $validatedData['name'],
            'photoUrls' => array_map('trim', explode(',', $validatedData['photoUrls'] ?? '')),
            'tags' => array_map(fn($tag) => ['id' => 0, 'name' => trim($tag)], explode(',', $validatedData['tags'] ?? '')),
            'status' => $validatedData['status'],
        ];

        $response = $this->petstoreService->createPet($data);

        return redirect()->route('pets.index')->with('success', 'Zwierzę zostało dodane!');
    }

    public function edit($id)
    {
        $pet = $this->petstoreService->getPetById($id);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'photoUrls' => 'nullable|string',
        ]);


        $data = [
            'id' => $id,
            'name' => $request->name,
            'status' => $request->status,
            'category' => ['name' => $request->category],
            'tags' => array_map(fn($tag) => ['name' => trim($tag)], explode(',', $request->tags)),
            'photoUrls' => array_map('trim', explode(',', $request->photoUrls)),
        ];


        $this->petstoreService->updatePet( $data);

        return redirect()->route('pets.index')->with('success', 'Zwierzę zostało zaktualizowane!');
    }

    public function destroy($id)
    {
        $this->petstoreService->deletePet($id);
        return redirect()->route('pets.index');
    }
}
