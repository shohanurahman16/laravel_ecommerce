<div class="row">
    @foreach($products as $product)
        <div class="col-md-4" style="margin-bottom: 10px;">
            <div class="card">
                @php $i=1; @endphp
                @foreach($product->images as $image)
                    @if($i>0)
                        <img class="card-img-top feature-img" src="{{ asset('images/products/'.$image->image) }}" alt="Card image">
                    @endif
                    @php $i--; @endphp
                @endforeach
                <div class="card-body feature-body">
                    <div class="col text-center">
                        <h3 class="card-title"><a href="{{route('products.show',$product->slug)}}">{{$product->title}}</a></h3>
                        <p class="card-text">$ {{$product->price}}</p>
                        <a href="#" class="btn btn-outline-success">Add to Cart</a>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>