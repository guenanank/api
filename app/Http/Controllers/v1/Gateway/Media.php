<?php

namespace App\Http\Controllers\v1\Gateway;

use App\Models\Gateway\Media as MediaModel;

class Media extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $media = MediaModel::with('mediaType')->all();
        return response($media);
    }
    
    public function get($mediaId) {
        $media = MediaModel::with('mediaGroup', 'mediaType')->findOrFail($mediaId);
        return response($media);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'mediaName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = MediaModel::where('mediaName', 'like', '%' . $search . '%')
                ->orWhereHas('mediaType', function($type) use($search) {
                    $type->where('mediaTypeName', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('mediaGroup', function($type) use($search) {
                    $type->where('mediaGroupName', 'LIKE', '%' . $search . '%');
                })
                ->with('mediaType', 'mediaGroup')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = MediaModel::where('mediaName', 'like', '%' . $search . '%')
                ->count();

        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }
    
    public function lists() {
        $lists = MediaModel::lists('mediaName', 'mediaId');
        return response($lists);
    }
    
    public function listsGMC() {
        $lists = MediaModel::where('mediaIsExternal', true)->lists('mediaName', 'mediaId');
        return response($lists);
    }
    
}
