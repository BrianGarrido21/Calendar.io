@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div id="calendar" class="bg-white rounded-xl shadow p-4"></div>
    <livewire:event-details />
    <livewire:task-modal />
    <livewire:event-create />

</div>

@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.7/index.global.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.7/index.global.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.7/index.global.min.css" rel="stylesheet">
@endpush