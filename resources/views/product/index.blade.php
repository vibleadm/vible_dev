@extends('layouts.app')
@section('js')
<script src="{{ asset('js/like.js') }}" defer></script>
@endsection
@section('content')
<div class="row pt-3">
    @foreach( $products as  $product)
        <div class="col-md-4">
            <div class="card mb-4">
                 <a href="#" target="_blank">
                <img class="card-img-top bd-placeholder-img" src="{{ asset('storage/icon/'.$product->icon) }}">
                  </a>
             <div class="card-body">
                <h5 class="card-title">{{$product->title }}</h5>
                <p class="card-text">{{ $product->description }}</p>
           @if(auth()->user())
              @if(isset($product->like_products[0]))
                  <a class="toggle_wish" product_id="{{ $product->id }}" like_product="1">
                       <i class="fas fa-heart"></i>
                  </a>
              @else
                  <a class="toggle_wish" product_id="{{ $product->id }}" like_product="0">
                      <i  class="far fa-heart"></i>
                  </a> 
              @endif
          @endif    
            </div>
         </div>
    </div>
    @endforeach  
   {{ $products->links() }}
</div>
@endsection