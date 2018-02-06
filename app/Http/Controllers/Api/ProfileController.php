<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdatedPasswordRequest;
use App\Http\Requests\Api\UpdatedProfileRequest;
use App\Http\Requests\Api\UpdatedApiShortestUrlRequest;

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

    /**
     * [showApiShortestUrl description]
     * @return [type] [description]
     */
    public function showApiShortestUrl()
    {
        $item = \Auth::guard('api')->user();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User Information',
                'item' => $item
            ]);
        }
    }

    /**
     * [updateApiShortestUrl description]
     * @param  UpdatedApiShortestUrlRequest $request [description]
     * @return [type]                                [description]
     */
    public function updateApiShortestUrl(UpdatedApiShortestUrlRequest $request)
    {
        $api_123link   = $request->api_123link;
        $api_shortes   = $request->api_shortes;
        $api_megaurl   = $request->api_megaurl;
        $api_bitly     = $request->api_bitly;
        $api_googl     = $request->api_googl;
        $api_anotedpad = $request->api_anotedpad;
        $api_tiny      = $request->api_tiny;
        $api_default   = $request->api_default;

        $updated = \Auth::guard('api')->user();

        $updated->api_123link = $api_123link;
        $updated->api_shortes = $api_shortes;
        $updated->api_megaurl = $api_megaurl;
        $updated->api_bitly = $api_bitly;
        $updated->api_googl = $api_googl;
        $updated->api_anotedpad = $api_anotedpad;
        $updated->api_tiny = $api_tiny;
        $updated->api_default = $api_default;

        $updated->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User update ApiShortestUrl success.',
                'updated' => $updated
            ]);
        }
    }
}
