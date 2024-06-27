<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmployeePosition;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users,username'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $request)
    {
        $unit = Unit::where('id', $request['unit'])->count();

        if ($unit == 0) {
            $unit_id = Unit::insertGetId([
                'name' => $request['unit'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $unit_id = $request['unit'];
        }

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'unit_id' => $unit_id,
            'join_date' => $request['join_date'],
        ]);

        foreach ($request['position'] as $key => $value) {
            $position = Position::where('id', $request['position'][$key])->count();

            if ($position == 0) {
                $position_id = Position::insertGetId([
                    'name' => $request['position'][$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $position_id = $request['position'][$key];
            }

            EmployeePosition::create([
                'user_id' => $user->id,
                'position_id' => $position_id,
            ]);
        }

        return $user;
    }
    // protected function create(Request $request)
    // {
    //     $unit = Unit::where('id', $request->unit)->count();

    //     if ($unit == 0) {
    //         $unit_id = Unit::insertGetId([
    //             'name' => $request->unit,
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_at' => date('Y-m-d H:i:s'),
    //         ]);
    //     } else {
    //         $unit_id = $request->unit;
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'username' => $request->username,
    //         'password' => Hash::make($request->password),
    //         'unit_id' => $unit_id,
    //         'join_date' => $request->join_date,
    //     ]);

    //     foreach ($request->position as $key => $value) {
    //         $position = Position::where('id', $request->position[$key])->count();

    //         if ($position == 0) {
    //             $position_id = Position::insertGetId([
    //                 'name' => $request->position[$key],
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ]);
    //         } else {
    //             $position_id = $request->position[$key];
    //         }

    //         EmployeePosition::create([
    //             'user_id' => $user->id,
    //             'position_id' => $position_id,
    //         ]);
    //     }

    //     return $user;
    // }
}
