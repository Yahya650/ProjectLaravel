<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComputresController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth')->except(['index', 'show','search']);
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // dd(Computer::latest()->paginate(2));
        $Computers = Computer::paginate(16);
        return view("computers.index", [
            "computers" => $Computers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('computers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "Name-Compt"   => ['required', 'Min:2', 'Max:50'],
            "Origin-Compt" => 'required',
            "Price-Compt"  => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            "image-Compt"  => ['required', 'image', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp', 'max:2048'],
        ]);
        $image = $request->file('image-Compt')->store('ComputersImages', 'public');

        $computer = new Computer();
        $computer->nameComputer = $request->input("Name-Compt");
        $computer->originComputer = $request->input("Origin-Compt");
        $computer->priceComputer = $request->input('Price-Compt');
        $computer->imageComputer = $image;
        $computer->User_id = Auth::id();

        $computer->save();
        return redirect()->route('computers.index')->with('success', 'Ajouter a été success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Computer $computer)
    {
        return view('computers.show', [
            'computer' => $computer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer)
    {
        return view('computers.edit', [
            'Computer' => $computer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            "Name-Compt"   => ['required', 'Min:2', 'Max:50'],
            "Origin-Compt" => 'required',
            "Price-Compt"  => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            "image-Compt"  => ['required', 'image', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp', 'max:10000'],
        ]);

        $image = $request->file('image-Compt')->store('ComputersImages', 'public');

        $computer->nameComputer = $request->input("Name-Compt");
        $computer->originComputer = $request->input("Origin-Compt");
        $computer->priceComputer = $request->input("Price-Compt");
        $computer->imageComputer = $image;
        $computer->save();
        return redirect()->route('computers.index')->with('success', 'Modify a été success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();
        return redirect()->route('computers.index')->with('success', 'Suprimére a été success');
    }
    public function search(Request $request){
        $search = $request->input('search');
        $computers = Computer::where(function ($query) use ($search){
            $query -> where('nameComputer','like',"%".$search."%")
            -> orWhere('originComputer','like',"%".$search."%") ;  
        }) -> get();
       
        return view('computers.search',compact('computers'));
    }
}
