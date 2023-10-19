<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = 10;
        $model = Package::paginate($per_page);;

        return PackageResource::collection($model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        $package = Package::create($request->validated());

        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return new PackageResource($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());

        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
