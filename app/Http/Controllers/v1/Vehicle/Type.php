<?php

namespace App\Http\Controllers\v1\Vehicle;

use App\Models\Vehicle\Type as Types;

class Type extends \App\Http\Controllers\Controller {

    public function index() {
        $types = Types::with('series.brand', 'series.classification')->get();
        return response($types);
    }
    
    public function get($typeId) {
        $type = Types::with('series.brand', 'series.classification')->findOrFail($typeId);
        return response($type);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'typeName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Types::where('typeName', 'like', '%' . $search . '%')
                ->orWhereHas('series', function($query) use($search) {
                    $query->where('seriesName', 'LIKE', '%' . $search . '%');
                    $query->orWhereHas('brand', function($brand) use($search) {
                        $brand->where('brandName', 'LIKE', '%' . $search . '%');
                    });
                    $query->orWhereHas('classification', function($classification) use($search) {
                        $classification->where('classificationName', 'LIKE', '%' . $search . '%');
                    });
                })
                ->with('series.brand', 'series.classification')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Types::where('typeName', 'like', '%' . $search . '%')
                ->orWhereHas('series', function($query) use($search) {
                    $query->where('seriesName', 'LIKE', '%' . $search . '%');
                    $query->orWhereHas('brand', function($brand) use($search) {
                        $brand->where('brandName', 'LIKE', '%' . $search . '%');
                    });
                    $query->orWhereHas('classification', function($classification) use($search) {
                        $classification->where('classificationName', 'LIKE', '%' . $search . '%');
                    });
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
        $lists = Types::lists('typeName', 'typeId');
        return response($lists);
    }

}
