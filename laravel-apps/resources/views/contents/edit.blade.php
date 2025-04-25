@extends('layout')

@section('content')
    <div class="container content py-6 mx-auto">
    <div class="hover:shadow px-5 bg-white border-blue-500 border-t-2">
        <div class="container content py-6 mx-auto">
            <div class="flex">
                <h2 class="text-lg text-gray-800 mb-4">Edit Content</h2>
            </div>   
            <div class="flex">
            <form action="{{ route('contents.update', $content) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="title" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Title </label>
                    <input type="text" name="title" id="title" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" value="{{ $content->title }}">
                </div>
                <div class="mb-5">
                    <label for="body" class="block mb-3 text-sm font-medium text-gray-900 dark:text-black">*Content </label>
                    <textarea name="body" id="body" class="bg-gray-100  text-gray-800 text-sm rounded block w-full p-3" rows="4" cols="50">{!! $content->body !!}</textarea>
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