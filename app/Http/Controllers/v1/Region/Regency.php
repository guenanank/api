<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Regency as Regencies;

class Regency extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $regency = Regencies::all();
        return response($regency);
    }
    
    public function lists() {
        $lists = Regencies::lists('regencyName', 'regencyId');
        return response($lists);
    }

}
