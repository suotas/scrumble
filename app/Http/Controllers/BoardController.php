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
        Log::debug("BoardController::__construct");
        $this->middleware('auth');
    }

    /**
     * Create new board data.
     */
    public function store(BoardCreateRequest $request)
    {
        Log::debug("board/store start");
        DB::beginTransaction();
        try {
            $board = new Board;
            $board->board_name = $request->board_name;
            $board->user_id = Auth::id();
            $board->save();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
            Log::debug($e);
        }
        Log::debug("board/store end");
        return redirect()->route('home');
    }
}
