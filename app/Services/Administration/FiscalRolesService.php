<?php

namespace App\Services\Administration;

use App\Models\Administration\FiscalRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FiscalRolesService
{
    private $relations = [];

    public function index()
    {
        $entities = FiscalRole::withTrashed()
            ->with($this->relations);
        return $entities->get();
    }

    public function paginated($request)
    {
        $entities = FiscalRole::withTrashed()
            ->with($this->relations);

        return $entities->paginate($request->page_size ?? 15);
    }

    public function findById($id)
    {
        return FiscalRole::withTrashed()->with($this->relations)->findOrFail($id);
    }
}
