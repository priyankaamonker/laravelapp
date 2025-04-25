@extends('layout')

@section('content')

    <section class="bg-white py-8 antialiased dark:bg-white-900 md:py-16">
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <h2 class="text-xl font-semibold text-white-900 dark:text-black sm:text-2xl">Payment Failed</h2>
        </div>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <!-- Display the error message, if available -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16 pl-8">
            <p class="text-red-900">There was an issue processing your payment. Please try again later or contact support.</p>
        </div>
    </section>
@endsection