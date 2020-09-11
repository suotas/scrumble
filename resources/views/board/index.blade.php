@extends('layouts.app') @include('board.head') @section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach( $errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="container-fluid">
    <div class="card-deck">
        @foreach( $kanbans as $kanban)
        <div class="card col-3">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $kanban->kanban_name }}
                </h5>
                @foreach( $cards[$kanban->id] as $card)
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $card->card_name }}
                        </h5>
                        <p class="card-text">
                            {{ $card->card_description }}
                        </p>
                    </div>
                </div>
                @endforeach
                <div class="card col-12">
                    <div class="card-body">
                        <h5>Create new card</h5>
                        <a
                            href="#"
                            value="{{ $kanban->id }}"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#cardModal"
                            onclick="setKanbanInfo(this)"
                            >create</a
                        >
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div
    class="modal fade"
    id="cardModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="cardModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('card/store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="cardModalLabel">
                        Create Card
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="card_name">CardTitle</label>
                        <input
                            type="text"
                            class="form-control"
                            id="card_name"
                            name="card_name"
                            placeholder="Enter card title"
                        />
                        <input type="hidden" id="kanban_id" name="kanban_id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
