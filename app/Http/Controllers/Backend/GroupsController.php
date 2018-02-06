<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    /**
     * [__construct description]
     */
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('administrator');
    }

    public function index()
    {
        return view('backends.groups.index');
    }
}
