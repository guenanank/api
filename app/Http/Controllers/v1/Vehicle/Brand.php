<?php

namespace App\Http\Controllers\v1\Vehicle;

use Validator;
use Illuminate\Http\Request;
use App\Models\Vehicle\Brand as Brands;

class Brand extends \App\Http\Controllers\Controller {

    public function index() {
        $brands = Brands::with('series')->get();
        return response($brands);
    }

    public function get($brandId) {
        $brand = Brands::with('series')->findOrFail($brandId);
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

        if (empty($search)) :
            $rows = Brands::skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();
            $total = Brands::count();
        else :
            $rows = Brands::where('brandName', 'like', '%' . $search . '%')
                    ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)->get();

            $total = Brands::where('brandName', 'like', '%' . $search . '%')->count();
        endif;


        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), Brands::rules());
        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $create = Brands::create($request->all());
        return response(['create' => $create], 200);
    }

    public function update(Request $request, $brandId) {
        $brand = Brands::findOrFail($brandId);
        Brands::rules(['brandName' => 'required|string|max:127|unique:vehicle.brands,brandName,' . $brand->brandId . ',brandId']);
        $validator = Validator::make($request->all(), Brands::rules());

        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $update = $brand->update($request->all());
        return response(['update' => $update], 200);
    }

    public function destroy($brandId) {
        $brand = Brands::findOrFail($brandId);
        $delete = $brand->delete();
        return response(['delete' => $delete], $delete ? 200 : 422);
    }

    public function lists() {
        $lists = Brands::lists('brandName', 'brandId');
        return response($lists);
    }

}
