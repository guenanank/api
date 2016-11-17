<?php

namespace App\Http\Controllers\Vehicle;

use App\Models\Vehicle\Brand as Brands;

class Brand extends \App\Http\Controllers\Controller {

    public function index() {
        $brand = Brands::with('series')->get();
        return response($brand);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'brandName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Brands::where('brandName', 'like', '%' . $search . '%')
                ->orWhereHas('series', function($query) use($search) {
                    $query->where('seriesName', 'LIKE', '%' . $search . '%');
                })
                ->with('series')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Brands::where('brandName', 'like', '%' . $search . '%')
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
        $lists = Brands::lists('brandName', 'brandId');
        return response($lists);
    }

}
