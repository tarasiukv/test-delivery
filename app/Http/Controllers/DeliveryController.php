<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use App\Models\DeliveryService;
use App\Models\User;
use App\Services\NovaPostService;
use Illuminate\Http\Request;
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

    public function sendDeliveryData(Request $request)
    {

        $delivery_service = DeliveryService::where('slug', $request->service_slug)->first();
        if (!$delivery_service) {
            return response()->json(['message' => 'Delivery service is missing'], 422);
        }
        $user = User::findOrFail($request->user_id);
        $data = [
            'customer_name' => $user->name,
            'phone_number' => $user->phone,
            'email' => $user->email,
            'sender_address' => config('general.shop_address'),
            'delivery_address' => $user->address
        ];

        switch ($request->service_slug) {
            case 'nova_post':
                $post_service = new NovaPostService();
                if ($post_service->deliveryData($data)) {
                    Delivery::create([
                        'delivery_service_id' => $delivery_service->id,
                        'user_id' => $user->id,
                        'package_id' ,
                        'delivery_address',
                        'sent_at',
                    ]);

                    return $post_service->delivery_data_response;
                }


//            case 'ukr_post':
//                $post_service = new UkrPostService();
//                $post_service->deliveryData($request->data);

//                return $post_service->delivery_data_response;

//                ...
        }
    }
}
