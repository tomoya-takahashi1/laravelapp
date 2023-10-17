@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
      <div class="card shadow">
        <div class="card-body">
          <div class="container text-center"> <!-- text-center クラスを追加 -->
            <h1>トレーニング詳細</h1>
            <div>
              <strong>種目:</strong> {{ $home->title }}
            </div>
            <div>
              <strong>回数:</strong> {{ $home->body }}
            </div>
            <div>
              <strong>投稿者:</strong>
              @if ($home->user)
                {{ $home->user->name }}
              @else
                投稿者なし
              @endif
            </div>
            @if (Auth::check() && Auth::user()->id === $home->user_id)
              <a href="{{ route('homes.edit', $home->id) }}" class="btn btn-primary">編集</a>
              <form action="{{ route('homes.destroy', $home->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
              </form>
            @endif
            <a href="{{ route('homes.index') }}" class="btn btn-secondary">戻る</a>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection



