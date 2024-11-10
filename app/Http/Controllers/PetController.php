<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Services\PetService;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        try
        {
            $pets = $this->petService->getAllPets();
        Log::info($pets);
        return view('pets.index', compact('pets'));
        }
        catch (\Exception $e)
        {
            Log::error('Error displaying pet list', ['exception' => $e]);
            return view('pets.index')->withErrors(['error' => $e->getMessage()]);
        }
        
    }

    public function show($id)
    {
        try
        {
            $pet = $this->petService->getPet($id);
            return view('pets.show', compact('pet'));
        }
        catch (\Exception $e)
        {
            Log::error("Error displaying pet with ID: {$id}", ['exception' => $e]);
            return redirect()->route('pets.index')->withErrors(['error' => $e->getMessage()]);
        }
        
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        try
        {
            $this->petService->createPet($request->all());
        return redirect()->route('pets.index');
        }
        catch (\Exception $e)
        {
            Log::error('Error storing new pet', ['exception' => $e]);
            return redirect()->route('pets.create')->withErrors(['error' => $e->getMessage()]);
        }
        
    }

    public function edit($id)
    {
        try
        {
            $pet = $this->petService->getPet($id);
        return view('pets.edit', compact('pet'));
        }
        catch (\Exception $e)
        {
            Log::error("Error editing pet with ID: {$id}", ['exception' => $e]);
            return redirect()->route('pets.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $data = $request->all();
            $data['id'] = $id;
            $this->petService->updatePet($data);
            return redirect()->route('pets.index');
        }
        catch (\Exception $e)
        {
            Log::error("Error updating pet with ID: {$id}", ['exception' => $e]);
            return redirect()->route('pets.edit', $id)->withErrors(['error' => $e->getMessage()]);
        }
        
    }

    public function destroy($id)
    {
        try
        {
            $this->petService->deletePet($id);
        return redirect()->route('pets.index');
        }
        catch (\Exception $e)
        {
            Log::error("Error deleting pet with ID: {$id}", ['exception' => $e]);
            return redirect()->route('pets.index')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
