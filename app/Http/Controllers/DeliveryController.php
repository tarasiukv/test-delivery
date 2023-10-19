<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Symfony\Component\HttpFoundation\Response;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = 10;
        $model = Delivery::with([
            'deliveryService',
            'package',
            'user'
        ]);

        return DeliveryResource::collection($model->paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryRequest $request)
    {
        $delivery = Delivery::create($request->validated());

        return new DeliveryResource($delivery);
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return new DeliveryResource($delivery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->validated());

        return new DeliveryResource($delivery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
