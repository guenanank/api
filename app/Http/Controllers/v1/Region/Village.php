<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Village as Villages;

class Village extends \App\Http\Controllers\Controller {

    public function index() {
        $village = Villages::all();
        return response($village);
    }

}
