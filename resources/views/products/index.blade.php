@extends('layouts.app')

@section('content')
    <h1>商品検索結果</h1>

    @if (!empty($data['Items']))
        <div class="product-grid">
            @foreach($data['Items'] as $item)
                <div class="product-item">
                    @if (!empty($item['Item']['mediumImageUrls']))
                        <img src="{{ $item['Item']['mediumImageUrls'][0]['imageUrl'] }}" alt="商品画像">
                    @endif
                    <div class="product-details">
                        <h2 class="product-title">{{ $item['Item']['itemName'] }}</h2>
                        <p class="product-price">{{ $item['Item']['itemPrice'] }}円</p>
                        <a href="{{ $item['Item']['itemUrl'] }}" target="_blank">詳細を見る</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>該当する商品は見つかりませんでした。</p>
    @endif
@endsection
<style>
 .product-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* 商品間の間隔を設定 */
    justify-content: space-between; /* 画面幅に合わせて横並びに */
}

.product-item {
    width: calc(33.33% - 20px); /* 3列で表示 */
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
    box-sizing: border-box; /* パディングとボーダーを要素の幅に含める */
}

.product-title {
    font-size: 16px; /* 商品タイトルのフォントサイズを調整 */
}

.product-price {
    font-size: 14px; /* 商品価格のフォントサイズを調整 */
}

.product-description {
    font-size: 12px; /* 商品説明のフォントサイズを調整 */
}

/* モバイルデバイスに対するスタイル */
@media (max-width: 768px) {
    .product-item {
        width: calc(50% - 20px); /* 2列で表示 */
    }
}

@media (max-width: 576px) {
    .product-item {
        width: 100%; /* 1列で表示 */
    }
}
</style>