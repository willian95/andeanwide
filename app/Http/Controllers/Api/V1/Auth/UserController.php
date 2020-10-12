<?php

namespace App\Http\Controllers\Api\V1\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = DB::table('oauth_clients')->where('id', 3)->first();
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        try {
            $http = new Client;
            $response = $http->post(env('APP_URL') . 'oauth/token', [
                'form_params' => [
                    'grant_type'    => 'password',
                    'client_id'     => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username'      => $request->email,
                    'password'      => $request->password,
                    'scope'         => '*'
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad Request.'
            ], 400);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            $http = new Client;
            $response = $http->post(env('APP_URL') . 'oauth/token', [
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $request->refresh_token,
                    'client_id'     => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'scope'         => '*'
                ],
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad Request.'
            ], 500);
        }
    }

    public function revokeToken() {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json(null, 204);
    }
}
