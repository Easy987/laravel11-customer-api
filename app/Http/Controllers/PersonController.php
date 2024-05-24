<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Person::with(['addresses', 'contacts'])->get());
    }

    public function store(StorePersonRequest $request): JsonResponse
    {
        try {
            $person = Person::create($request->validated());
            if($request->has('addresses')) {
                $person->addresses()->createMany($request->addresses);
            }
            $person->contacts()->createMany($request->contacts);
            return response()->json($person->load(['addresses', 'contacts']), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create person', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $person = Person::with(['addresses', 'contacts'])->findOrFail($id);
            return response()->json($person);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Person not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function update(UpdatePersonRequest $request, $id): JsonResponse
    {
        try {
            $person = Person::findOrFail($id);
            $person->update($request->validated());
            if($request->has('addresses')) {
                $person->addresses()->delete();
                $person->addresses()->createMany($request->addresses);
            }
            $person->contacts()->delete();
            $person->contacts()->createMany($request->contacts);
            return response()->json($person->load(['addresses', 'contacts']), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update person', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $person = Person::findOrFail($id);
            $person->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete person', 'message' => $e->getMessage()], 500);
        }
    }
}
