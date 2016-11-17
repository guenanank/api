<?php

namespace App\Http\Controllers\v1\Vehicle;

use App\Models\Vehicle\Classification as Classifications;

class Classification extends \App\Http\Controllers\Controller {

    public function index() {
        $classification = Classifications::with('series')->get();
        return response($classification);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'classificationName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Classifications::where('classificationName', 'like', '%' . $search . '%')
                ->orWhereHas('series', function($query) use($search) {
                    $query->where('seriesName', 'LIKE', '%' . $search . '%');
                })
                ->with('series')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Classifications::where('classificationName', 'like', '%' . $search . '%')
                ->orWhereHas('series', function($query) use($search) {
                    $query->where('seriesName', 'LIKE', '%' . $search . '%');
                })
                ->count();

        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }

    public function lists() {
        $lists = Classifications::lists('classificationName', 'classificationId');
        return response($lists);
    }

}
