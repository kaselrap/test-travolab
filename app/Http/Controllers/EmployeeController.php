<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use App\Model\Place;
use App\Model\WorkStatus;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function index()
    {
        return view('employees.index', ['employees' => Employee::getAllList()]);
    }

    /**
     * @param Employee $employee
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function showTimeTable(Employee $employee)
    {
        return response()->json([
            'success' => true,
            'modal' => view('employees.modal-timetable', ['employee' => $employee])->render()
        ]);
    }
    /**
     * @param Employee $employee
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function showScheduleModal(Employee $employee)
    {
        return response()->json([
            'success' => true,
            'modal' => view('employees.modal-schedule', ['employee' => $employee])->render()
        ]);
    }

    public function show(Employee $employee = null)
    {
        return view('employees.edit', ['employee' => $employee ? $employee : new Employee()]);
    }

    /**
     * @param Place|null $place
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Employee $employee = null)
    {
        $isNew = false;
        if (!$employee) {
            $employee = new Employee();
            $isNew = true;
        }

        $employee->setName(request()->input('name', []));

        if ($employee->save()) {
            if ($isNew) {
                $statuses = $employee->schedule()->create(\request()->input('work_statuses'));
            } else {
                foreach (\request()->input('work_statuses') as $key => $status) {
                    $employee->schedule->{$key} = $status;
                }

                $employee->schedule->save();
            }
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'failure' => true,
        ]);
    }

    /**
     * @param Place $place
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Employee $employee)
    {
        return response()->json([
            'success' => $employee->delete()
        ]);
    }
}
