<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Regency as Regencies;

class Regency extends \App\Http\Controllers\Controller {

    public function index() {
        $regency = Regencies::all();
        return response($regency);
    }

}
