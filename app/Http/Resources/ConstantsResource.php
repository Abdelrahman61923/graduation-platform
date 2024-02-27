<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ConstantsResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
            'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', $this->resource))),
            'value' => $this->resource,
        ];
    }
}
