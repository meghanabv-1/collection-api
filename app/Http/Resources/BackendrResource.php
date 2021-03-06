<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BackendrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)

    {
        return [
            'id'      => $this->id,
            'date' => $this->date,
            'accounthead'    => $this->accounthead,
            'description'    => $this->description,
            'debit'    => $this->debit,
            'credit'    => $this->credit,
            'cashbalance'    => $this->cashbalance,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'links'         => [
                'self' => route('backendr.show', ['backendr' => $this->id]),
            ],
        ];
    }
}
