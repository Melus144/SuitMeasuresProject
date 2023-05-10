<?php


namespace App;

use Domain\Measures\Models\Measures;

class DatatableController extends Controller
{
    public function listMeasures(): JsonResponse
    {
        return datatables()
            ->eloquent(Measures::query()->orderBy('updated_at', 'desc'))
            ->addColumn('updated_at_formatted', function ($order) {
                return $order->updated_at->format('d/m/Y H:i:s');
            })
            ->addColumn('btn', 'admin.measures.partials._actions')

            ->rawColumns(['btn'])
            ->toJson();
    }

}
