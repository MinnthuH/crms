@extends('layouts.app')

@section('title', 'Edit Cinema')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-edit tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0 tw-p-3">Edit Cinema</h5>
    </div>
    <div class=""></div>
</div>
@endsection

@section('content')
<x-card class="tw-mb-5">
    <form method="post" action="{{ route('cinema.update', $cinema->id) }}" id="submit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="tw-mt-1 tw-block tw-w-full"
                :value="old('name', $cinema->name)" />
        </div>

        <div class="form-group">
            <x-input-label for="hall_ids" value="Halls" />
            <select id="hall_ids" name="hall_ids[]" class="custom-select" multiple="multiple">
                @foreach ($halls as $hall)
                <option value="{{ $hall->id }}"
                    {{ in_array($hall->id, json_decode($cinema->hall_ids, true) ?? []) ? 'selected' : '' }}>
                    {{ $hall->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="showtime_ids" value="Showtimes" />
            <select id="showtime_ids" name="showtime_ids[]" class="custom-select" multiple="multiple">
                @foreach ($showtimes as $showtime)
                <option value="{{ $showtime->id }}"
                    {{ in_array($showtime->id, json_decode($cinema->showtime_ids, true) ?? []) ? 'selected' : '' }}>
                    {{ Carbon\Carbon::parse($showtime->showtime)->format('h:i A') }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="ticketprice_ids" value="Ticket Prices" />
            <select id="ticketprice_ids" name="ticketprice[]" class="custom-select" multiple="multiple">
                @foreach ($ticketPrices as $ticketPrice)
                <option value="{{ $ticketPrice->id }}"
                    {{ in_array($ticketPrice->id, json_decode($cinema->ticketprice_ids, true) ?? []) ? 'selected' : '' }}>
                    {{ $ticketPrice->price }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('cinema.index') }}">Cancel</x-cancel-button>
            <x-confirm-button>Confirm</x-confirm-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="tw-text-sm tw-text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</x-card>
@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CinemaUpdateRequest', '#submit-form') !!}

<script>
    $(document).ready(function() {
        // Initialize Select2 for multi-select fields
        $('#hall_ids').select2({
            placeholder: "-- Select Hall(s) --",
            allowClear: true
        });

        $('#showtime_ids').select2({
            placeholder: "-- Select Showtime(s) --",
            allowClear: true
        });

        $('#ticketprice_ids').select2({
            placeholder: "-- Select Ticket Price(s) --",
            allowClear: true
        });
    });
</script>
@endpush