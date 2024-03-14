<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Throwable;

class MedicinController extends Controller
{
    public function index(Request $request)
    {
        try {
            $med = Medicine::all();

            // if ($request->q) {
            //     $users = $users->where('name', 'like', '%' . $request->q . '%');
            // }

            return response()->json(['payload' => $med, 'message' => '',  "result" => true], 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'Error',  "result" => false], 422);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'quntity' => 'required|string',
                'brand' => 'required|string',
            ]);

            $customer = Medicine::create($request->all());

            return response()->json($customer, 201);
        } catch (Throwable $th) {
            return response()->json(['message' => 'Error',  "result" => false], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'quntity' => 'required|string',
            'brand' => 'required|string',
        ]);

        $customer = Medicine::findOrFail($id);
        $customer->update($request->all());

        return response()->json($customer, 200);
    } catch (Throwable $th) {
        return response()->json(['message' => 'Error',  "result" => false], 422);
    }
    }

    public function destroy($id)
    {

        $customer = Medicine::findOrFail($id);
        $customer->forceDelete();


        return response()->json(['message' => 'Medicine deleted successfully']);
    }

    public function destroyManager($id)
    {
            $customer = Medicine::findOrFail($id);
            $customer->delete();


        return response()->json(['message' => 'Medicine deleted successfully']);
    }
}
