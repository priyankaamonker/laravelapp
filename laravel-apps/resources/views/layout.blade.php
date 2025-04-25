<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel Apps</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- component -->
    <div id="body" class="bg-slate-50 h-screen flex">
    <nav class="bg-white w-80 h-screen flex flex-col gap-10 border-r border-slate-100">
        <div class="logo text-2xl font-bold text-center h-16 flex items-center justify-center">My Laravel App</div>
        <ul class="px-6 space-y-2">
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/') }}">Home</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold  hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/products/') }}">Products</a>
                <ol class="text-sm text-slate-700 space-y-4 pl-6 my-2.5">
                    <li>
                        <a class="block text-slate-500 hover:text-slate-950" href="{{ url('/products/show') }}">Product Catalog</a>
                    </li>
                </ol>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/users/') }}">Users</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/contents/') }}">Content</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/posts/') }}">Blog</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/todos/') }}">To-do</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/cart') }}">Cart</a>
            </li>
            <li>
                <a class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" href="{{ url('/orders') }}">Orders</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block px-4 py-2.5 text-slate-800 font-semibold hover:bg-emerald-950 hover:text-white rounded-lg" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="right w-full flex gap-2 flex-col">
        <div class="p-4">          
            <main role="main" class="w-full h-full flex-grow p-3 overflow-auto">
            @include('includes.flash-messages')    
            @yield('content')
            </main>
        </div>
    </div>
    <div>
</body>
</html>