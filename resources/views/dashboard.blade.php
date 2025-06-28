<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div>
                    <a href="{{route('mood.create')}}">Record your mood for today</a>
                </div>
                @if(session('success'))
                    <div style="color: green; font-weight: bold; margin-bottom: 10px;">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
