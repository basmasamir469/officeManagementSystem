<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AttendanceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'date' => optional($this->date)->toDateString(),
            'check_in' => optional($this->check_in_time)->format('H:i'),
            'check_out' => optional($this->check_out_time)->format('H:i'),
            'status' => Str::title($this->status),
        ];
    }
}
