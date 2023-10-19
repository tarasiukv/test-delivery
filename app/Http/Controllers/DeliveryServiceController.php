<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryServiceRequest;
use App\Http\Resources\DeliveryServiceResource;
use App\Models\DeliveryService;
use Symfony\Component\HttpFoundation\Response;

class DeliveryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = 10;
        $model = DeliveryService::with([
            'deliveries',
            'packages',
        ]);

        return DeliveryServiceResource::collection($model->paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryServiceRequest $request)
    {
        $delivery_service = DeliveryService::create($request->validated());

        return new DeliveryServiceResource($delivery_service);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryService $delivery_service)
    {
        return new DeliveryServiceResource($delivery_service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryServiceRequest $request, DeliveryService $delivery_service)
    {
        $delivery_service->update($request->validated());

        return new DeliveryServiceResource($delivery_service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryService $delivery_service)
    {
        $delivery_service->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
