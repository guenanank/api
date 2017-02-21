<?php

namespace App\Http\Controllers\v1\Vehicle;

class Series extends \App\Http\Controllers\Controller {

    public function index() {
        $series = \App\Models\Vehicle\Series::with('series', 'classification')->get();
        return response($series);
    }

    public function get($seriesId) {
        $series = \App\Models\Vehicle\Series::with('series', 'classification')->findOrFail($seriesId);
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

        if (empty($search)) :
            $rows = \App\Models\Vehicle\Series::with('series', 'classification')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();
            $total = \App\Models\Vehicle\Series::count();
        else :
            $rows = \App\Models\Vehicle\Series::where('seriesName', 'like', '%' . $search . '%')
                    ->orWhereHas('series', function($query) use($search) {
                        $query->where('seriesName', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('classification', function($query) use($search) {
                        $query->where('classificationName', 'LIKE', '%' . $search . '%');
                    })
                    ->with('series', 'classification')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = \App\Models\Vehicle\Series::where('seriesName', 'like', '%' . $search . '%')
                    ->orWhereHas('series', function($query) use($search) {
                        $query->where('seriesName', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('classification', function($query) use($search) {
                        $query->where('classificationName', 'LIKE', '%' . $search . '%');
                    })
                    ->count();
        endif;


        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), \App\Models\Vehicle\Series::rules());
        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $create = \App\Models\Vehicle\Series::create($request->all());
        return response(['create' => $create], 200);
    }

    public function update(Request $request, $seriesId) {
        $series = \App\Models\Vehicle\Series::findOrFail($seriesId);
        \App\Models\Vehicle\Series::rules(['seriesName' => 'required|string|max:127|unique:vehicle.series,seriesName,' . $series->seriesId . ',seriesId']);
        $validator = Validator::make($request->all(), \App\Models\Vehicle\Series::rules());

        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $update = $series->update($request->all());
        return response(['update' => $update], 200);
    }

    public function destroy($seriesId) {
        $series = \App\Models\Vehicle\Series::findOrFail($seriesId);
        $delete = $series->delete();
        return response(['delete' => $delete], $delete ? 200 : 422);
    }
    
    public function lists() {
        $lists = \App\Models\Vehicle\Series::lists('seriesName', 'seriesId');
        return response($lists);
    }

}
