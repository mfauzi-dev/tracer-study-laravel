<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fakultas' => new FakultasResource($this->fakultas),
            'program_studi' => new ProgramStudiResource($this->program_studi),
            'name' => $this->name,
            'nomor_induk' => $this->nomor_induk,
            'email' => $this->email,
            'role_as' => $this->role_as
        ];
    }
}
