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
        $fiscalRoles = FiscalRole::with($this->relations);
        return $fiscalRoles->get();
    }

    public function paginated($request)
    {
        $fiscalRoles = FiscalRole::with($this->relations);

        return $fiscalRoles->paginate($request->page_size ?? 15);
    }

    public function findById($id)
    {
        return FiscalRole::with($this->relations)->findOrFail($id);
    }
}
