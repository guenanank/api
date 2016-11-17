<?php

namespace App\Http\Controllers\Region;

use App\Models\Region\Village as Villages;

class Village extends \App\Http\Controllers\Controller {

    public function index() {
        $village = Villages::all();
        return response($village);
    }

}
