<?php

namespace App\Http\Controllers\Gateway;

use App\Models\Gateway\Employee as Employees;

class Employee extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $employee = Employees::with('section.departement.division', 'position')->get();
        return response($employee);
    }
    
    public function show($employeeId) {
        $employee = Employees::with('section.departement.division', 'position')->find($employeeId);
        return response($employee);
    }

}
