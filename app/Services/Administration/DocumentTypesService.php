<?php

namespace App\Services\Administration;

use App\Models\Administration\DocumentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentTypesService
{
    private $relations = [];

    public function index()
    {
        return DocumentType::with($this->relations)->get();
    }

    public function paginated($request)
    {
        $documentTypes = DocumentType::with($this->relations);

        return $documentTypes->paginate($request->page_size ?? 15);
    }

}
