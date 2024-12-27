<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution; 

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $institutions = Institution::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('country', 'LIKE', "%{$search}%")
            ->orWhere('institution_id', 'LIKE', "%{$search}%")
            ->orWhere('created_at', 'LIKE', "%{$search}%")
            ->orWhere('updated_at', 'LIKE', "%{$search}%")
            ->get();

        return view('admin.institutions', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);
    
        Institution::create([
            'name' => $validatedData['name'],
            'country' => $validatedData['country'],
        ]);
    
        return redirect()->route('admin.institutions.index')->with('success', 'Institution created successfully.');
    
    }
    
    /**
     * Display the specified resource.
     */
    public function add()
    {
        return view('admin.institutions_add');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
