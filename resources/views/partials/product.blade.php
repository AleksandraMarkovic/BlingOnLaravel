<div class="product-item">
    <a href="{{ route('product', ['id' => $product->id]) }}"><img src="{{ asset('assets/images/' . $product->main_image) }}" alt="{{ $product->name }}"></a>
    <div class="down-content">
        <a href="{{ route('product', ['id' => $product->id]) }}"><h4>{{ $product->name }}</h4></a>
        <h6>${{ $product->price }}</h6>
        @if($product->grade)
            <ul class="stars">
                <li>
                    <i class="fa fa-star "></i> {{ $product->grade  }}/5
                </li>
            </ul>
        @else
            <ul class="stars">
                <li><i class="fa fa-star mr-2"></i>Be first to rate!</li>
            </ul>
        @endif
    </div>
</div>
