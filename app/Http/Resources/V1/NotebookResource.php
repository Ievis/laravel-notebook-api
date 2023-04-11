<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->with = [
            'success' => true,
            'error-code' => 0
        ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'company' => $this->company,
            'image' => $this->image,
            'birthday' => $this->birthday,
            'user_id' => $this->user_id
        ];
    }
}
