<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-employee.index')->with([
            'title' => 'Data Karyawan',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-employee.create-employee')->with([
            'title' => 'Data Karyawan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unit = Unit::where('id', $request->unit)->count();

        if ($unit == 0) {
            $unit_id = Unit::insertGetId([
                'name' => $request->unit,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $unit_id = $request->unit;
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'unit_id' => $unit_id,
            'join_date' => $request->join_date,
        ]);

        foreach ($request->position as $key => $value) {
            $position = Position::where('id', $request->position[$key])->count();

            if ($position == 0) {
                $position_id = Position::insertGetId([
                    'name' => $request->position[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $position_id = $request->position[$key];
            }

            EmployeePosition::create([
                'user_id' => $user->id,
                'position_id' => $position_id,
            ]);
        }

        return redirect('/data-karyawan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = User::where('id', $user->id)
            ->with([
                'unit',
                'employeePosition' => function ($query) {
                    $query->with(['position']);
                },
            ])
            ->first();

        $position = '';
        $position2 = '';

        foreach ($data->employeePosition as $key => $value) {
            if ($key == 0) {
                $position = $data->employeePosition[$key]->position->name;
            } elseif ($key == 1) {
                $position2 = $position . ', ' . $data->employeePosition[$key]->position->name;
            } else {
                $position2 = $position2 . ', ' . $data->employeePosition[$key]->position->name;
            }
        }

        return view('data-employee.detail-employee')->with([
            'data' => $data,
            'title' => 'Data Karyawan',
            'position' => $position2,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = User::where('id', $user->id)
            ->with([
                'unit',
                'employeePosition' => function ($query) {
                    $query->with(['position']);
                },
            ])
            ->first();

        return view('data-employee.update-employee')->with([
            'title' => 'Data Karyawan',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $unit = Unit::where('id', $request->unit)->count();

        if ($unit == 0) {
            $unit_id = Unit::insertGetId([
                'name' => $request->unit,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $unit_id = $request->unit;
        }

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'unit_id' => $unit_id,
            'join_date' => $request->join_date,
        ]);

        foreach ($request->position as $key => $value) {
            $position = Position::where('id', $request->position[$key])->count();

            if ($position == 0) {
                $position_id = Position::insertGetId([
                    'name' => $request->position[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $position_id = $request->position[$key];
            }

            if (
                EmployeePosition::where('user_id', $user->id)
                    ->where('position_id', $position_id)
                    ->count() == 0
            ) {
                EmployeePosition::create([
                    'user_id' => $user->id,
                    'position_id' => $position_id,
                ]);
            }
        }
        
        return redirect('/data-karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->update([
            'is_active' => false,
        ]);
    }

    public function table()
    {
        $user = User::query()
            ->where('is_active', true)
            ->with(['unit'])
            ->with([
                'employeePosition' => function ($query) {
                    $query->with(['position']);
                },
            ]);

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('position', function ($data) {
                $position = $data->employeePosition;

                $name = '';
                $name2 = '';
                $i = 0;

                foreach ($position as $key => $value) {
                    $i++;
                }

                if ($i > 1) {
                    foreach ($position as $key => $value) {
                        if ($key == 0) {
                            $name = $position[$key]->position->name;
                        } elseif ($key == 1) {
                            $name2 = $name . ', ' . $position[$key]->position->name;
                        } else {
                            $name2 = $name2 . ', ' . $position[$key]->position->name;
                        }
                    }
                } else {
                    $name2 = $position[$key]->position->name;
                }

                return $name2;
            })
            ->addColumn('action', function ($data) {
                return view('partials.button')->with([
                    'id' => $data->id,
                ]);
            })
            ->rawColumns(['action'])
            ->make();
    }
}
