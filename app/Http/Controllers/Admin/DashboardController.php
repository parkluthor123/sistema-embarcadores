<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Shipper;
use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::guard('employees')->user();
        $data = null;

        if(Gate::allows('embarcadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('shipper')->first();
            $data = $data->shipper()->first();
        }

        if(Gate::allows('transportadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('company')->first();
            $data = $data->company()->first();
        }

        return view('pages.admin.dashboard', array(
            'name' => Auth::guard('employees')->user()->name,
            'role' => Auth::guard('employees')->user()->role,
            'company' => $data,
        ));
    }
}
