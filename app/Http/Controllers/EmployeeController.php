<?php

namespace App\Http\Controllers;

use App\Exceptions\EmployeeException;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Services\EmployeeService;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $service)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company): View
    {
        return view('employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws EmployeeException
     */
    public function store(CreateEmployeeRequest $request, Company $company): RedirectResponse
    {
        $this->service->createEmployee($request->validated(), $company);
        return redirect()->route('companies.show', $company)->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): View
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     * @throws EmployeeException
     */
    public function update(EditEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee = $this->service->updateEmployee($request->validated(), $employee);
        return redirect()->route('companies.show', $employee->company_id)->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @throws EmployeeException
     */
    public function destroy(Employee $employee)
    {
        $companyId = $employee->company_id;
        $this->service->deleteEmployee($employee);
        return redirect()->route('companies.show', $companyId)->with('success', 'Employee deleted successfully!');
    }
}
