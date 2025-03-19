@extends('layouts.app')

@section('title', 'Cinema Report Details')

@section('cinema-report-page-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-info tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0 tw-p-3">Cinema Report Details</h5>
    </div>
    <div>
        <x-exit-button href="{{ route('cinema-report.index') }}">
            <i class="fas fa-arrow-left tw-mr-1"></i>Back
        </x-exit-button>
    </div>
</div>
@endsection

@section('content')
<x-card class="tw-pb-5">
    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-text-gray-800">
        <div><strong>Cinema:</strong> {{ $cinemaReport->cinema->name ?? 'N/A' }}</div>
        <div><strong>Hall:</strong> {{ $cinemaReport->hall->name ?? 'N/A' }}</div>
        <div><strong>Staff Name:</strong> {{ $cinemaReport->user->name ?? 'N/A' }}</div>

        <div><strong>Movie:</strong> {{ $cinemaReport->movie->name ?? 'N/A' }}</div>
        <div><strong>Show Date:</strong> {{ $cinemaReport->show_date }}</div>

        <div><strong>Showtime:</strong> {{ \Carbon\Carbon::parse($cinemaReport->showtime->showtime ?? '00:00:00')->format('h:i A') }}</div>
        <div><strong>Total Seats:</strong> {{ $cinemaReport->total_seats }}</div>

        <div><strong>Total Revenue:</strong> {{ number_format($cinemaReport->total_revenue) }} MMK</div>
        <div><strong>Status:</strong> {{ $cinemaReport->epc->status }}%</div>
    </div>

    {{-- Ticket Pricing and Seat Count --}}
<h3 class="tw-mt-5 tw-mb-2 tw-text-lg tw-font-bold">Ticket Pricing & Seat Count</h3>

@if (!empty($filteredAttributes))
    <div class="tw-grid tw-grid-cols-2 tw-gap-4">
        @foreach ($filteredAttributes as $price => $seats)
            @if (is_numeric($price)) {{-- Ensure the key is a price --}}
                <div><strong>{{ number_format($price) }} MMK:</strong> {{ $seats }} seats</div>
            @endif
        @endforeach
    </div>
@else
    <p class="tw-text-gray-500">No ticket pricing data available.</p>
@endif


</x-card>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        console.log("Cinema Report Page Loaded");
    });
</script>
@endpush