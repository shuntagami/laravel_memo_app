@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        メモ編集
        <form class="card-body" action="{{ route('destroy') }}" method="POST">
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}" />
            <button type="submit">削除</button>
        </form>
    </div>
    <!-- {{-- route('store') と書くと→ /store --}} -->
    <form class="card-body" action="{{ route('update') }}" method="POST">
        @csrf
        <input type="hidden" name="memo_id" value="{{ $edit_memo[0]['id'] }}" />
        <div class="form-group">
            <textarea class="form-control" name="content" rows="3" placeholder="入力しろ">{{ $edit_memo[0]['content'] }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    @foreach($tags as $t)
        <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $t['id'] }}" value="{{ $t['id'] }}" {{ in_array($t['id'], $include_tags) ? 'checked' : '' }}>
            {{-- for でチェックボックスの範囲を大きくする --}}
            <label class="form-check-label" for="{{ $t['id'] }}">{{ $t['name']}}</label>
        </div>
    @endforeach
        <input type="text" class="form-control w-50 mb-3" name="new_tag" placeholder="タグを入力しろ" />
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
