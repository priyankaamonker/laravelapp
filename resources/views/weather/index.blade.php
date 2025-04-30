@extends('layout')

@section('content')
    <div class="container content py-6 mx-auto">
        <div class="hover:shadow px-5 bg-white border-blue-500 border-t-2">
            <div class="container content py-6 mx-auto">
                <div class="flex">
                    <h2 class="text-lg text-gray-800 mb-4">Weather Page - powered by OpenWeather</h2>
                </div>   
            </div>
            <div>
            <form action="{{ url('weather') }}" method="GET" class="w-full max-w-lg">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-2 w-auto pb-5">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <select name="city" id="city" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <select name="duration" id="duration" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            @foreach ($durations as $duration)
                            <option value="{{ $duration }}" {{ request('duration') == $duration ? 'selected' : '' }}>
                            {{ $duration }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <button type="submit" class="bg-teal-500 text-white font-semibold hover:bg-teal-600 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">Get Data</button>
                    </div>
                </div>
            </form>
            @if (isset($weather['name']))
                <!-- layout for one day data -->
                <div class="-mx-3 mb-2 w-auto pb-5">
                    <h4 class="text-2xl font-bold dark:text-dark pb-4">
                        Weather in {{ $weather['name'] }} - {{ request('duration') }}'s Forecast
                    </h4>
                    <p>Temperature: {{ $weather['main']['temp'] }}°F</p>
                    <p>Feels like: {{ $weather['main']['feels_like'] }}°F</p>
                    <p>Min Temperature: {{ $weather['main']['temp_min'] }}°F</p>
                    <p>Max Temperature: {{ $weather['main']['temp_max'] }}°F</p>
                    <p>Condition: {{ $weather['weather'][0]['description'] }}</p>
                    <p>Humidity: {{ $weather['main']['humidity'] }}%</p>
                    <p>Wind Speed: {{ $weather['wind']['speed'] }} mph</p>
                </div>
            @endif

            @if (isset($weather[0]['city']))
            <!-- layout for multiple days data -->
            <h4 class="text-2xl font-bold dark:text-dark pb-4">
                Weather in {{ $weather[0]['city'] }} - {{ request('duration') }} Forecast
            </h4>
            <div class="grid grid-cols-8 gap-4 pb-4">
                <div>Date</div>
                <div>Temperature</div>
                <div>Feels like</div>
                <div>Min Temperature</div>
                <div>Max Temperature</div>
                <div>Condition</div>
                <div>Humidity</div>
                <div>Wind Speed</div>
                @foreach ($weather as $eachday)
                <div>{{ $eachday['dt'] }}</div>
                <div>{{ $eachday['temp'] }}°F</div>
                <div>{{ $eachday['feels_like'] }}°F</div>
                <div>{{ $eachday['temp_min'] }}°F</div>
                <div>{{ $eachday['temp_max'] }}°F</div>
                <div>{{ $eachday['description'] }}</div>
                <div>{{ $eachday['humidity'] }}%</div>
                <div>{{ $eachday['speed'] }} mph</div>
                @endforeach
            </div>
            @endif
            </div>  
        </div> 
    </div>
@endsection