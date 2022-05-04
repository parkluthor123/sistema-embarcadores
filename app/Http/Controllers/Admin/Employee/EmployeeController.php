<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipper;
use App\Models\Company;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    private $employees;

    public function __construct(Employee $employees)
    {
        $this->employees = $employees;
    }

    public function index()
    {
        return view('pages.admin.employees.create-employees');
    }

    public function showEmployees()
    {
        $user = Auth::guard('employees')->user();
        $employees = null;

        if(Gate::allows('embarcadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('shipper')->first();
            $data = $data->shipper()->first();
            $employees = $this->employees->where('shippers_id', '=', $data->id)->get();
        }

        if(Gate::allows('transportadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('company')->first();
            $data = $data->company()->first();
            $employees = $this->employees->where('companys_id', '=', $data->id)->get();
        }

        return view('pages.admin.employees.show-employees', array(
            'employees' => $employees
        ));
    }

    public function storeEmployees(Request $request)
    {
        $user = Auth::guard('employees')->user();

        if(Gate::allows('embarcadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('shipper')->first();
            $data = $data->shipper()->first();

            $this->employees['name'] = $request->name;
            $this->employees['email'] = $request->email;
            $this->employees['password'] = Hash::make($request->password);
            $this->employees['role'] = $user->role;
            $this->employees['shippers_id'] = $data->id;

            if($this->employees->save())
            {
                return redirect()->back()->with('success', 'Funcionário salvo com sucesso!');
            }
            else{
                return redirect()->back()->with('error', 'Erro ao salvar o funcionário, tente novamente!');
            }
        }

        if(Gate::allows('transportadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('company')->first();
            $data = $data->company()->first();

            $this->employees['name'] = $request->name;
            $this->employees['email'] = $request->email;
            $this->employees['password'] = Hash::make($request->password);
            $this->employees['role'] = $user->role;
            $this->employees['companys_id'] = $data->id;

            if($this->employees->save())
            {
                return redirect()->back()->with('success', 'Funcionário salvo com sucesso!');
            }
            else{
                return redirect()->back()->with('error', 'Erro ao salvar o funcionário, tente novamente!');
            }
        }

    }

    public function editEmployees($id)
    {
        $employees = $this->employees->find($id);
        return view('pages.admin.employees.edit-employees', array(
            'employees' => $employees
        ));
    }

    public function updateEmployees(Request $request, $id)
    {
        $user = Auth::guard('employees')->user();

        if(Gate::allows('embarcadora'))
        {
            $data = Employee::where('id', '=', $user->id)->with('shipper')->first();
            $data = $data->shipper()->first();
            
            $employees = $this->employees->find($id);

            $employees['name'] = $request->name;
            $employees['email'] = $request->email;

            if($request->password != '' || !is_null($request->password))
            {
                $employees['password'] = Hash::make($request->password);
            }

            $employees['role'] = $user->role;
            $employees['shippers_id'] = $data->id;

            if($employees->save())
            {
                return redirect()->back()->with('success', 'Funcionário salvo com sucesso!');
            }
            else{
                return redirect()->back()->with('error', 'Erro ao salvar o funcionário, tente novamente!');
            }
        }

        if(Gate::allows('transportadora'))
        {
            $employees = $this->employees->find($id);

            $data = Employee::where('id', '=', $user->id)->with('company')->first();
            $data = $data->company()->first();

            $employees['name'] = $request->name;
            $employees['email'] = $request->email;

            if($request->password != '' || !is_null($request->password))
            {
                $employees['password'] = Hash::make($request->password);
            }

            $employees['companys_id'] = $data->id;

            if($employees->save())
            {
                return redirect()->back()->with('success', 'Funcionário salvo com sucesso!');
            }
            else{
                return redirect()->back()->with('error', 'Erro ao salvar o funcionário, tente novamente!');
            }
        }
    }

    public function deleteEmployees($id)
    {
        $employees = $this->employees->find($id);

        if($employees->delete())
        {
            return redirect()->back()->with('success', 'Funcionário excluído com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao excluir o funcionário, tente novamente!');
        }
    }
}
