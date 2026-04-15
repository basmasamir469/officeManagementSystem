<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        $isLate = $this->status === 'late' || ($this->deadline && $this->deadline->isPast() && $this->status !== 'completed');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'deadline' => optional($this->deadline)->toDateString(),
            'status' => Str::title($this->status),
            'is_late' => $isLate,
        ];
    }
}
