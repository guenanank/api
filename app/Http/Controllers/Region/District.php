<?php

namespace App\Http\Controllers\Region;

use App\Models\Region\District as Districts;

class District extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $district = Districts::all();
        return response($district);
    }

}
