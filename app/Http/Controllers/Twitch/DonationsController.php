<?php

namespace maze\Http\Controllers\Twitch;

use Illuminate\Http\Request;
use maze\Http\Requests;
use maze\Http\Controllers\Controller;
use maze\Http\Requests\Donation as DonationRequest;
use maze\Channel;
use maze\Donation;
use maze\Events\DonationWasMade;
use Auth;
use WebToPay;

class DonationsController extends Controller
{

    public function alert(Channel $channel)
    {
        return view('twitch.donations.alert', compact('channel'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $username = ($user->streamer) ? $user->streamer->twitch : $user->username;
        }
        return view('twitch.donations.index', compact('channel', 'username'));
    }

    public function gateway(DonationRequest $request, Channel $channel)
    {
        $donation = new Donation($request->all());
        $channel->donations()->save($donation);
        
        WebToPay::redirectToPayment([
            'projectid'     => $channel->paysera_project_id,
            'sign_password' => $channel->paysera_sign_password,
            'orderid'       => $donation->id,
            'amount'        => floor($request->amount * 100),
            'currency'      => 'EUR',
            'country'       => 'LT',
            'accepturl'     => route('twitch.donations.accept'),
            'cancelurl'     => route('twitch.donations.cancel'),
            'callbackurl'   => route('twitch.donations.callback'),
            'test'          => 1,
        ]);
    }

    public function callback(Request $request, Channel $channel)
    {
        $response = WebToPay::checkResponse($request->all(), [
            'projectid'     => $channel->paysera_project_id,
            'sign_password' => $channel->paysera_sign_password
        ]);

        $donation = Donation::findOrFail($response['orderid']);
        if ($donation && !$donation->completed) {
            $donation->completed = true;
            $donation->save();

            //jei viskas gerai, poppinam alerta
            event(new DonationWasMade($channel, $donation));

            return 'OK';
        }

        return;
    }

    public function accept()
    {
        flash()->success('Pavedimas sėkmingai atliktas.');

        return redirect()->route('twitch.donations.index');
    }

    public function cancel()
    {
        flash()->error('Pavedimas atšauktas.');

        return redirect()->route('twitch.donations.index');
    }

    public function testAlert(Channel $channel)
    {
        $data = [
            'username'  => 'SkepticalHippo',
            'body'      => 'test donation',
            'amount'    => 4.20
        ];

        $donation = new Donation($data);

        event(new DonationWasMade($channel, $donation));

        return 'OK';
    }
}
