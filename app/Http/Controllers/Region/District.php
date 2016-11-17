<?php

namespace App\Http\Controllers\Region;

use App\Models\Region\District as Districts;

class District extends \App\Http\Controllers\Controller {

    public function index() {
        $district = Districts::all();
        return response($district);
    }

}
