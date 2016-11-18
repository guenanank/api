<?php

namespace App\Http\Controllers\v1\Region;

use App\Models\Region\GreaterArea as GreaterAreas;

class GreaterArea extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $greaterArea = GreaterAreas::with('regencies')->all();
        return response($greaterArea);
    }
    
    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'greaterAreaName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = GreaterAreas::where('greaterAreaName', 'like', '%' . $search . '%')
                ->orWhereHas('regencies', function($type) use($search) {
                    $type->where('regencyName', 'LIKE', '%' . $search . '%');
                })
                ->with('regencies')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = GreaterAreas::where('greaterAreaName', 'like', '%' . $search . '%')
                ->count();

        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }
    

}
