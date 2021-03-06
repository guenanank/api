<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Province as Provinces;

class Province extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $provinces = Provinces::all();
        return response($provinces);
    }
    
    public function get($provinceId) {
        $province = Provinces::findOrFail($provinceId);
        return response($province);
    }
    
    public function lists() {
        $lists = Provinces::lists('provinceName', 'provinceId');
        return response($lists);
    }

}
