<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\UpdateCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerService
{
    public function index(Request $request) {
        return Customer::all();
    }

    public function show($id) {
        $customer = Customer::find($id);
        return $customer;
    }

    public function create(string $name) {
        $customer = new Customer();
        $customer->name = $name;
        $customer->save();

        event(new CustomerCreation($customer));

        return $customer;
    }

    public function update(UpdateCustomer $request, $id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        $customer->name = $request->get("name");
        $customer->save();
        return $customer;
    }

    public function delete(Request $request, int $id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
        }
        $customer->delete();
        return response()->json(['status' => 'deleted'], Response::HTTP_OK);

    }
}
