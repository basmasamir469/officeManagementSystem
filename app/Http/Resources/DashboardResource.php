<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskResource;

class DashboardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'tasks' => TaskResource::collection($this->tasks),
            'summary' => $this->summary,
        ];
    }
}
