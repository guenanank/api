<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\MediaType as MediaTypes;

class MediaType extends \App\Http\Controllers\Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $mediaTypes = MediaTypes::all();
        return response($mediaTypes);
    }
    
    public function get($mediaTypeId) {
        $mediaType = MediaTypes::findOrFail($mediaTypeId);
        return response($mediaType);
    }
    
    public function lists() {
        $lists = MediaTypes::lists('mediaTypeName', 'mediaTypeId');
        return response($lists);
    }
}
