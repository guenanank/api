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

        if (empty($search)) :
            $rows = Types::with('types.brand', 'types.classification')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();
            $total = Types::count();
        else :
            $rows = Types::where('typeName', 'like', '%' . $search . '%')
                    ->orWhereHas('types', function($query) use($search) {
                        $query->where('typesName', 'LIKE', '%' . $search . '%');
                        $query->orWhereHas('brand', function($brand) use($search) {
                            $brand->where('brandName', 'LIKE', '%' . $search . '%');
                        });
                        $query->orWhereHas('classification', function($classification) use($search) {
                            $classification->where('classificationName', 'LIKE', '%' . $search . '%');
                        });
                    })
                    ->with('types.brand', 'types.classification')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                    ->get();

            $total = Types::where('typeName', 'like', '%' . $search . '%')
                    ->orWhereHas('types', function($query) use($search) {
                        $query->where('typesName', 'LIKE', '%' . $search . '%');
                        $query->orWhereHas('brand', function($brand) use($search) {
                            $brand->where('brandName', 'LIKE', '%' . $search . '%');
                        });
                        $query->orWhereHas('classification', function($classification) use($search) {
                            $classification->where('classificationName', 'LIKE', '%' . $search . '%');
                        });
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
        $validator = Validator::make($request->all(), Types::rules());
        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $create = Types::create($request->all());
        return response(['create' => $create], 200);
    }

    public function update(Request $request, $typesId) {
        $type = Types::findOrFail($typesId);
        Types::rules(['typeName' => 'required|string|max:127|unique:vehicle.types,typeName,' . $type->typeId . ',typeId']);
        $validator = Validator::make($request->all(), Types::rules());

        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $update = $type->update($request->all());
        return response(['update' => $update], 200);
    }

    public function destroy($typeId) {
        $type = Types::findOrFail($typeId);
        $delete = $type->delete();
        return response(['delete' => $delete], $delete ? 200 : 422);
    }

    public function lists() {
        $lists = Types::lists('typeName', 'typeId');
        return response($lists);
    }

}
