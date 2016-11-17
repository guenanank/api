<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Gateway\Employee as Employees;

class Login extends \App\Http\Controllers\Controller {

    public function index(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $employee = Employees::with('section.departement.division', 'position')->find($request->username);

        if (Hash::check($request->password, $employee->password) == false) :
            return response(['password' => ['Wrong password']], 422);
        endif;

        $token = \Illuminate\Support\Facades\Crypt::encrypt($employee->employeeId);
        $employee->update(['token' => $token]);
        return response(['token' => $token, 'msg' => $employee]);
    }

}
