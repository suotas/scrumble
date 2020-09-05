@extends('layouts.app') @section('content')
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
                @foreach( $cards[$kanban->id] as $card) @if ($kanban->id ===
                $card->kanban_id)
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $card->card_name }}
                        </h5>
                        <p class="card-text">
                            {{ $card->description }}
                        </p>
                    </div>
                </div>
                @endif @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
