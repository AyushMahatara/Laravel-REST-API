<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        // $filter = new CustomerFilter();
        // $queryItems = $filter->transform($request);

        // if (count($queryItems) == 0) {
        //     return new CustomerCollection(Customer::paginate());
        // } else {
        //     $customers = Customer::where($queryItems)->paginate();
        //     return new CustomerCollection($customers->appends($request->query()));
        // }

        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);
        $includeInvoices = $request->query('includeInvoices');
        $customers = Customer::where($filterItems);
        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }

    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');
        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
