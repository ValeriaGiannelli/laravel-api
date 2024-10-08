<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $success= true;

        // validazione
        $validator = Validator::make($data,
        [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|min:10',
        ],
        [
            'name.required' => 'il campo è obbligatorio',
            'email.required' => 'il campo è obbligatorio',
            'message.required' => 'il campo è obbligatorio',
            'name.string' => 'il campo deve essere una stringa',
            'email.email' => 'il campo deve essere una mail',
            'message.string' => 'il campo deve essere una stringa',
            'name.max' => 'il campo deve essere di massimo :max',
            'email.max' => 'il campo deve essere di massimo :max',
            'message.min' => 'il campo deve essere di minimo :min',
        ]
    );

    if($validator->fails()){
        $success=false;
        $errors = $validator->errors();
        return response()->json(compact('success', 'errors'));
    }

    // salvare il messaggio nel DB
    $new_lead = new lead();
    $new_lead->fill($data);
    $new_lead->save();

    // inviare la mail
    Mail::to($new_lead->email)->send(new NewContact($new_lead));
        return response()->json(compact('success'));
    }
}
