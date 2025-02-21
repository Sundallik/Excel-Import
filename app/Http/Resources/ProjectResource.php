<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type' => TypeResource::make($this->type),
            'title' => $this->title,
            'created_at_time' => $this->created_at_time->format('Y-m-d'),
            'is_chain' => $this->is_chain,
            'worker_count' => $this->worker_count,
            'has_outsource' => $this->has_outsource,
            'has_investors' => $this->has_investors,
            'deadline' => $this->deadline->format('Y-m-d'),
            'payments' => PaymentResource::collection($this->payments),
        ];
    }
}
