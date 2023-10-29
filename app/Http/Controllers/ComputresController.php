<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ComputresController extends Controller
{
    // public function __construct()
    // {

    //     $this->middleware('auth')->except(['index', 'show', 'search']);
    // }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $Computers = Computer::where('user_id', Auth::id())->latest()
            ->paginate(16);
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
    public function create1()
    {
        return view('computers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $image = $request->file('image-Compt')->store('ComputersImages', 'public');

        $computer = new Computer();
        $computer->nameComputer = $request->input("Name-Compt");
        $computer->originComputer = $request->input("Origin-Compt");
        $computer->priceComputer = $request->input('Price-Compt');
        $computer->imageComputer = $image;
        try {
            $computer->desc = $request->desc;
        } catch (\Throwable $th) {
            //throw $th;
        }
        $computer->User_id = Auth::id();

        $computer->save();
        return redirect('user/profile')->with('success', 'Ajouter a été success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        if (Computer::find($id / 789456654987) && is_integer($id / 789456654987)) {
            $computer = Computer::find($id / 789456654987);
        } else {
            return redirect()->route('404', 'error');
        }
        return view('computers.show', [
            'computer' => $computer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Computer::find($id / 789456654987) && is_integer($id / 789456654987)) {
            $computer = Computer::find($id / 789456654987);
        } else {
            return redirect()->route('404', 'error');
        }
        return view('computers.edit', [
            'Computer' => $computer,
        ]);
    }

    public function editajax(Request $rq)
    {
        if (Computer::find($rq->id / 789456654987) && is_integer($rq->id / 789456654987)) {
            $computer = Computer::find($rq->id / 789456654987);
        } else {
            return redirect()->route('404', 'error');
        }
        return Response::json($computer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Computer::find($id / 789456654987) && is_integer($id / 789456654987)) {
            $computer = Computer::find($id / 789456654987);
            $oldImageProfile = $computer->imageComputer;
        } else {
            return redirect()->route('404', 'error');
        }
        $request->validate([
            "Name-Compt"   => ['required', 'Min:2', 'Max:50'],
            "Origin-Compt" => 'required',
            "Price-Compt"  => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            "image-Compt"  => ['image', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp', 'max:10000'],
        ]);
        try {
            $computer->desc = $request->desc;
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            $image = $request->file('image-Compt')->store('ComputersImages', 'public');
            Storage::delete('public/' . $oldImageProfile);
            $computer->imageComputer = $image;
        } catch (\Throwable $th) {
            //throw $th;
        }

        $computer->nameComputer = $request->input("Name-Compt");
        $computer->originComputer = $request->input("Origin-Compt");
        $computer->priceComputer = $request->input("Price-Compt");
        $computer->save();
        return redirect()->back()->with('success', 'Modify a été success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Computer::find($id / 789456654987) && is_integer($id / 789456654987)) {
            Storage::delete('public/' . Computer::find($id / 789456654987)->imageComputer);
            Computer::find($id / 789456654987)->delete();
        } else {
            return redirect()->route('404', 'error');
        }
        return redirect()->back()->with('success', 'Suprimére a été success');
    }
    public function search(Request $request)
    {
        $search = $request->q;
        $computersSearch = Computer::where(function ($query) use ($search) {
            $query->where('nameComputer', 'like', "%" . $search . "%")
                ->paginate(10);
        })->get();
        return view('computers.search', compact('computersSearch', 'search'));
    }
    public function searchajax(Request $request)
    {
        $search = $request->q;
        $computersSearch = Computer::where(function ($query) use ($search) {
            $query->where('nameComputer', 'like', "%" . $search . "%")->paginate(10);
        })->get();
        return Response::json($computersSearch);
    }
    
    
}
