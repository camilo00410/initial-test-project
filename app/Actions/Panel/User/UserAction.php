<?php

namespace App\Actions\Panel\User;

use App\Actions\Panel\User\interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAction implements UserInterface
{
    public function store($request)
    {
        try {
            $input = $request->validated();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            return response()->json([
                'message' => '¡Saved Successfully!.',
            ], 200); 
        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => $th,
            ], 500); 
        }
    }
}