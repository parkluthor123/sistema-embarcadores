<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Shipper;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    private $employee;
    private $shipper;
    private $company;

    public function __construct(Employee $employees, Shipper $shippers, Company $companys)
    {
        $this->employee = $employees;
        $this->shipper = $shippers;
        $this->company = $companys;
    }

    public function registerAccount()
    {
        return view('pages.register');
    }

    public function doRegisterAccount(Request $request)
    {
        $role = $request->role;
        if($role == 'embarcadora')
        {
            $this->shipper['name'] = $request->name;
            $this->shipper['cnpj'] = $request->cnpj;
            $this->shipper['address'] = $request->address;
            if($this->shipper->save())
            {
                $this->employee['name'] = $request->username;
                $this->employee['email'] = $request->email;
                $this->employee['password'] = Hash::make($request->password);
                $this->employee['role'] = $request->role;
                $this->employee['is_admin'] = 1;
                $this->employee['shippers_id'] = $this->shipper->id;
                if($this->employee->save())
                {
                    return redirect('/')->with('success', 'Salvo com sucesso, acesse agora com seu usuario e senha');
                }
                else
                {
                    return redirect('/')->with('error', 'Falha ao salvar, tente novamente mais tarde');
                }
            }
            else
            {
                return redirect('/')->with('error', 'Falha ao salvar, tente novamente mais tarde');
            }
        }
        else
        {
            $this->company['name'] = $request->name;
            $this->company['cnpj'] = $request->cnpj;
            $this->company['address'] = $request->address;

            if($this->company->save())
            {
                $this->employee['name'] = $request->username;
                $this->employee['email'] = $request->email;
                $this->employee['password'] = Hash::make($request->password);
                $this->employee['role'] = $request->role;
                $this->employee['is_admin'] = 1;
                $this->employee['companys_id'] = $this->company->id;

                if($this->employee->save())
                {
                    return redirect('/')->with('success', 'Salvo com sucesso, acesse agora com seu usuario e senha');
                }
                else
                {
                    return redirect('/')->with('error', 'Falha ao salvar, tente novamente mais tarde');
                }
            }
            else
            {
                return redirect('/')->with('error', 'Falha ao salvar, tente novamente mais tarde');
            }
        }
    }
}
