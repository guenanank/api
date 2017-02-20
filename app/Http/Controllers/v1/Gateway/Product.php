<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\Media;

class Product extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $media = Media::all();
        return response($media);
    }
    
    public function listsPrint() {
        $lists = Media::where('mediaCategoryId', 1)->lists('mediaName', 'mediaId');
        return response($lists);
    }
    
    public function listsDigital() {
        $lists = Media::where('mediaCategoryId', 2)->lists('mediaName', 'mediaId');
        return response($lists);
    }

}
