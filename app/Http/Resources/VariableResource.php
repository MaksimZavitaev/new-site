<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariableResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sort' => $this->sort,
            'type' => $this->type,
            'data' => $this->data,
            'key' => $this->pivot->key,
            'pivot_id' => $this->pivot->id,
            'page_id' => $this->pivot->page_id,
            'is_list' => $this->pivot->is_list,
            'variable_id' => $this->page_variable_id,
        ];
    }
}
