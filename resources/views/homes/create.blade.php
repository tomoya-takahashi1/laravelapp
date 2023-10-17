@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-12 col-md-8">
    <div class="card shadow">
      <div class="card-body">
      
        <div class="container text-center"> 
          <h1>トレーニング投稿</h1>
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('homes.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">種目</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="form-group">
                <label for="body">回数</label>
                <textarea class="form-control" id="body" name="body"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">保存</button>
              <a href="{{ route('homes.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
.alert.alert-danger ul li {
    text-align: left; 
}
</style>
