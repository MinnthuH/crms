@extends('layouts.app')

@section('title', 'Edit Cinema')

@section('header')
    <div class="tw-flex tw-justify-between tw-items-center">
        <div class="tw-flex tw-justify-between tw-items-center">
            <i class="fas fa-film tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
            <h5 class="tw-text-lg tw-mb-0">Edit Cinema</h5>
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
                <x-input-label for="hall_id" value="Hall" />
                <select id="hall_id" name="hall_id" class="custom-select">
                    @foreach ($halls as $hall)
                        <option value="{{ $hall->id }}" {{ $cinema->hall_id == $hall->id ? 'selected' : '' }}>
                            {{ $hall->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <x-input-label for="showtime_id" value="Showtime" />
                <select id="showtime_id" name="showtime_id" class="custom-select">
                    @foreach ($showtimes as $showtime)
                        <option value="{{ $showtime->id }}" {{ $cinema->showtime_id == $showtime->id ? 'selected' : '' }}>
                        {{ Carbon\Carbon::parse($showtime->showtime)->format('h:i A') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <x-input-label for="ticket_price_id" value="Ticket Price" />
                <select id="ticketprice_id" name="ticketprice_id" class="custom-select">
                    @foreach ($ticketPrices as $ticketPrice)
                        <option value="{{ $ticketPrice->id }}" {{ $cinema->ticketprice_id == $ticketPrice->id ? 'selected' : '' }}>
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
@endpush
