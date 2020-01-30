<?php
namespace ConfrariaWeb\Entrust\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Select2RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->display_name
        ];
    }
}
