<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\Village as Villages;

class Village extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $villages = Villages::all();
        return response($villages);
    }
    
    public function get($villageId) {
        $village = Villages::findOrFail($villageId);
        return response($village);
    }
    
    public function lists() {
        $lists = Villages::lists('villageName', 'villageId');
        return response($lists);
    }
    
    public function getByDistrict($districtId) {
        $villages = Villages::select('villageName', 'villageId')->where('districtId', $districtId)->get();
        return response($villages);
    }

}
