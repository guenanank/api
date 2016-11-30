<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\MediaGroup as MediaGroups;

class MediaGroup extends \App\Http\Controllers\Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $mediaGroups = MediaGroups::with('media', 'publisher')->all();
        return response($mediaGroups);
    }
    
    public function get($mediaGroupId) {
        $mediaGroup = MediaGroups::with('publisher', 'media')->findOrFail($mediaGroupId);
        return response($mediaGroup);
    }
    
    public function lists() {
        $lists = MediaGroups::lists('mediaGroupName', 'mediaGroupId');
        return response($lists);
    }
    
}