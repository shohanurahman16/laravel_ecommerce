<form action="{{route('carts.store')}}" method="post" class="form-inline">
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i> Add to cart</button>
</form>