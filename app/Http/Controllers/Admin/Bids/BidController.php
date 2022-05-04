<?php

namespace App\Http\Controllers\Admin\Bids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Offer;
use App\Models\Winner;
use Illuminate\Support\Facades\Auth;


class BidController extends Controller
{
    //
    private $offer;
    private $bid;
    private $winner;

    public function __construct(Bid $bid, Offer $offer, Winner $winner)
    {
        $this->bid = $bid;
        $this->offer = $offer;
        $this->winner = $winner;
    }
   
    public function addBid($id)
    {
        $currentOffer = $this->offer->find($id);
        return view('pages.admin.bid.create-bid', array(
            'currentOffer' => $currentOffer
        ));
    }

    public function storeBid(Request $request, $id)
    {
        $user = Auth::guard('employees')->user();
        $offers = $this->offer->find($id);
        $currentBid = $this->bid['value'] = $request->val_bid;   
        $currentBid = $this->bid['volume'] = $request->rangeBid;
        $currentBid = $this->bid['offers_id'] = $id;
        $currentBid = $this->bid['shippers_id'] = $offers->shippers_id;
        $currentBid = $this->bid['companys_id'] = $user->companys_id;

        if($this->bid->save())
        {
            return redirect()->route('admin.dashboard.shipper.see-offers')->with('success', 'Lance efetuado com sucesso!');
        }
        else{
            return redirect()->route('admin.dashboard.shipper.see-offers')->with('error', 'Erro ao efetuar o lance, tente novamente!');
        }
    }

    public function showBid()
    {
        $user = Auth::guard('employees')->user();

        $bids = $this->bid
                ->where('shippers_id', $user->shippers_id)
                ->with(['getBids', 'getCompany', 'getWinner'])
                ->get();

        return view('pages.admin.bid.show-bid', array(
            'bids' => $bids,
        ));
    }

    public function defineWinner($id)
    {

        $bid = $this->bid->with('getBids')->find($id);
        $offerId = $bid->getBids->id;
        // $winners = $this->winner->with(['getBids', 'getCompany'])->get();
        $this->winner['bid_id'] = $id;
        $this->winner['companys_id'] = $bid->companys_id;

        if($this->winner->save())
        {
            $offers = $this->offer->find($offerId);
            if($offers->qtd - $bid->volume == 0)
            {
                $offers['status'] = 0;
            }
            else
            {
                $offers['qtd'] = $offers['qtd'] - $bid->volume;
            }

            $offers->save();

            return redirect()->back()->with('success', 'Vencedor atribuido com sucesso!');
        }
        else{
            return redirect()->back()->with('error', 'Erro ao atribuir um vencedor, tente novamente!');
        }

    }
}
