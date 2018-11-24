<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignup as UserSignupRequest;
use App\Http\Requests\UserLogin as UserLoginRequest;
use App\Repositories\UserRepository;
use App\Services\Auth\ApiAuth;
use App\Services\Bytom\Node;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 *
 */
class UserController extends Controller
{

    /**
     * @param UserSignupRequest $request
     * @param UserRepository $repository
     * @param ApiAuth $apiAuth
     * @return array
     */
    public function signup(UserSignupRequest $request, UserRepository $repository, ApiAuth $apiAuth)
    {
        $user = $repository->create($request->username, $request->password);
        $token = $apiAuth->make($user);

        //TODO make resource
        return [
            'token' => $token,
            'user' => $user
        ];
    }

    /**
     * @param UserLoginRequest $request
     * @param UserRepository $repository
     * @param ApiAuth $apiAuth
     * @return array
     * @throws \Exception
     */
    public function login(UserLoginRequest $request, UserRepository $repository, ApiAuth $apiAuth)
    {
        if ( $user = $repository->verifyPassword($request->username, $request->password) ) {
            $token = $apiAuth->make($user);

            //TODO make resource
            return [
                'token' => $token,
                'user' => $user,
            ];
        }

        //TODO make custom exception
        throw new \Exception("Login can not be done.");
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * @return int
     */
    public function unspents()
    {
        $node = resolve(Node::class);
        dd($node->list_balances());

        return 1;
    }
}
