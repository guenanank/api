<?php

namespace App\Http\Controllers\Gateway;

use App\Models\Gateway\Employee as Employees;

class Employee extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $employee = Employees::all();
        return response($employee);
    }

}
