<?php

namespace App\Services;

use App\Exceptions\CompanyException;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\EditCompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function companiesList(): LengthAwarePaginator
    {
        return Company::query()->paginate(10);
    }

    /**
     * @throws CompanyException
     */
    public function createCompany(CreateCompanyRequest $request): void
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('', 'public');
                $validated['logo'] = $path;
            }
            Company::query()->create($validated);
            DB::commit();
        } catch (Exception $e) {
            throw new CompanyException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
    }

    /**
     * @throws CompanyException
     */
    public function editCompany(EditCompanyRequest $request, Company $company): Company
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            if ($request->hasFile('logo')) {
                if ($company->logo && Storage::exists('public/' . $company->logo)) {
                    Storage::delete('public/' . $company->logo);
                }

                $path = $request->file('logo')->store('', 'public');
                $validated['logo'] = $path;
            } else {
                unset($validated['logo']);
            }
            $company->update($validated);
            DB::commit();
        } catch (Exception $e) {
            throw new CompanyException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
        return $company;
    }

    /**
     * @throws CompanyException
     */
    public function deleteCompany(Company $company): void
    {
        DB::beginTransaction();
        try {
            $company->delete();
            DB::commit();
        } catch (Exception $e) {
            throw new CompanyException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
    }
}
