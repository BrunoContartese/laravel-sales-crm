<?php

namespace App\Imports\Administration;

use App\Models\Accounting\PriceList;
use App\Models\Administration\Customer;
use App\Models\Administration\DeliveryZone;
use App\Models\Administration\DocumentType;
use App\Models\Administration\FiscalRole;
use App\Models\Administration\Seller;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomersImport implements ToModel, WithValidation, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $documentType = DocumentType::where('name','like',$row['tipo_de_documento'])->first();
        $fiscalRole = FiscalRole::where('name','like',$row['condicion_fiscal'])->first();
        $priceList = PriceList::where('name','like',$row['lista_de_precios'])->first();
        $deliveryZone = DeliveryZone::where('name','like',$row['zona_de_entrega'])->first();
        $seller = Seller::where('document','like',$row['vendedor'])->first();

        return new Customer([
            'given_name' => $row['nombre'],
            'family_name' => $row['apellido'],
            'address' => $row['direccion'],
            'document_type_id' => $documentType->id,
            'document' => $row['numero_de_documento'],
            'email' => $row['email'],
            'phone_number'  => $row['numero_de_telefono'],
            'cellphone_number'  => $row['numero_de_celular'],
            'fiscal_role_id'  => $fiscalRole->id,
            'price_list_id' => $priceList->id,
            'delivery_zone_id' => $deliveryZone->id,
            'seller_id' => $seller->id,
            'enable_current_account' => false,
        ]);
    }

    public function rules(): array 
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '3' => 'required|exists:document_types,name',
            '4' => 'required',
            '5' => 'nullable|email',
            '8' => 'required|exists:fiscal_roles,name',
            '9' => 'required|exists:delivery_zones,name',
            '10' => 'required|exists:sellers,document'
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
