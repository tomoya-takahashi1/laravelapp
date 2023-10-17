@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">投稿一覧</h1>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('homes.create') }}" class="btn btn-primary">新規作成</a>
    </div>
    <form action="{{ route('homes.search') }}" method="GET">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="種目名で投稿を検索">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
    @if (!is_null($homes))
    <table class="table">
        <thead>
            <tr>
                <th>投稿者</th>
                <th>種目</th>
                <th>回数</th>
                <th>詳細</th>
                <th>いいね</th>
            </tr>
        </thead>
        <tbody>
            @foreach($homes as $home)
            <tr>
                <td>
                    @if ($home->user)
                        {{ $home->user->name }}
                    @else
                        投稿者なし
                    @endif
                </td>
                <td>{{ $home->title }}</td>
                <td>{{ $home->body }}</td>
                <td>
                    <a href="{{ route('homes.show', $home->id) }}" class="btn btn-info">詳細</a>
                </td>
                <td>
                    @if (Auth::check())
                    <span class="d-flex align-items-center">
                        <span class="mr-2">いいね数: {{ $home->likes->count() }}</span>
                        @if (!$home->likes->contains('user_id', auth()->id()))
                            <form action="{{ route('like', $home->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">いいね</button>
                            </form>
                        @else
                            <form action="{{ route('unlike', $home->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">いいね解除</button>
                            </form>
                        @endif
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
      <p>該当する投稿がありません。</p>
    @endif
    <form action="{{ route('homes.searchProducts') }}" method="GET">
        @csrf
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="楽天でプロテインや筋トレ器具を検索">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
</div>

<div class="bd-example text-center mt-5" style="position: relative;">
  <h3 >筋トレ一覧</h3>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://3.bp.blogspot.com/-ugEtMLkRoq8/Vkb_GY_prTI/AAAAAAAA0aE/8Z7GweohF8U/s800/udetate_man.png" alt="Image" width="80%" height="250">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">腕立て伏せ</h5>
              <p class="card-text">① 四つん這いの状態になり、手を肩幅よりも少し広めにして着きましょう。<br> ② 足を伸ばしてつま先を立て、頭から足首までがまっすぐになるようにしましょう。<br> ③ まっすぐな姿勢をキープしながら脇を締めて肘を曲げ、体を床に着くギリギリまでゆっくりと下ろしましょう。</p>
              <p class="card-text"><small class="text-muted">トレーニング部位 胸</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://4.bp.blogspot.com/-skyuBgZ0hdk/Vkb_BCNX9EI/AAAAAAAA0ZI/4l2wDyD-RP4/s800/fukkin_woman.png" alt="Image" width="80%" height="250">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">腹筋</h5>
              <p class="card-text">① あお向けの状態で両膝を約90°に折り曲げます。<br>両手は耳の後ろ付近に当て、頭部を浮かし、腹筋に力を入れます。<br> ② みぞおちを中心に、頭部から背中を丸めながら起き上がります。<br>起き上がる際、背中が伸びないように注意しましょう。</p>
              <p class="card-text"><small class="text-muted">トレーニング部位 腹</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>              
              
<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://1.bp.blogspot.com/-J04fy2hj37o/W5IAQgAm_4I/AAAAAAABOzQ/8ry8DewSS8AhDLRQGAe64Gg-iq2NM89eACLcBGAs/s800/undou_squat_man.png" alt="Image" width="80%" height="250">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">スクワット</h5>
              <p class="card-text">① 足を腰幅に開き、つま先は膝と同じ向きにする。<br> ② お尻を後ろへ突き出すように、股関節から折り曲げる。<br> ③ 太ももが床と平行になるまで下ろしたら、ゆっくりと元の姿勢に戻る。</p>
              <p class="card-text"><small class="text-muted">トレーニング部位 足</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://1.bp.blogspot.com/-HywpCpyri1Q/XXXOzEtVqjI/AAAAAAABUzA/7bQ7pY1hMSw7t5HbThzf52yunydCxRCmwCLcBGAs/s1600/undou_back_extension_woman.png" alt="Image" width="80%" height="250">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">バックエクステンション</h5>
              <p class="card-text">① 床にうつ伏せで寝て、両手を耳の横にセットする。<br> ② みぞおちを床に着けたまま、両足と上半身を起こす。<br> ③肩甲骨を内側に寄せて一瞬上でキープする。<br>④ゆっくり両足と上半身を下ろす。</p>
              <p class="card-text"><small class="text-muted">トレーニング部位 背中</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="https://1.bp.blogspot.com/-wBFLFU668iI/X5OckMBRJvI/AAAAAAABcAs/L5FCNiDqcBEW36iVauNvZX2kF885qsvdACNcBGAsYHQ/s699/undou_calf_raise.png" alt="Image" width="80%" height="250">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">カーフレイズ</h5>
              <p class="card-text">① 肩幅に足を開いて立つ。<br> ② 足かかとをできるだけ上げて、つま先立ちになる。<br> ③ 重力に抗いながらかかとを下ろす。</p>
              <p class="card-text"><small class="text-muted">トレーニング部位 足</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection
