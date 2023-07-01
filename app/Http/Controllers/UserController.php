<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Services\InforuSMSService;

class UserController extends Controller
{

    /**
     * Register a new user.
     */
    public function register(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'country'=> 'required',
            'phoneNumber'=> 'required',
            'email'=> 'required|email|unique:users',
        ]);

        $errors = $validator->errors()->all();

        if (count($errors)) {
            return response()->json(['errors' => $errors], 403);
        }else{

            try {
                $countryData = [
                    "country" =>  $request->get('country'),
                ];
                $phoneBookData = [
                    "phone_number" =>  $request->get('phoneNumber'),
                ];

                //Create user
                $user->full_name = $request->get('fullName');
                $user->email = $request->get('email');
                $user->save();

                //Create user country
                $user->country()->create($countryData);
                //Create user phone book
                $user->phoneBook()->create($phoneBookData);

                //Send email to user
                Mail::to($request->get('email'))->send(new UserRegistered());

                //Send sms
                $sendSMS = new InforuSMSService();
                $sendSMS->sendMessage($request->get('phoneNumber'), "User successfully registered!");

                return response()->json(['message' => 'User registered successfully!'], 201);
            }catch(Exception $e) {
                return response()->json(['message' => 'Something went wrong'], 400);
            }

        }
    }
}
