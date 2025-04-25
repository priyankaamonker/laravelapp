<!-- edit.blade.php -->
@extends('layout')

@section('content')
<div class="container content py-6 mx-auto">
    <div class="hover:shadow px-5 bg-white border-blue-500 border-t-2">
        <div class="container content py-6 mx-auto">
            <div class="flex">
                <h2 class="text-lg text-gray-800 mb-4">Edit Product</h2>
            </div>   
            <div class="flex">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="name" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Name </label>
                    <input type="text" name="name" id="name" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" value="{{ $product->name }}">
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Description </label>
                    <textarea name="description" id="description" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" rows="4" cols="50">{{ $product->description }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="price" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Price </label>
                    <input type="text" name="price" id="price" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3"  value="{{ $product->price }}">
                </div>
                <div class="mb-5">
                    <label for="quantity" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Quantity </label>
                    <input type="text" name="quantity" id="quantity" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3"  value="{{ $product->quantity }}">
                </div>
                <div class="mb-5 flex">
                    <label for="image" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Image </label>
                    <input type="file" name="image" id="image" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3">
                    @if ($product->image)
                        <img src="/uploads/{{ $product->image }}" alt="{{ $product->name }}" width="100" height="100">
                    @endif
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span class="text-red-500 text-xs mt-4 block ">{{ $error }}</span>
                            @endforeach
                        </ul>
                </div>
                @endif
                <button type="submit" class="px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
                <button class="px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
            </form>
            </div>  
        </div>
    </div>
</div>
@endsection