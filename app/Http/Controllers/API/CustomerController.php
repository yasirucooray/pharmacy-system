<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $users = Customer::all();

            // if ($request->q) {
            //     $users = $users->where('name', 'like', '%' . $request->q . '%');
            // }

            return response()->json(['payload' => $users, 'message' => '',  "result" => true], 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'Error',  "result" => false], 422);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
                'phone' => 'required|string|unique:customers',
                'address' => 'required|string',
                'gender' => 'required|string',
            ]);

            $customer = Customer::create($request->all());

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
            'age' => 'required|integer',
            'phone' => 'required|string|unique:customers',
            'address' => 'required|string',
            'gender' => 'required|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return response()->json($customer, 200);
    } catch (Throwable $th) {
        return response()->json(['message' => 'Error',  "result" => false], 422);
    }
    }

    public function destroy($id)
    {

        $customer = Customer::findOrFail($id);
        $customer->forceDelete();


        return response()->json(['message' => 'Customer deleted successfully']);
    }

    public function destroyManager($id)
    {
            $customer = Customer::findOrFail($id);
            $customer->delete();


        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
