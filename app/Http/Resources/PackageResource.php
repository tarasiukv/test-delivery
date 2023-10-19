<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'weight' => $this->weight,
            'user' => new UserResource($this->whenLoaded('user')),
            'deliveryService' => new DeliveryServiceResource($this->whenLoaded('deliveryService')),
            'delivery' => new DeliveryResource($this->whenLoaded('delivery')),
        ];
    }
}
