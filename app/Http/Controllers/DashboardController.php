<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $total_employee = User::all()->count();

        $total_login = LoginLog::all()->count();

        $total_unit = Unit::all()->count();

        $total_position = Position::all()->count();

        return view('dashboard')->with([
            'total_employee' => $total_employee,
            'total_login' => $total_login,
            'total_unit' => $total_unit,
            'total_position' => $total_position,
        ]);
    }

    public function table(Request $request)
    {
        $user = User::query()->with('loginLog')->withCount('loginLog')->having('login_log_count', '>', 25)->orderBy('login_log_count', 'desc')->take(10);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($request->ajax()) {
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $user = $user->whereHas('loginLog', function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('login_time', [$start_date, $end_date]);
                });
            }
        }

        return DataTables::of($user)->addIndexColumn()->make();
    }

    public function filterDataDateRange(Request $request)
    {
        $total_employee = User::whereBetween('join_date', [$request->start_date, $request->end_date])->count();
        $total_login = LoginLog::whereBetween('login_time', [$request->start_date, $request->end_date])->count();

        $data = new stdClass();
        $data->total_employee = $total_employee;
        $data->total_login = $total_login;

        return $data;
    }
}
