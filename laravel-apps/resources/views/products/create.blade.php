<!-- create.blade.php -->
@extends('layout')

@section('content')
<div class="container content py-6 mx-auto">
    <div class="hover:shadow px-5 bg-white border-blue-500 border-t-2">
        <div class="container content py-6 mx-auto">
            <div class="flex">
                <h2 class="text-lg text-gray-800 mb-4">Create a New Product</h2>
            </div>   
            <div class="flex">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Name </label>
                    <input type="text" name="name" id="name" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" placeholder="name">
                </div>
                <div class="mb-5">
                    <label for="description" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Description </label>
                    <textarea name="description" id="description" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" rows="4" cols="50"></textarea>
                </div>
                <div class="mb-5">
                    <label for="price" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Price </label>
                    <input type="text" name="price" id="price" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" placeholder="price">
                </div>
                <div class="mb-5">
                    <label for="quantity" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Quantity </label>
                    <input type="text" name="quantity" id="quantity" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" placeholder="quantity">
                </div>
                <div class="mb-5">
                    <label for="image" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Image </label>
                    <input type="file" name="image" id="image" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" placeholder="image">
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
                <button type="submit" class="px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Save</button>
                <a href="{{ url('/products/') }}" class="px-4 py-3 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</a>
            </form>
            </div>  
        </div>
    </div>
</div>
@endsection