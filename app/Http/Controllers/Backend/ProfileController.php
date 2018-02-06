<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * [__construct description]
     */
	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        return view('backends.profile.showProfile');
    }

    /**
     * [showProfile description]
     * @return [type] [description]
     */
    public function editProfile()
    {
        return view('backends.profile.editProfile');
    }

    /**
     * [showProfile description]
     * @return [type] [description]
     */
    public function editPassword()
    {
        return view('backends.profile.editPassword');
    }
}
