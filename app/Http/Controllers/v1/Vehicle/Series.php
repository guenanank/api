<?php

namespace App\Http\Controllers\v1\Vehicle;

class Series extends \App\Http\Controllers\Controller {

    public function index() {
        $series = \App\Models\Vehicle\Series::with('brand', 'classification')->get();
        return response($series);
    }
    
    public function get($seriesId) {
        $series = \App\Models\Vehicle\Series::with('brand', 'classification')->findOrFail($seriesId);
        return response($series);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'seriesName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = \App\Models\Vehicle\Series::where('seriesName', 'like', '%' . $search . '%')
                ->orWhereHas('brand', function($query) use($search) {
                    $query->where('brandName', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('classification', function($query) use($search) {
                    $query->where('classificationName', 'LIKE', '%' . $search . '%');
                })
                ->with('brand', 'classification')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = \App\Models\Vehicle\Series::where('seriesName', 'like', '%' . $search . '%')
                ->orWhereHas('brand', function($query) use($search) {
                    $query->where('brandName', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('classification', function($query) use($search) {
                    $query->where('classificationName', 'LIKE', '%' . $search . '%');
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
        $lists = \App\Models\Vehicle\Series::lists('seriesName', 'seriesId');
        return response($lists);
    }

}
