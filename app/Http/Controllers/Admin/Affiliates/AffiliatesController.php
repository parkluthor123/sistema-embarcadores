<?php

namespace App\Http\Controllers\Admin\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Affiliate;
use Illuminate\Support\Facades\Auth;

class AffiliatesController extends Controller
{
    private $company;
    private $affiliates;

    public function __construct(Company $companys, Affiliate $affiliates)
    {
        $this->company = $companys;
        $this->affiliates = $affiliates;
    }

    public function index()
    {
        $user = Auth::guard('employees')->user();

        $affiliates = $this->company->get();

        $affiliateId = [];

        foreach ($affiliates as $affiliate) {
            if($affiliate->affiliate->first() != null)
            {
                array_push($affiliateId, $affiliate->affiliate->first()->companys_id);
            }
        }

        $companysAffiliated = $this->company->whereIn('id', $affiliateId)->get();

        return view('pages.admin.affiliates.show-affiliates', array(
            'affiliates' => $companysAffiliated
        ));
    }
}
