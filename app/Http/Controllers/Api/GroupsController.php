<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Acl\Group;
use App\Http\Requests\Api\GroupCountAllRequest;
use App\Http\Requests\Api\GroupCreatedRequest;
use App\Http\Requests\Api\GroupUpdatedRequest;

class GroupsController extends Controller
{
    protected $user_id;
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api-administrator')->except(array('index', 'show', 'edit'));
        $this->user_id = \Auth::guard('api')->user() ? \Auth::guard('api')->user()->id : null;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupCountAllRequest $request)
    {
        $keyword  = $request->keyword;
        $searchBy = $request->searchBy ? $request->searchBy : 'id';
        $all      = $request->all ? $request->all : 0;
        $status   = $request->status ? $request->status : 0;
        $inTrash  = $request->inTrash ? $request->inTrash : 0;
        $offset   = $request->offset ? $request->offset : 25;
        $orderBy  = $request->orderBy ? $request->orderBy : 'id';
        $sortBy   = $request->sortBy ? $request->sortBy : 'desc';

        $items = Group::all()->last();

        if(isset($keyword) && $keyword != '' && $keyword != null)
        {
            $arr_searchBy = explode(";", $searchBy);
            if(sizeof($arr_searchBy) > 1)
            {
                $items = $items->where('id', $keyword)
                                ->orWhere('name', $keyword)
                                ->orWhere('slug', $keyword);
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
    public function store(GroupCreatedRequest $request)
    {
        $created = new Group;
        $created->name = $request->name;
        $created->slug = $request->slug;
        $created->description = $request->description;
        $created->user_id = $this->user_id;
        $created->status = $request->status;
        $created->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group created success.',
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
        $item = Group::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group information',
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
        $item = Group::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group information',
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
    public function update(GroupUpdatedRequest $request, $id)
    {
        $updated = Group::find($id);
        $updated->name = $request->name;
        $updated->slug = $request->slug;
        $updated->description = $request->description;
        $updated->user_id = $this->user_id;
        $updated->status = $request->status;
        $updated->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group update success.',
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
        $deleted = Group::destroy($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group deleted.',
                'deleted' => $deleted
            ]);
        }
    }

    public function countAll(Request $request)
    {
        $all     = Group::all()->count();
        $publish = Group::all()->where('status', 1)->count();
        $draft   = Group::all()->where('status', 0)->count();
        $inTrash = Group::onlyTrashed()->get()->count();

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
                    $group = Group::find($item);
                    $group->status = 1;
                    $group->save();
                }
            }
            elseif($request->doAction == 'draft')
            {
                $params = array('status' => 0);
                foreach ($listItem as $item) {
                    $group = Group::find($item);
                    $group->status = 0;
                    $group->save();
                }
            }
            elseif($request->doAction == 'trash')
            {
                foreach ($listItem as $item) {
                    $group = Group::find($item);
                    $group->delete();
                }
            }
            elseif($request->doAction == 'restore')
            {
                foreach ($listItem as $item) {
                    $group = Group::withTrashed()->find($item);
                    $group->restore();
                }
            }
            elseif($request->doAction == 'foreDelete')
            {
                foreach ($listItem as $item) {
                    $group = Group::withTrashed()->find($item);
                    $group->forceDelete();
                }
            }
        }

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group updated multi.'
            ]);
        }
    }
}