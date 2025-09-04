<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EntryController extends Controller
{
    private $rules = [
        'sena_code' => 'nullable|string|max:255',
        'date_entry' => 'required|date',
        'expiration_date' => 'nullable|date',
        'quantity' => 'required|integer|max:9999999999',
        'observations' => 'nullable|string',
        'article_id' => 'max:99999999999999999999'
    ];

    private $traductionAttributes = [
        'sena_code' => 'código sena',
        'date_entry' => 'fecha de entrada',
        'expiration_date' => 'fecha de expiración',
        'quantity' => 'cantidad',
        'observations' => 'observaciones',
        'article_id' => 'ID del artículo'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Entry::all();
        $entries->load(['article']);
        return response()->json($entries, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->applyValidator($request, $this->rules, $this->traductionAttributes);
        if(!empty($data))
        {
            return $data;
        }

        $entry = Entry::create($request->all());
        $response = [
            'message' => 'Entrada creada exitosamente',
            'entry' => $entry
        ];
        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        $entry->load(['article']);
        return response()->json($entry, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        $data = $this->applyValidator($request, $this->rules, $this->traductionAttributes);
        if(!empty($data))
        {
            return $data;
        }

        $entry->update($request->all());
        $response = [
            'message' => 'Entrada actualizada exitosamente',
            'entry' => $entry
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();
        $response = [
            'message' => 'Entrada eliminada exitosamente',
            'entry' => $entry
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
