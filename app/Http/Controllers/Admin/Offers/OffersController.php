<?php

namespace App\Http\Controllers\Admin\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;
use App\Models\Employee;
use App\Models\Affiliate;
use App\Models\Shipper;
use App\Models\Winner;
use App\Models\Bid;

class OffersController extends Controller
{
    private $offers;
    private $affiliate;
    private $shipper;
    private $winner;
    private $bids;

    public function __construct(Offer $offers, Affiliate $affiliate, Shipper $shipper, Winner $winner, Bid $bids)
    {
        $this->bids = $bids;
        $this->offers = $offers;
        $this->affiliate = $affiliate;
        $this->shipper = $shipper;
        $this->winner = $winner;
    }

    public function index()
    {
        return view('pages.admin.offers.create-offers');
    }

    public function registerOffers(Request $request)
    {
        $this->offers['product'] = $request->produto;
        $this->offers['qtd'] = $request->qtd;
        $this->offers['collect_address'] = $request->end_coleta;
        $this->offers['delivery_address'] = $request->end_entrega;
        $this->offers['shippers_id'] = Auth::guard('employees')->user()->shippers_id;
        $this->offers['status'] = 1;

        if($this->offers->save())
        {
            return redirect()->back()->with('success', 'Oferta salva com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao salvar a oferta, tente novamente!');
        }
    }

    public function showOffers()
    {

        $user = Auth::guard('employees')->user();

        $offers = $this->offers->where('shippers_id', '=', $user->shippers_id)->get();
        return view('pages.admin.offers.show-offers', array(
            'offers' => $offers
        ));
    }

    public function editOffers($id)
    {
        $offers = $this->offers->find($id);
        return view('pages.admin.offers.edit-offers', array(
            'offers' => $offers
        ));
    }

    public function updateOffers(Request $request, $id)
    {
        $offer = $this->offers->find($id);
        $offer['product'] = $request->produto;
        $offer['qtd'] = $request->qtd;
        $offer['collect_address'] = $request->end_coleta;
        $offer['delivery_address'] = $request->end_entrega;

        if($offer->save())
        {
            return redirect()->back()->with('success', 'Oferta salva com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao salvar a oferta, tente novamente!');
        }
    }

    public function deleteOffers($id)
    {
        $offer = $this->offers->find($id);
        if($offer->delete())
        {
            return redirect()->back()->with('success', 'Oferta excluída com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao excluir a oferta, tente novamente!');
        }
    }

    public function seeOffers()
    {
        $user = Auth::guard('employees')->user();

        $shippers = $this->shipper->get();

        $AffiliateIds = [];

        foreach ($shippers as $shipper) {
            if($shipper
                ->shipperAffiliate
                ->where('companys_id', $user->companys_id)
                ->first() != null)
            {
                array_push($AffiliateIds,
                            $shipper
                                ->shipperAffiliate
                                ->where('companys_id', $user->companys_id)
                                ->first()
                                ->shippers_id);
            }
        }

        $affiliatedOffer = $this->offers->with('getBid')->whereIn('shippers_id', $AffiliateIds)->where('status', 1)->get();

        return view('pages.admin.offers.see-offers', array(
            'offers' => $affiliatedOffer,
            'user' => $user
        ));
    }

    public function winnerOffers()
    {
        $user = Auth::guard('employees')->user();
        $winners = $this->winner->where('companys_id', $user->companys_id)->get();
        $winnersBidId = [];

        foreach ($winners as $winner) {
            array_push($winnersBidId, $winner->bid_id);
        }

        $offers = $this->bids->whereIn('id', $winnersBidId)->with('getBids')->get();

        return view('pages.admin.offers.winner-offers', array(
            'offers' => $offers,
        ));
    }
}
