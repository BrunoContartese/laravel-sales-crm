<?php

namespace App\Services\Administration;

use App\Models\Administration\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompaniesService
{
    private $relations = [
        'plan'
    ];

    public function index($request)
    {
        $entities = Company::withTrashed()
            ->with($this->relations);

        return $entities->get();
    }

    public function paginated($request)
    {
        $entities = Company::withTrashed()
            ->with($this->relations);

        return $entities->paginate($request->page_size ?? 15);
    }

    public function findById($id)
    {
        return Company::withTrashed()->with($this->relations)->findOrFail($id);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $entity = Company::with($this->relations)->findOrFail($id);
            $entity->update([
                'fiscal_role_id' => $request->fiscal_role_id,
                'is_perception_agent' => $request->is_perception_agent,
                'name' => $request->name,
                'owner_name' => $request->owner_name,
                'document_number' => $request->document_number,
                'gross_incomes_document_number' => $request->gross_incomes_document_number,
                'activities_init_date' => $request->activities_init_date,
                'afip_key_file_url' => $request->afip_key_file_url,
                'afip_cert_file_url' => $request->afip_cert_file_url,
            ]);
            DB::commit();
            return $entity;
        } catch (\Error $e) {
            DB::rollBack();
            Log::warning("Ha ocurrido una excepción (CompaniesService.update): {$e->getMessage()}");
        }
    }

}
