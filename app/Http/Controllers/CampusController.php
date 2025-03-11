<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::all();
        return view('campus_view', compact('campuses'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campus_registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'campus' => 'required|string|max:255|unique:campuses,campus_name',
        ]);
    
        $campusId = Campus::generateCampusId($request->campus);
    
        Campus::create([
            'campus_id' => $campusId,
            'campus_name' => $request->campus,
        ]);
    
        return redirect()->route('campus.create')->with('success', 'Campus registered successfully! ID: ' . $campusId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        return view('campus_edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'campus_name' => 'required|string|max:255',
        ]);

        $campus = Campus::findOrFail($id);
        $campus->campus_name = $request->campus_name;
        $campus->campus_id = Campus::generateCampusId($request->campus_name);
        $campus->save();

        return redirect()->route('campus.index')->with('success', 'Campus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campus = Campus::findOrFail($id);
        $campus->delete();

        return redirect()->route('campus.index')->with('success', 'Campus deleted successfully.');
    }
}
