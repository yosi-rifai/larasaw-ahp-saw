<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $criterias = Criteria::all();
        return view('criterias.index', compact('criterias'));
    }

    public function create()
    {
        return view('criterias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|between:0,99.99',
            'jenis' => 'required|string|max:255',
        ]);

        Criteria::create($request->all());

        return redirect()->route('criterias.index')
                         ->with('success', 'Criteria created successfully.');
    }


    public function edit(Criteria $criteria)
    {
        return view('criterias.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|between:0,99.99',
            'jenis' => 'required|string|max:255',
        ]);

        $criteria->update($request->all());

        return redirect()->route('criterias.index')
                         ->with('success', 'Criteria updated successfully.');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

        return redirect()->route('criterias.index')
                         ->with('success', 'Criteria deleted successfully.');
    }
}
