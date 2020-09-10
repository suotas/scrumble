<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardCreateRequest;
use App\Model\Board;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show board infomation.
     */
    public function index(Request $request)
    {
        Log::debug('BoardController@index start');
        $board_id = $request->input('board_id');
        $board = DB::select('select * from boards where id = ?', [$board_id]);
        $kanbans = DB::select(
            'select * from kanbans where board_id = ? order by seq',
            [$board_id]
        );
        foreach ($kanbans as $kanban) {
            $cards[
                $kanban->id
            ] = DB::select(
                'select * from cards where kanban_id = ? order by seq',
                [$kanban->id]
            );
        }
        Log::debug('BoardController@index end');
        return view('board/index', compact('board', 'kanbans', 'cards'));
    }

    /**
     * Show board list page.
     */
    public function list()
    {
        Log::debug('BoardController@list start');
        $id = Auth::id();
        $boards = DB::select('select * from boards where user_id = ?', [$id]);
        Log::debug('BoardController@list end');
        return view('board/list', compact('boards'));
    }

    /**
     * Create new board data.
     */
    public function store(BoardCreateRequest $request)
    {
        Log::debug('board/store start');
        DB::beginTransaction();
        try {
            $board = new Board();
            $board->board_name = $request->board_name;
            $board->user_id = Auth::id();
            $board->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);
        }
        Log::debug('board/store end');
        return redirect()->route('board/list');
    }
}
