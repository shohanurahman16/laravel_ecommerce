<div class="list-group">
    @foreach(App\Category::orderBy('name', 'asc')->where('parent_id',NULL)->get() as $parent)
    <a href="#main-{{$parent->id}}" class="list-group-item list-group-item-action" data-toggle="collapse">
        <img src="{{asset('images/categories/'.$parent->image)}}" alt="{{$parent->name}}" width="50px" height="50px">
        {{$parent->name}}
    </a>
        <div class="collapse" id="main-{{$parent->id}}">
            <div class="child-rows">
                {{--<a href="{{route('category_wise_products', $parent->id)}}" class="list-group-item list-group-item-action">--}}
                    {{--<img src="{{asset('images/categories/'.$parent->image)}}" alt="{{$parent->name}}" width="40px" height="40px">--}}
                    {{--{{$parent->name}}--}}
                {{--</a>--}}
            @foreach(App\Category::orderBy('name', 'asc')->where('parent_id', $parent->id)->get() as $sub)
                    <a href="{{route('category_wise_products', $sub->id)}}" class="list-group-item list-group-item-action">
                    <img src="{{asset('images/categories/'.$sub->image)}}" alt="{{$sub->name}}" width="40px" height="40px">
                    {{$sub->name}}
                    </a>
                    @endforeach
            </div>
        </div>
        @endforeach
</div>