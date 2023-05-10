<?php

namespace App\Admin\Measures\Controllers;

use App\Controller;
use Domain\Measures\Models\Measures;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MeasureController extends Controller
{

    public function index(): View
    {
        return view('admin.measures.index');
    }

    public function edit(Measures $measure): View
    {
        return view('admin.measures.edit', [
            'measures' => $measure,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $measures = Measures::find($id);
        $wrong_measurements = [];

        if ($request->has('shoulder_wrong')) {
            $wrong_measurements['shoulder'] = true;
        } else {
            $wrong_measurements['shoulder']  = false;
        }
        if ($request->has('sleeve_length_wrong')) {
            $wrong_measurements['sleeve_length'] = true;
        } else {
            $wrong_measurements['sleeve_length'] = false;
        }
        if ($request->has('sleeve_interior_wrong')) {
            $wrong_measurements['sleeve_interior'] = true;
        } else {
            $wrong_measurements['sleeve_interior'] = false;
        }
        if ($request->has('neck_wrong')) {
            $wrong_measurements['neck'] = true;
        } else {
            $wrong_measurements['neck'] = false;
        }
        if ($request->has('biceps_wrong')) {
            $wrong_measurements['biceps'] = true;
        } else {
            $wrong_measurements['biceps'] = false;
        }
        if ($request->has('forearm_wrong')) {
            $wrong_measurements['forearm'] = true;
        } else {
            $wrong_measurements['forearm'] = false;
        }
        if ($request->has('waist_wrong')) {
            $wrong_measurements['waist'] = true;
        } else {
            $wrong_measurements['waist'] = false;
        }
        if ($request->has('hip_wrong')) {
            $wrong_measurements['hip'] = true;
        } else {
            $wrong_measurements['hip'] = false;
        }
        if ($request->has('torso_length_wrong')) {
            $wrong_measurements['torso_length'] = true;
        } else {
            $wrong_measurements['torso_length'] = false;
        }
        if ($request->has('back_shot_wrong')) {
            $wrong_measurements['back_shot'] = true;
        } else {
            $wrong_measurements['back_shot'] = false;
        }
        if ($request->has('torso_wrong')) {
            $wrong_measurements['torso'] = true;
        } else {
            $wrong_measurements['torso'] = false;
        }
        if ($request->has('total_length_wrong')) {
            $wrong_measurements['total_length'] = true;
        } else {
            $wrong_measurements['total_length'] = false;
        }
        if ($request->has('leg_wrong')) {
            $wrong_measurements['leg'] = true;
        } else {
            $wrong_measurements['leg'] = false;
        }
        if ($request->has('interior_leg_wrong')) {
            $wrong_measurements['interior_leg'] = true;
        } else {
            $wrong_measurements['interior_leg'] = false;
        }
        if ($request->has('leg_upper_wrong')) {
            $wrong_measurements['leg_upper'] = true;
        } else {
            $wrong_measurements['leg_upper'] = false;
        }
        if ($request->has('leg_lower_wrong')) {
            $wrong_measurements['leg_lower'] = true;
        } else {
            $wrong_measurements['leg_lower'] = false;
        }
        if ($request->has('calf_wrong')) {
            $wrong_measurements['calf'] = true;
        } else {
            $wrong_measurements['calf'] = false;
        }
        if ($request->has('rib_chest_wrong')) {
            $wrong_measurements['rib_chest'] = true;
        } else {
            $wrong_measurements['rib_chest'] = false;
        }
        if ($request->has('rib_rack_wrong')) {
            $wrong_measurements['rib_rack'] = true;
        } else {
            $wrong_measurements['rib_rack'] = false;
        }
        if ($request->has('chest_wrong')) {
            $wrong_measurements['chest'] = true;
        } else {
            $wrong_measurements['chest'] = false;
        }

        // Guardar mesures incorrectes i camp "reviewed" a la base de dades
        $measures->wrong_measurements = $wrong_measurements;
        $measures->reviewed = $request->input('reviewed') == '1';
        $measures->save();

        return redirect()
            ->route('admin.measures.edit', $measures)
            ->with('status', 'Wrong measurements have been updated.');

    }

    public function destroy(Measures $measures): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => "Measures with id $measures->id does not exist in the system.",
            'status' => 500
        ];

        if ($measures->delete()){
            $data = [
                'success' => true,
                'message' => `Measures with code <strong>{$measures->measure_code}</strong> have been deleted.`,
                'status' => 200
            ];
        }

        return response()->json($data, $data['status']);
    }

}
