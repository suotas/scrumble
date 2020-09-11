<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardCreateRequest;
use App\Model\Card;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    /**
     * Create new card data.
     */
    public function store(CardCreateRequest $request)
    {
        Log::debug('card/store start');
        DB::beginTransaction();
        try {
            $max_seq = DB::select(
                'select max(card_seq) as max from cards where kanban_id = ?',
                [$request->kanban_id]
            );
            $board_id = DB::select(
                'select board_id from kanbans where id = ?',
                [$request->kanban_id]
            );
            $card = new Card();
            $card->card_name = $request->card_name;
            $card->card_seq = (int) $max_seq[0]->max + 1;
            $card->user_id = Auth::id();
            $card->board_id = $board_id[0]->board_id;
            $card->kanban_id = $request->kanban_id;
            $card->assignee_id = Auth::id();
            $card->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);
        }
        Log::debug('card/store end');
        return redirect()->route('board/list');
    }
}
