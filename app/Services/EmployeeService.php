<?php

namespace App\Services;

use App\Exceptions\EmployeeException;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EmployeeService
{

    public function employeesList(Company $company): LengthAwarePaginator
    {
        return $company->employees()->paginate(10);
    }

    /**
     * @throws EmployeeException
     */
    public function createEmployee(array $validated, Company $company): void
    {
        DB::beginTransaction();
        try {
            $company->employees()->create($validated);
            DB::commit();
        } catch (Exception $e) {
            throw new EmployeeException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
    }

    /**
     * @throws EmployeeException
     */
    public function updateEmployee(array $validated, Employee $employee): Employee
    {
        DB::beginTransaction();
        try {
            $employee->update($validated);
            DB::commit();
        } catch (Exception $e) {
            throw new EmployeeException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
        return $employee;
    }

    /**
     * @throws EmployeeException
     */
    public function deleteEmployee(Employee $employee): void
    {
        DB::beginTransaction();
        try {
            $employee->delete();
            DB::commit();
        } catch (Exception $e) {
            throw new EmployeeException($e->getMessage(), $e->getCode());
        } finally {
            DB::rollBack();
        }
    }
}
