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
        return view('data-unit.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function table()
    {
        $unit = Unit::query();

        return DataTables::of($unit)
        ->addIndexColumn()
        ->addColumn('action', function($data) {
            return view('partials.button');
        })
        ->rawColumns(['action'])
        ->make();
    }
}