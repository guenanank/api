<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Regency as Regencies;

class Regency extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $regencies = Regencies::all();
        return response($regencies);
    }
    
    public function get($regencyId) {
        $regency = Regencies::findOrFail($regencyId);
        return response($regency);
    }
    
    public function lists() {
        $lists = Regencies::lists('regencyName', 'regencyId');
        return response($lists);
    }
    
    public function getByProvince($provinceId) {
        $regencies = Regencies::select('regencyId', 'regencyName')->where('provinceId', $provinceId)->get();
        return response($regencies);
    }

}
