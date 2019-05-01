<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21.04.2019
 * Time: 14:20
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;
use App\FnsLogin;


use Debugbar;

class FnsAuthController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('verified');
	}

	/**
	 * Registration in FNS.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function registration(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'name' => 'required',
			'phone' => 'required|numeric',
		]);

		$params = $request->all();

		$client = new Client();
		$result = $client->post(config('services.nfs.domain').'mobile/users/signup', [
					'Content-Type' => 'application/json',
					RequestOptions::JSON => $params
				]
		);

		return response()->json($result,200);
	}

	/**
	 * Login in FNS.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
		$request->validate([
			'phone' => 'required|numeric',
			'password' => 'required'
		]);

		$params = $request->all();

		$client = new Client();
		$result = $client->get(config('services.nfs.domain').'mobile/users/login', [
				'auth' => [
					$params['phone'],
					$params['password']
				],
			]
		);

		if ($result->getStatusCode() == 200) {
           FnsLogin::updateOrCreate(
                ['user_id' => Auth::id()],
                ['username' => $params['phone'], 'password' => $params['password']]);
		}

		return response()->json('',200);
	}

    public function remind(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric'
        ]);

        $sendParams = [
            'Content-Type' => 'application/json; charset=UTF-8',
            RequestOptions::JSON => $request->all()
        ];

        $client = new Client();
        $client->post(config('services.nfs.domain').'mobile/users/restore', $sendParams);


        return response()->json('',200);
    }

}