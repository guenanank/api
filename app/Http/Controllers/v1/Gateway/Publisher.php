<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\Publisher as Publishers;

class Publisher extends \App\Http\Controllers\Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $publishers = Publishers::with('mediaGroups')->all();
        return response($publishers);
    }
    
    public function get($publisherId) {
        $publisher = Publishers::with('mediaGroups')->findOrFail($publisherId);
        return response($publisher);
    }
    
    public function lists() {
        $lists = Publishers::lists('publisherName', 'publisherId');
        return response($lists);
    }
}
