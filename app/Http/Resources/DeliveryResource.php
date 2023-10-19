<?php

namespace App\Http\Resources;

use App\Models\DeliveryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'delivered' => boolval($this->delivered),
            'delivery_service_id' => $this->delivery_service_id,
            'user_id' => $this->user_id,
            'package_id' => $this->package_id,
            'deliveryService' => new DeliveryServiceResource($this->whenLoaded('deliveryService')),
            'package' => new PackageResource($this->whenLoaded('package')),
            'user' => new UserResource($this->whenLoaded('package'))
        ];
    }
}
