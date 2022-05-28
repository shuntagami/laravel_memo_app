@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        メモ編集
        <form class="card-body" action="{{ route('destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo['id'] }}" />
            <button type="submit">削除</button>
        </form>
    </div>
    <!-- {{-- route('store') と書くと→ /store --}} -->
    <form class="card-body" action="{{ route('update') }}" method="POST">
        @csrf
        <input type="hidden" name="memo_id" value="{{ $edit_memo['id'] }}" />
        <div class="form-group">
            <textarea class="form-control" name="content" rows="3" placeholder="入力しろ">{{ $edit_memo['content'] }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
