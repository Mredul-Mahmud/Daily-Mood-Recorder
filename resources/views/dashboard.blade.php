<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark text-center">
            {{("You're logged in!")}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container d-flex flex-column align-items-center">
            @if(session('success'))
                <div class="alert alert-success w-100 text-center">
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger w-100 text-center">
                    {{session('error')}}
                </div>
            @endif

            <div class="card mb-3 w-75">
                <div class="card-body text-center">
                    <a href="{{route('mood.create')}}" class="btn btn-primary btn-lg">Record your mood for today</a>
                </div>
            </div>
            <div class="card mb-3 w-75">
                <div class="card-body text-center">
                    <a href="{{route('mood.all')}}" class="btn btn-secondary btn-lg">View My Mood Records</a>
                </div>
            </div>
             <div class="card mb-3 w-75">
                <div class="card-body text-center">
                    <a href="{{route('moodOfMonth')}}" class="btn btn-secondary btn-lg">Mood of the month</a>
                </div>
            </div>
            <div class="card mb-3 w-75">
                <div class="card-body text-center">
                    <a href="{{route('trash')}}" class="btn btn-secondary btn-lg">Trash / Bin</a>
                </div>
            </div>
            <div class="card w-75">
                <div class="card-body text-center">
                    <a href="{{route('mood.weeklychart')}}" class="btn btn-secondary btn-lg">Chart</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
