<?php

namespace App\Services\Accounting;

use App\Models\Accounting\SaleConcept;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleConceptsService
{
    private $relations = [];

    public function index($request)
    {
        $saleConcepts = SaleConcept::with($this->relations);

        if( $request->has('q') ) {
            $saleConcepts->where('name', 'LIKE', "%{$request->q}%");
        }

        if($request->has('status') && $request->status == '*') {
            $saleConcepts->withTrashed();
        } else if ($request->has('status') && $request->status == 2) {
            $saleConcepts->onlyTrashed();
        }

        if( $request->has('orderBy') ) {
            $saleConcepts->orderBy( $request->orderBy, $request->orderType );
        }

        return $saleConcepts->get();
    }
}
