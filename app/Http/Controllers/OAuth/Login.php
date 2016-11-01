<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Gateway\Employee as Employees;

class Login extends \App\Http\Controllers\Controller {

    public function index(Request $request) {
        $employee = Employees::with('section.departement.division', 'position')->find($request->username);
        if (collect($employee)->isEmpty()) :
            return response(['stat' => false, 'msg' => 'Employee not found']);
        else :
            if (Hash::check($request->password, $employee->password) == false) :
                return response(['stat' => true, 'msg' => 'Wrong password']);
            endif;

            $token = sha1(time());
            $employee->update(['token' => $token]);
            return response(['stat' => true, 'token' => $token, 'msg' => $employee]);

        endif;
    }

}
