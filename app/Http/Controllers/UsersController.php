<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(){
        return User::all();
    }
    public function destroy($id){
        $user=User::find($id);
        $id = Auth::id();
        $this->authorize('delete', $user);
        if($user->id!=$id)
        {
            $user->delete();
            return response()->json(
                [
                'message' => 'Success'
              ], 200);
        }
        else{
            return response()->json(['errors'=>$validator->errors()],422);
        }
    }
}
