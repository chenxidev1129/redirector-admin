<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'userList' => User::all()
        ]);
    }

    public function createUser(Request $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->save();

        $response = [
            'status' => 'successful',
            'user' => $user,
        ];
 
        return response()->json($response);
    }

    public function setEnabled(Request $request)
    {
        $id = $request->get('id');

        $user = User::find($id);

        if ($user) {
            $user->enabled = $request->get('enabled') == 'true' ? true : false;
            $user->save();

            $response = [
                'status' => 'successful',
                'user' => $user,
            ];

            return response()->json($response);
        } else {
            $response = [
                'status' => 'failed',
            ];

            return response()->json($response);
        }
    }

    public function getEnabled(Request $request)
    {
        $id = $request->get('id');

        $user = User::find($id);

        if($user) {
            $response = [
                'status' => 'successful',
                'enabled' => $user->enabled,
            ];

            return response()->json($response);
        } else {
            $response = [
                'status' => 'failed',
            ];

            return response()->json($response);
        }
    }
}
