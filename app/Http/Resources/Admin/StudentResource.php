<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nisn' => $this->nisn,
            'email' => $this->email,
            'phone' => $this->phone,
            'classroom' => [
                'id' => $this->classroom->id,
                'name' => $this->classroom->name,
            ],
            'status' => $this->status,
        ];
    }
}
