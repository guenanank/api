<?php

namespace App\Http\Controllers\v1\Vehicle;

use App\Models\Vehicle\Vehicle as Vehicles;

class Vehicle extends \App\Http\Controllers\Controller {

    public function index() {
        $vehicles = Vehicles::with('type')->all();
        return response($vehicles);
    }
    
    public function get($vehicleId) {
        $vehicle = Vehicles::with('type')->findOrFail($vehicleId);
        return response($vehicle);
    }

    public function bootgrid(\Illuminate\Http\Request $request) {
        $current = $request->input('current', 1);
        $rowCount = $request->input('rowCount', 10);
        $skip = $current ? ($current - 1) * $rowCount : 0;
        $search = $request->input('searchPhrase');
        $sortColumn = 'vehicleName';
        $sortType = 'ASC';

        if (is_array($request->input('sort'))) :
            foreach ($request->input('sort') as $key => $value):
                $sortColumn = $key;
                $sortType = $value;
            endforeach;
        endif;

        $rows = Vehicles::where('vehicleName', 'like', '%' . $search . '%')
                ->orWhereHas('type', function($type) use($search) {
                    $type->where('typeName', 'LIKE', '%' . $search . '%');
                })
                ->with('type')
                ->skip($skip)->take($rowCount)->orderBy($sortColumn, $sortType)
                ->get();

        $total = Vehicles::where('vehicleName', 'like', '%' . $search . '%')
                ->count();

        return response([
            'current' => (int) $current,
            'rowCount' => (int) $rowCount,
            'rows' => $rows,
            'total' => $total
        ]);
    }

    public function lists() {
        $lists = Vehicles::lists('vehicleName', 'vehicleId');
        return response($lists);
    }
    
    public function listsGMC() {
        $lists = \App\Models\Vehicle\Type::lists('typeName', 'typeId');
        return response($lists);
    }

}
