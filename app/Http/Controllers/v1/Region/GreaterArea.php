<?php

namespace App\Http\Controllers\v1\Region;

use Validator;
use Illuminate\Http\Request;
use App\Models\Region\GreaterArea as GreaterAreas;
use App\Models\Region\Regency as Regencies;

class GreaterArea extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $greaterArea = GreaterAreas::with('regencies')->all();
        return response($greaterArea);
    }

    public function get($greaterAreaId) {
        $greaterArea = GreaterAreas::with('regencies')->findOrFail($greaterAreaId);
        return response($greaterArea);
    }

    public function bootgrid(Request $request) {
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

    public function lists() {
        $lists = GreaterAreas::lists('greaterAreaName', 'greaterAreaId');
        return response($lists);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), GreaterAreas::rules());
        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        $create = GreaterAreas::create($request->all());
        $this->updateRegencies($request->input('regencyId'), $create->greaterAreaId);
        return response(['create' => $create], 200);
    }

    public function update(Request $request, $greaterAreaId) {
        $greaterArea = GreaterAreas::findOrFail($greaterAreaId);
        GreaterAreas::rules(['greaterAreaName' => 'required|string|max:127|unique:region.greaterAreas,greaterAreaName,' . $greaterArea->greaterAreaId . ',greaterAreaId']);
        $validator = Validator::make($request->all(), GreaterAreas::rules());

        if ($validator->fails()) :
            return response($validator->errors(), 422);
        endif;

        Regencies::where('greaterAreaId', $greaterArea->greaterAreaId)->update(['greaterAreaId' => null]);
        $update = $greaterArea->update($request->all());
        $this->updateRegencies($request->input('regencyId'), $greaterArea->greaterAreaId);
        return response(['update' => $update], 200);
    }

    public function destroy($greaterAreaId) {
        $greaterArea = GreaterAreas::findOrFail($greaterAreaId);
        Regencies::where('greaterAreaId', $greaterArea->greaterAreaId)->update(['greaterAreaId' => null]);
        $delete = $greaterArea->delete();
        return response(['delete' => $delete], $delete ? 200 : 422);
    }

    private function updateRegencies($regencies, $greaterAreaId = null) {
        foreach ($regencies as $regencyId) :
            Regencies::find($regencyId)->update(['greaterAreaId' => $greaterAreaId]);
        endforeach;
    }

}
