<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Http\Requests\Api\LinkCountAllRequest;
use App\Http\Requests\Api\LinkCreatedRequest;
use App\Http\Requests\Api\LinkUpdatedRequest;
use App\Helpers\ShortestLink;

class LinksController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LinkCountAllRequest $request)
    {
        $keyword  = $request->keyword;
        $searchBy = $request->searchBy ? $request->searchBy : 'id';
        $all      = $request->all ? $request->all : 0;
        $status   = $request->status ? $request->status : 0;
        $inTrash  = $request->inTrash ? $request->inTrash : 0;
        $offset   = $request->offset ? $request->offset : 25;
        $orderBy  = $request->orderBy ? $request->orderBy : 'id';
        $sortBy   = $request->sortBy ? $request->sortBy : 'desc';

        $items = Link::all()->last();

        if(isset($keyword) && $keyword != '' && $keyword != null)
        {
            $arr_searchBy = explode(";", $searchBy);
            if(sizeof($arr_searchBy) > 1)
            {
                $items = $items->where('id', $keyword)
                                ->orWhere('url', $keyword);
            }
            else
            {
                $items = $items->search($searchBy, $keyword);
            }
        }

        if(isset($this->user_id) && $this->user_id != '' && $this->user_id != null && $request->excerpt_user != 1)
            $items = $items->where('user_id', $this->user_id);

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
    public function store(LinkCreatedRequest $request)
    {
        $created = new Link;

        $main_link = null;
        $api_default = \Auth::guard('api')->user()->api_default;

        $shortLink = new ShortestLink;

		$a123link = $shortLink->get123LinkTop($request->url);
		$shorte   = $shortLink->getShortest($request->url);
		$megaurl  = $shortLink->getMegaUrlIn($request->url);

		$created->url           = $request->url;
		$created->a123link      = $a123link;
		$created->shorte        = $shorte;
		$created->megaurl       = $megaurl;

		switch($api_default)
    	{
    		case '0':
    			$main_link = $a123link;
    			break;
    		case '1':
    			$main_link = $shorte;
    			break;
    		case '2':
    			$main_link = $megaurl;
    			break;

    		default:
    			$main_link = $a123link;
    			break;
    	}

		$created->googl_url     = $shortLink->getGoogl($main_link);
		//$created->googl_url     = null;
		$created->bitly_url     = $shortLink->getBitly($main_link);
		$created->anotedpad_url = $request->anotedpad_url;
		$created->tiny_url      = $shortLink->getTinyUrl($main_link);
		$created->source        = $request->source;
		$created->destination   = $request->destination;
		$created->user_id       = $this->user_id;
		$created->status        = 1;
        $created->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Link created success.',
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
        $item = Link::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Link information',
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
        $item = Link::findOrFail($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Link information',
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
    public function update(LinkUpdatedRequest $request, $id)
    {
        $updated = Link::find($id);
        $main_link = null;
        $api_default = \Auth::guard('api')->user()->api_default;

    	$a123link = ShortestLink::get123LinkTop($request->url);
    	$shorte = ShortestLink::getShortest($request->url);
    	$megaurl = ShortestLink::getMegaUrlIn($request->url);

		$updated->url           = $request->url;
		$updated->a123link      = $a123link;
		$updated->shorte        = $shorte;
		$updated->megaurl       = $megaurl;

		switch($api_default)
    	{
    		case '0':
    			$main_link = $a123link;
    			break;
    		case '1':
    			$main_link = $shorte;
    			break;
    		case '2':
    			$main_link = $megaurl;
    			break;

    		default:
    			$main_link = $a123link;
    			break;
    	}

		$updated->googl_url     = ShortestLink::getGoogl($main_link);
		$updated->bitly_url     = ShortestLink::getBitly($main_link);
		//$updated->anotedpad_url = $request->anotedpad_url;
		$updated->tiny_url      = ShortestLink::getTinyUrl($main_link);
		$updated->source        = $request->source;
		$updated->destination   = $request->destination;
		$updated->user_id       = $this->user_id;
		$updated->status        = 1;
        $updated->save();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Link update success.',
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
        $deleted = Link::destroy($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Link deleted.',
                'deleted' => $deleted
            ]);
        }
    }

    public function countAll(Request $request)
    {
        $all     = Link::all()->count();
        $publish = Link::all()->where('status', 1)->count();
        $draft   = Link::all()->where('status', 0)->count();
        $inTrash = Link::onlyTrashed()->get()->count();

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
                    $link = Link::find($item);
                    $link->status = 1;
                    $link->save();
                }
            }
            elseif($request->doAction == 'draft')
            {
                $params = array('status' => 0);
                foreach ($listItem as $item) {
                    $link = Link::find($item);
                    $link->status = 0;
                    $link->save();
                }
            }
            elseif($request->doAction == 'trash')
            {
                foreach ($listItem as $item) {
                    $link = Link::find($item);
                    $link->delete();
                }
            }
            elseif($request->doAction == 'restore')
            {
                foreach ($listItem as $item) {
                    $link = Link::withTrashed()->find($item);
                    $link->restore();
                }
            }
            elseif($request->doAction == 'foreDelete')
            {
                foreach ($listItem as $item) {
                    $link = Link::withTrashed()->find($item);
                    $link->forceDelete();
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