<?php namespace App\Http\Controllers\App\Api;

use App\Domain\Services\UserServices;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class MembersController extends ApiController
{

    /**
     * @var UserServices
     */
    private $userServices;

    /**
     * @param UserServices $userServices
     */
    public function __construct(UserServices $userServices)
    {

        $this->userServices = $userServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postRegister(Request $request)
    {

        $name = Input::get('name');
        $email = Input::get('email');
        $password = Input::get('password');

        $user = $this->userServices->register($name, $email, $password);

        if($user){

            $credentials = $request->only('name', 'email', 'password');
            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return Response::json([
                'token' => $token,
                'data' => $this->transform($user)
            ],200);
        }else{
            return Response::json([
                'error' => [
                    'message' => 'could not create new user'
                ]
            ],500);
        }
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            Auth::attempt($credentials);

            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return Response::json([
            'token' => $token,
            'data' => $this->transform(Auth::user())
        ],200);
    }

    public function getInfo()
    {
        $user = JWTAuth::parseToken()->authenticate();
        var_dump($user);
    }

    /**
     * @param User $user
     * @return array
     */
    private function transform(User $user)
    {
        return [
            'email' => $user->email,
            'name' => $user->name
        ];
    }
}
