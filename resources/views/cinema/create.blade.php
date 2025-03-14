@extends('layouts.app')

@section('title', 'Create Cinema')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-plus tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0">Create Cinema</h5>
    </div>
    <div class=""></div>

</div>
@endsection

@section('content')

<x-card class="tw-mb-5">


    <form method="post" action="{{ route('cinema.store') }}" class="" id="submit-form">
        @csrf


        <div class="form-group">
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="tw-mt-1 tw-block tw-w-full"
                :value="old('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="hall_ids" value="Halls" />
            <select name="hall_ids[]" id="hall_ids" class="custom-select" multiple="multiple">
                <option value="">-- Select Hall(s) --</option>
                @foreach ($hall as $hall)
                <option value="{{$hall->id}}">{{$hall->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="showtime_ids" value="Showtimes" />
            <select name="showtime_ids[]" id="showtime_ids" class="custom-select" multiple="multiple">
                <option value="">-- Select Showtime(s) --</option>
                @foreach ($showtime as $showtime)
                <option value="{{ $showtime->id}}"> {{ Carbon\Carbon::parse($showtime->showtime)->format('h:i A') }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <x-input-label for="ticketprice_id" value="Ticket Prices" />
            <select name="ticket_prices[]" id="ticketprice_id" class="custom-select" multiple="multiple">
                <option value="">-- Select Ticket Price(s) --</option>
                @foreach ($ticketPrice as $ticketPrice)
                <option value="{{$ticketPrice->id}}">{{$ticketPrice->price}}-MMK</option>
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
{!! JsValidator::formRequest('App\Http\Requests\CinemaStoreRequest', '#submit-form') !!}

<script>
    $(document).ready(function() {
        // Initialize Select2 on the dropdown for hall, showtime, and ticket prices
        $('#hall_ids').select2({
            placeholder: "-- Select Hall(s) --",
            allowClear: true
        });

        $('#showtime_ids').select2({
            placeholder: "-- Select Showtime(s) --",
            allowClear: true
        });

        $('#ticketprice_id').select2({
            placeholder: "-- Select Ticket Price(s) --",
            allowClear: true
        });
    });
</script>

@endpush