@extends('layout')

@section('content')

    <section class="bg-white py-8 antialiased dark:bg-white-900 md:py-16">
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <h2 class="text-xl font-semibold text-white-900 dark:text-black sm:text-2xl">Order Completed</h2>
        </div>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <!-- Display the success message, if available -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <p class="text-green-900">Your order has been placed successfully.</p>
        </div>
    </section>
@endsection