<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees');
    }

    public function scrollIndex()
    {
        return view('employees');
    }

    public function getEmployee(Request $request)
    {
        // $employees = DB::table('employees')->get();
        // $employees = DB::table('employees')
        //     ->leftJoin('titles', 'employees.emp_no', '=', 'titles.emp_no')
        //     ->select('employees.*', 'titles.title')
        //     ->get();

        $employees = DB::table('employees')
        ->leftJoin('titles', 'employees.emp_no', '=', 'titles.emp_no')
        ->select('employees.*', 'titles.title');

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $employees->where(function($q) use ($search) {
                $q->where('employees.first_name', 'like', "%$search%")
                    ->orWhere('employees.last_name', 'like', "%$search%")
                    ->orWhere('employees.emp_no', 'like', "%$search%")
                    ->orWhere('titles.title', 'like', "%$search%");
            });
        }


        $employees = $employees->get();


        $employees->transform(function($employee) {
            $employee->hire_date = date("F j, Y", strtotime($employee->hire_date));
            $employee->birth_date = date("F j, Y", strtotime($employee->birth_date));
            $employee->gender = $employee->gender === 'F' ? 'Female' : 'Male';

            return $employee;
        });

        return datatables()->of($employees)->toJson();
    }


    public function testZiggy($id)
    {
        $employee = DB::table('employees')->where('emp_no', $id)->first();
        return view('details', compact('employee', 'id'));
    }



}
