<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
	/**
     * [__construct description]
     */
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backends.users.index');
    }
}
