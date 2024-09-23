<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::all();
        return response()->json($offers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $offer = Offer::create($request->all());
        // Send notification to all shop owners
        $shopOwners = ShopOwner::all();
        Notification::send($shopOwners, new NewOfferNotification($offer));
        return response()->json($offer, 201);
    }

    public function show(Offer $offer)
    {
        return response()->json($offer);
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'shop_id' => 'sometimes|required|exists:shops,id',
        ]);

        $offer->update($request->all());
        return response()->json($offer);
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response()->json(null, 204);
    }
}
