<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("You're logged in!") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div>
                    <a href="{{route('mood.create')}}">Record your mood for today</a>
                </div>
                @if(session('success'))
                <div style="color: green; font-size: 0.9rem;">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                <div style="color: red;font-size: 0.9rem;">{{ session('error') }}</div>
                @endif
                </div><br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="{{ route('mood.all') }}">View My Mood Records</a><br><br>

                </div>   <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="{{ route('trash') }}">Trash/Bin</a> 
            </div><br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="{{ route('mood.weeklychart') }}">Chart</a> 
            </div>
        </div>
    </div>
</x-app-layout>
