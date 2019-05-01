<?php

namespace App\Http\Controllers;

use App\Check;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;

use Debugbar;

class CheckController extends Controller
{

    /*
    **
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('verified');
        $this->middleware('fns');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tables');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->all();

        $client = new Client();
        $client->get(config('services.nfs.domain').'ofds/*/inns/*/fss/'.$params['fn'].'/operations/'.$params['n'].'/tickets/'.$params['i'],
                [
                    'query' => [
                        'fiscalSign' => $params['fp'],
                        'date' => $params['t'],
                        'sum' => $params['s']*100,]
                ]
        );

        Debugbar::info(Auth::user()->fns);

        $client2 = new Client();
        //https://proverkacheka.nalog.ru:9999/v1/inns/*/kkts/*/fss/<Номер ФН>/tickets/<Номер ФД>?
        //fiscalSign=<Номер ФПД>&sendToEmail=no
        $result = $client2->get(config('services.nfs.domain').'inns/*/kkts/*/fss/'.$params['fn'].'/tickets/'.$params['i'],
            [
                'headers' => [
                    'device-id' => '',
                    'device-os' => ''
                ],
                'auth' => [
                    Auth::user()->fns->username,
                    Auth::user()->fns->password,
                ],
                'query' => [
                    'fiscalSign' => $params['fp'],
                    'sendToEmail' => 'no'
                    ]
            ]
        );

        Debugbar::info(json_decode($result->getBody()));

        return response('',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function show(Check $check)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function edit(Check $check)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Check $check)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Check  $check
     * @return \Illuminate\Http\Response
     */
    public function destroy(Check $check)
    {
        //
    }
}
