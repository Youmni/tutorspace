<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Institution; 
use App\Http\Controllers\Controller;

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

        return view('admin.institution.institutions', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.institution.institutions_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'country' => 'required|string|min:3|max:150',
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $institution = Institution::findOrFail($id);
        return view('admin.institution.institutions_edit',compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'country' => 'required|string|min:3|max:150',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($validatedData);

        return redirect()->route('admin.institutions.index')->with('success', 'Institution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();
        
        return redirect()->route('admin.institutions.index')->with('success', 'Item deleted successfully.');
    }
}
