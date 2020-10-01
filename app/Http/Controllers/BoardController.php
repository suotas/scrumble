<?php

namespace App\Http\Controllers;

use DB;
use App\Model\Board;
use App\Model\Kanban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BoardCreateRequest;

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
     * Show board information.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $kanbans = Kanban::with('cards');
        if ($request->card_id) {
            $kanbans = $kanbans->whereBoardId($request->board_id);
        }

        return view('board/index', [
            'kanbans' => $kanbans->orderBy('seq')->get(),
        ]);
    }

    /**
     * Show board list page.
     */
    public function list()
    {
        return view('board/list', [
            'boards' => Board::whereUserId(Auth::id())->get(),
        ]);
    }

    /**
     * Create new board data.
     * @param  BoardCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(BoardCreateRequest $request)
    {
        try {
            $query = Board::create([
                'user_id'    => Auth::id(),
                'board_name' => $request->board_name,
            ]);

            if ($query) {
                // do something if success, like success flash or other
                return redirect()->route('board/list');
            }

            // do something if failed, like error flash or other
            return redirect()->route('board/list');
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
