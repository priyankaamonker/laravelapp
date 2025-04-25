@extends('layout')

@section('content')
<section class="py-24 relative">  
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
    <h2 class="font-manrope font-extrabold text-3xl lead-10 text-black mb-9">Order History</h2>
    @if (empty($orders[0]))
        <div class="mt-7 border border-gray-300 pt-5 pb-5 px-5">You do not have any orders.</div>
    @else
    @foreach ($orders as $order)
        <div class="mt-7 border border-gray-300 pt-5">
            <div class="flex max-md:flex-col items-center justify-between px-3 md:px-8">
                <div class="data">
                    <p class="font-medium text-lg leading-8 text-black whitespace-nowrap">Order : {{ $order['id'] }}</p>
                    <p class="font-medium text-lg leading-8 text-black mt-3 whitespace-nowrap">Order Payment : {{ date(' jS F Y', strtotime($order['created_at'])) }}</p>
                </div>
            </div>
            <svg class="my-5 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2" fill="none">
                <path d="M0 1H1216" stroke="#D1D5DB" />
            </svg>

            @foreach ($order['item'] as $eachItem)
                <div class="flex max-lg:flex-col items-center gap-8 lg:gap-24 px-3 md:px-8">
                    <div class="grid grid-cols-4 w-full">
                        <div class="col-span-4 sm:col-span-1">
                            <img src="/uploads/{{ $eachItem['image'] }}" alt="" class="max-sm:mx-auto object-cover">
                        </div>
                        <div class="col-span-4 sm:col-span-3 max-sm:mt-4 sm:pl-8 flex flex-col justify-center max-sm:items-center">
                            <h6 class="font-manrope font-semibold text-2xl leading-9 text-black mb-3 whitespace-nowrap">{{ $eachItem['name'] }}</h6>
                            <div class="flex items-center max-sm:flex-col gap-x-10 gap-y-3">
                                <span class="font-normal text-lg leading-8 text-gray-500 whitespace-nowrap">Qty: {{ $eachItem['quantity'] }}</span>
                                <p class="font-semibold text-xl leading-8 text-black whitespace-nowrap">Price {{ $eachItem['itemable_price'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <svg class="my-5 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2" fill="none">
                    <path d="M0 1H1216" stroke="#D1D5DB" />
                </svg>
            @endforeach

            <div class="px-3 md:px-11 flex items-center justify-between max-sm:flex-col-reverse pb-5">
                <div class="flex max-sm:flex-col-reverse items-center">
                    <p class="font-normal text-xl leading-8 text-gray-500">Payment Is Succesfull</p>
                </div>
                <p class="font-medium text-xl leading-8 text-black max-sm:py-4"> <span class="text-gray-500">Total Price: </span> &nbsp;${{ $order['total'] }}</p>
            </div>
        </div>
    @endforeach
    @endif
    </div>
</section>
@endsection                                      