<?php

namespace App\Http\Controllers;

use App\Exceptions\CompanyException;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\EditCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    public function __construct(protected CompanyService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('companies.index', ['data' => $this->service->companiesList()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws CompanyException
     */
    public function store(CreateCompanyRequest $request)
    {
        $this->service->createCompany($request);
        session()->flash('success', 'Company created successfully!');
        return redirect()->route('companies.index')->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): View
    {
        $employees = $company->employees()->paginate(10);
        return view('companies.show', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): View
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     * @throws CompanyException
     */
    public function update(EditCompanyRequest $request, Company $company)
    {
        $company = $this->service->editCompany($request->validated(), $company);
        return redirect()->route('companies.show', $company)->with('success', 'Company updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     * @throws CompanyException
     */
    public function destroy(Company $company): RedirectResponse
    {
        $this->service->deleteCompany($company);
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}
