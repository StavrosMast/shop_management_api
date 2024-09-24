<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'shop_owner_id' => 'required|exists:shop_owners,id',
            'shop_category_id' => 'required|exists:shop_categories,id',
            'description' => 'required|string',
            'open_hours' => 'required|string',
            'city' => 'required|string',
            'address' => 'nullable|string',
        ]);

        try {
            $shop = Shop::create($request->all());
            return response()->json($shop, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create shop',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Shop $shop)
    {
        return response()->json($shop);
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'sometimes|required|string',
            'shop_owner_id' => 'sometimes|required|exists:shop_owners,id',
            'shop_category_id' => 'sometimes|required|exists:shop_categories,id',
            'description' => 'sometimes|required|string',
            'open_hours' => 'sometimes|required|string',
            'city' => 'sometimes|required|string',
            'address' => 'nullable|string',
        ]);

        $shop->update($request->all());
        return response()->json($shop);
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return response()->json(null, 204);
    }
}
