<?php

namespace App\Services;

use App\Exceptions\CompanyException;
use App\Models\Company;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    public function companiesList(): LengthAwarePaginator
    {
        return Company::query()->paginate(10);
    }

    /**
     * @throws CompanyException
     */
    public function createCompany(array $validated): void
    {
        DB::beginTransaction();
        try {
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
    public function editCompany(array $validated, Company $company): Company
    {
        DB::beginTransaction();
        try {
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
