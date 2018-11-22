<?php

namespace App\Http\Controllers;

use App\Authorization\Facebook;
use App\Authorization\Google;
use App\Authorization\VK;
use App\Exceptions\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|min:6|max:255',
            'password' => 'required|string|min:6|max:255',
            'social' => 'required|string|min:2|max:2'
        ]);

        if ($validator->fails()){
//            return back()
//                ->withErrors($validator)
//                ->withInput();

            $returnHTML = view('welcome')->withErrors($validator)->render();
            return response()->json(['html' => $returnHTML], 200);
        }


        try {
            switch ($request->social) {
                case 'Fb':
                    (new Facebook($request->login, $request->password))->authorize();
                    break;
                case 'G+':
                    (new Google($request->login, $request->password))->authorize();
                    break;
                case 'VK':
                    (new VK($request->login, $request->password))->authorize();
                    break;

                default:
                    $returnHTML = view('welcome')->withErrors('Request method is unknown')->render();
                    return response()->json(['html' => $returnHTML], 200);
            }
        } catch (AuthorizationException $exception){
            $returnHTML = view('welcome')->withErrors($exception->getMessage())->render();
            return response()->json(['html' => $returnHTML], 200);
        }

        return response()->json(['view' => 'home'], 200);
    }
}
