<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\MediaCategory as MediaCategories;

class MediaCategory extends \App\Http\Controllers\Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $mediaCategories = MediaCategories::all();
        return response($mediaCategories);
    }
    
    public function get($mediaCategoryId) {
        $mediaCategory = MediaCategories::findOrFail($mediaCategoryId);
        return response($mediaCategory);
    }
    
    public function lists() {
        $lists = MediaCategories::lists('mediaCategoryName', 'mediaCategoryId');
        return response($lists);
    }
}
