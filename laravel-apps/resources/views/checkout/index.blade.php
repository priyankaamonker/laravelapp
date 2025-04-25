@extends('layout')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

<section class="bg-white py-8 antialiased dark:bg-white-900 md:py-16">
  <form method="POST" action="{{ route('process.payment') }}" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
  @csrf
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
    <h2 class="text-xl font-semibold text-white-900 dark:text-black sm:text-2xl">Checkout</h2>
    </div>
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <div class="min-w-0 flex-1 space-y-8">
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-black">Payment Details</h2>

          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="cardholderName" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"> Name on the card </label>
              <input type="text" name="cardholderName" id="cardholderName" class="block w-full rounded-lg border border-gray-300 bg-white-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-white-700 dark:text-black dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Bonnie Green" required />
            </div>

            <div>
              <label for="cardNumber" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"> Card Number </label>
              <input type="text" name="cardNumber" id="cardNumber" class="block w-full rounded-lg border border-gray-300 bg-white-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-white-700 dark:text-black dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="4242 4242 4242 4242" required />
            </div>

            <div>
              <label for="expMonth" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"> Expiration Month </label>
              <input type="text" name="expMonth" id="expMonth" class="block w-full rounded-lg border border-gray-300 bg-white-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-white-700 dark:text-black dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="01" required />
            </div>

            <div>
              <label for="expYear" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"> Expiration Year </label>
              <input type="text" name="expYear" id="expYear" class="block w-full rounded-lg border border-gray-300 bg-white-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-white-700 dark:text-black dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="2026" required />
            </div>

            <div>
              <label for="cvc" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"> CVC</label>
              <input type="text" name="cvc" id="cvc" class="block w-full rounded-lg border border-gray-300 bg-white-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-white-700 dark:text-black dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="123" required />
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
        <div class="flow-root">
          <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
            <dl class="flex items-center justify-between gap-4 py-3">
              <dt class="text-base font-bold text-gray-900 dark:text-black">Order Total</dt>
              <dd class="text-base font-bold text-gray-900 dark:text-black">${{ $ordertotal }}</dd>
            </dl>
          </div>
        </div>

        <div class="space-y-3">
          <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-black hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">Submit Payment</button>
        </div>
      </div>
    </div>
  </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

@endsection