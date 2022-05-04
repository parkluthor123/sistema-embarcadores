<?php

namespace App\Http\Controllers\Admin\Shippers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Company;
use App\Models\Affiliate;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    private $shipper;
    private $company;


    public function __construct(Shipper $shipper, Company $company, Affiliate $affiliate)
    {
        $this->shipper = $shipper;
        $this->company = $company;
        $this->affiliate = $affiliate;
    }

    public function index()
    {  
        $user = Auth::guard('employees')->user();
        $shippers = $this->shipper  
        ->with('shipperAffiliate')->get();

        return view('pages.admin.shippers.show-shipper', array(
            'shippers' => $shippers,
            'userId' => $user->companys_id
        ));
    }

    public function storeAffiliation($id)
    {
        $user = Auth::guard('employees')->user();

        $this->affiliate['shippers_id'] = $id;
        $this->affiliate['companys_id'] = $user->companys_id;

        if($this->affiliate->save())
        {
            return redirect()->back()->with('success', 'Associado com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao se afiliar à embarcadora, tente novamente!');
        }
    }

    public function deleteAffiliation($id)
    {
        $user = Auth::guard('employees')->user();
        $affiliates = $this->affiliate->where('companys_id', '=', $user->companys_id)->where('shippers_id', '=', $id)->first();

        if($affiliates->delete())
        {
            return redirect()->back()->with('success', 'Desassociado com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao desafiliar, tente novamente!');
        }
    }
}
