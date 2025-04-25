@extends('layout')

@section('content')
    <div class="container hover:shadow px-5 my-5 bg-white border-blue-500 border-t-2">
        <div class="container content py-6 mx-auto">
            <div class="flex">
                <h2 class="text-lg text-gray-800 mb-4">Product Catalog</h2>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 content-around gap-6">
            @foreach($products as $product)
            <div>
                <form action="{{ route('products.addtocart', $product->slug) }}" method="POST">
                @csrf
                <img class="h-auto max-w-full pb-5 rounded-lg" src="/uploads/{{ $product->image }}" alt="{{ $product->name }}">
                <span class="pr-5"><a href="{{ route('products.edit', $product->id) }}">{{ $product->name }}</a></span>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-normal rounded hover:bg-blue-600">Add to cart</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection