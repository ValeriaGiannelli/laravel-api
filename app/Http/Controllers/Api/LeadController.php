<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'message' => 'required|string|min:100',
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
        return response()->json(compact('data','success'));
    }
}
