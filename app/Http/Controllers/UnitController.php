<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-unit.index')->with([
            'title' => 'Data Unit',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-unit.create-unit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Unit::create([
            'name' => $request->name,
        ]);

        return redirect('/data-unit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('data-unit.detail-unit')->with([
            'data' => $unit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('data-unit.update-unit')->with([
            'data' => $unit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        Unit::where('id', $unit->id)->update([
            'name' => $request->name,
        ]);

        return redirect('/data-unit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        Unit::where('id', $unit->id)->update([
            'is_active' => false,
        ]);
    }

    public function table()
    {
        $unit = Unit::query()->where('is_active', true);

        return DataTables::of($unit)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('partials.button')->with([
                    'id' => $data->id,
                ]);
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function listUnit()
    {
        $data = Unit::all()->where('is_active', true);
        return view('partials.dropdown.unit')->with([
            'data' => $data,
        ]);
    }
}
