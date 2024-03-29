<?php

namespace App\Http\Controllers;

use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Requests\UpdateCustomer;
use Crm\Customer\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request) {
        return $this->customerService->index($request);
    }

    public function show($id) {
        return $this->customerService->show($id) ?? response()->json(['status' => 'not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(CreateCustomer $request) {
        return $this->customerService->create($request->name);
    }

    public function update(UpdateCustomer $request, $id) {
        return $this->customerService->update($request, $id);
    }

    public function delete(Request $request, $id) {
        return $this->customerService->delete($request, (int) $id);
    }

}
