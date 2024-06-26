<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-position.index')->with([
            'title' => 'Data Jabatan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-position.create-position');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Position::create([
            'name' => $request->name,
        ]);

        return redirect('/data-jabatan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return view('data-position.detail-position')->with([
            'data' => $position,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('data-position.update-position')->with([
            'data' => $position,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        Position::where('id', $position->id)->update([
            'name' => $request->name,
        ]);

        return redirect('/data-jabatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        Position::where('id', $position->id)->update([
            'is_active' => false,
        ]);
    }

    public function table()
    {
        $position = Position::query()->where('is_active', true);

        return DataTables::of($position)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('partials.button')->with([
                    'id' => $data->id,
                ]);
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function listPosition()
    {
        $data = Position::all()->where('is_active', true);
        return view('partials.dropdown.position')->with([
            'data' => $data,
        ]);
    }
}
