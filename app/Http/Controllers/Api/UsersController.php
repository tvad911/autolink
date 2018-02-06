<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Acl\User;
use App\Http\Requests\Api\UserCountAllRequest;
use App\Http\Requests\Api\UserCreatedRequest;
use App\Http\Requests\Api\UserUpdatedRequest;

class UsersController extends Controller
{
    protected $user_id;
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api-administrator');
        $this->user_id = \Auth::guard('api')->user() ? \Auth::guard('api')->user()->id : null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserCountAllRequest $request)
    {
        $keyword  = $request->keyword;
        $searchBy = $request->searchBy ? $request->searchBy : 'id';
        $all      = $request->all ? $request->all : 0;
        $status   = $request->status ? $request->status : 0;
        $inTrash  = $request->inTrash ? $request->inTrash : 0;
        $offset   = $request->offset ? $request->offset : 25;
        $orderBy  = $request->orderBy ? $request->orderBy : 'id';
        $sortBy   = $request->sortBy ? $request->sortBy : 'desc';

        $items = User::all()->last();

        if(isset($keyword) && $keyword != '' && $keyword != null)
        {
            $arr_searchBy = explode(";", $searchBy);
            if(sizeof($arr_searchBy) > 1)
            {
                $items = $items->where('id', $keyword)
                                ->orWhere('username', $keyword)
                                ->orWhere('email', $keyword);
            }
            else
            {
                $items = $items->search($searchBy, $keyword);
            }
        }

        if($inTrash == 1)
            $items = $items->onlyTrashed();

        if($all == 0){
            $items = $items->status($status);
        }

        $items = $items->orderBy($orderBy, $sortBy)->paginate($offset);

        $response = [
            'pagination' => [
                'total'       => $items->total(),
                'perPage'     => $items->perPage(),
                'currentPage' => $items->currentPage(),
                'lastPage'    => $items->lastPage(),
                'from'        => $items->firstItem(),
                'to'          => $items->lastItem()
            ],
            'data' => $items,
            'custom_data' => [
                'keyword'  => $keyword,
                'searchBy' => $searchBy,
                'all'      => $all,
                'status'   => $status,
                'inTrash'  => $inTrash,
                'offset'   => $offset,
                'orderBy'  => $orderBy,
                'sortBy'   => $sortBy,
            ]
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreatedRequest $request)
    {
        $created = new User;
        $created->email = $request->email;
        $created->username = $request->username;
        $created->name = $request->name;
        $created->password = $request->password;
        $created->api_token = str_random(60);
        $created->user_id = $this->user_id;
        $created->status = $request->status;
        $created->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User created success.',
                'created' => $created
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User information',
                'item' => $item
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User information',
                'item' => $item
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdatedRequest $request, $id)
    {
        $updated = User::find($id);
        $updated->email = $request->email;
        $updated->username = $request->username;
        $updated->name = $request->name;
        if($request->password != null && $request->password != '')
            $updated->password = $request->password;
        $updated->user_id = $this->user_id;
        $updated->status = $request->status;
        $updated->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User update success.',
                'updated' => $updated
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = User::destroy($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted
            ]);
        }
    }

    public function countAll(Request $request)
    {
        $all     = User::all()->count();
        $publish = User::all()->where('status', 1)->count();
        $draft   = User::all()->where('status', 0)->count();
        $inTrash = User::onlyTrashed()->get()->count();

        $response = [
            'all'     => $all,
            'publish' => $publish,
            'draft'   => $draft,
            'inTrash' => $inTrash
        ];

        return response()->json($response);
    }

    /**
     * [postUpdateMulti description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUpdateMulti(Request $request)
    {
        $listItem = $request->items;

        if(isset($request->doAction))
        {
            if($request->doAction == 'publish')
            {
                $params = array('status' => 1);
                foreach ($listItem as $item) {
                    $user = User::find($item);
                    $user->status = 1;
                    $user->save();
                }
            }
            elseif($request->doAction == 'draft')
            {
                $params = array('status' => 0);
                foreach ($listItem as $item) {
                    $user = User::find($item);
                    $user->status = 0;
                    $user->save();
                }
            }
            elseif($request->doAction == 'trash')
            {
                foreach ($listItem as $item) {
                    $user = User::find($item);
                    $user->delete();
                }
            }
            elseif($request->doAction == 'restore')
            {
                foreach ($listItem as $item) {
                    $user = User::withTrashed()->find($item);
                    $user->restore();
                }
            }
            elseif($request->doAction == 'foreDelete')
            {
                foreach ($listItem as $item) {
                    $user = User::withTrashed()->find($item);
                    $user->forceDelete();
                }
            }
        }

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User updated multi.'
            ]);
        }
    }
}