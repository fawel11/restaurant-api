<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Log::info($this->computed_discount);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name ?? '',
            'price' => $this->amount,
            'staus' => true,
            'computed_discount' => $this->when(isset($this->computed_discount), $this->computed_discount),
        ];
    }
}
