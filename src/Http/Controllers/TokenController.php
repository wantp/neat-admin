<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Wantp\Neat\Http\Requests\TokenIssueRequest;
use Wantp\Neat\Models\User;

class TokenController extends Controller
{
    /**
     * @param TokenIssueRequest $request
     * @return mixed
     * @throws ValidationException
     */
    public function issue(TokenIssueRequest $request)
    {
        /**
         * @var $user User
         */
        $user = User::where('username', $request->get('username'))->first();

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                __('The provided credentials are incorrect.')
            ]);
        }

        return ['access_token' => $user->createToken('')->plainTextToken];
    }

    /**
     * @param Request $request
     * @return string[]
     */
    public function delete(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successMessage();
    }
}