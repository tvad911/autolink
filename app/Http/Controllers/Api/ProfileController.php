<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdatedPasswordRequest;
use App\Http\Requests\Api\UpdatedProfileRequest;

class ProfileController extends Controller
{
	protected $user_id;

	/**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user_id = \Auth::guard('api')->user() ? \Auth::guard('api')->user()->id : null;
    }

	/**
	 * [showProfile description]
	 * @return [type] [description]
	 */
    public function showProfile()
    {
    	$item = \Auth::guard('api')->user();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User profile',
                'item' => $item
            ]);
        }
    }

    /**
     * [editProfile description]
     * @return [type] [description]
     */
    public function editProfile()
    {
    	$item = \Auth::guard('api')->user();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User profile',
                'item' => $item
            ]);
        }
    }

    /**
     * [updateProfile description]
     * @return [type] [description]
     */
    public function updateProfile(UpdatedProfileRequest $request)
    {
    	$name = $request->name;
    	$username = $request->username;

    	$updated = \Auth::guard('api')->user();

    	$updated->name = $name;
    	$updated->username = $username;
    	$updated->save();

    	if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User update profile success.',
                'updated' => $updated
            ]);
        }
    }

    /**
     * [editPassword description]
     * @return [type] [description]
     */
    public function editPassword()
    {
    	$item = \Auth::guard('api')->user();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Edit Password',
                'item' => $item
            ]);
        }
    }

    /**
     * [updatePassword description]
     * @return [type] [description]
     */
    public function updatePassword(UpdatedPasswordRequest $request)
    {
    	$password = $request->password;
    	$old_password = $request->old_password;

    	$updated = \Auth::guard('api')->user();

    	if(\Hash::check($old_password, $updated->password))
			$updated->password = \Hash::make($password);

    	$updated->save();

    	if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User update profile success.',
                'updated' => $updated
            ]);
        }
    }
}
