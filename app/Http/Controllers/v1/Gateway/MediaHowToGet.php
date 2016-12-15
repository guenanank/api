<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\MediaHowToGet as MediaHowToGets;

class MediaHowToGet extends \App\Http\Controllers\Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $mediaHowToGets = MediaHowToGets::all();
        return response($mediaHowToGets);
    }
    
    public function get($mediaHowToGetId) {
        $mediaHowToGet = MediaHowToGets::findOrFail($mediaHowToGetId);
        return response($mediaHowToGet);
    }
    
    public function lists() {
        $lists = MediaHowToGets::lists('mediaHowToGetName', 'mediaHowToGetId');
        return response($lists);
    }
    
}