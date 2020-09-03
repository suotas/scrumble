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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-columns">
                @foreach ($boards as $board)
                <a>
                    <div class="card col-md-12" style="width: 18rem; height: 10rem">
                        <div class="card-body">
                            <h5 class="card-title">{{ $board->board_name }}</h5>
                            <p class="card-text">{{ $board->description }}</p>
                            <a href="#" class="btn btn-primary"
                                >Go {{ $board->board_name }}</a
                            >
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="card col-md-12" style="width: 18rem; height: 10rem">
                    <div class="card-body">
                        <h5 class="card-title">Create new board</h5>
                        <a
                            href="#"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            >create</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('board/store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                        <label for="board_name">Board title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="board_name"
                            name="board_name"
                            placeholder="Enter board title"
                        />
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
