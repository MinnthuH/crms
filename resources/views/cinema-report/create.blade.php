@extends('layouts.app')

@section('title', 'Create Cinema Report')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-plus tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0 tw-p-3">{{$cinema->name}}<span></span> Cinema Report</h5>
    </div>
    <div class=""></div>

</div>
@endsection

@section('content')

<x-card class="tw-mb-5">

    <form method="post" action="{{ route('cinema-report.store') }}" class="" id="submit-form">
        @csrf


        <div class="form-group">
            <x-input-label for="date" value="Date" />
            <x-text-input id="date" name="date" type="date" class="tw-mt-1 tw-block tw-w-full"
                :value="old('date')" />
        </div>

        <div class="form-group">
            <x-input-label for="movie_id" value="Movie" />
            <select name="movie_id" id="movie_id" class="custom-select">
                <option value="">-- Movie Name --</option>
                @foreach ($movies as $movie)
                <option value="{{$movie->id}}">{{$movie->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="hall_id" value="Hall" />
            <select name="hall_id" id="hall_id" class="custom-select">
                <option value="">-- Select Hall --</option>
                @foreach ($halls as $hall)
                <option value="{{$hall->id}}">{{$hall->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="showtime_id" value="Showtime" />
            <select name="showtime_id" id="showtime_id" class="custom-select">
                <option value="">-- Select Showtime --</option>
                @foreach ($showtimes as $showtime)
                <option value="{{$showtime->id}}">{{Carbon\Carbon::parse($showtime->showtime)->format('h:i A')}}</option>
                @endforeach
            </select>
        </div>


        @foreach ($prices as $price)
            <div class="form-group">
                <x-input-label :for="$price" :value="$price . ' - MMK'" />
                <x-text-input :id="$price" :name="'prices[' . $price . ']'" type="number" class="tw-mt-1 tw-block tw-w-full"
                    :value="old('prices.' . $price)" min="0" />
            </div>
        @endforeach


        <div class="form-group">
            <x-input-label for="total_seats" value="Total Seats" />
            <x-text-input id="total_seats" name="total_seats" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_seats')" />
        </div>

        <div class="form-group">
            <x-input-label for="total_revenue" value="Total Revenue" />
            <x-text-input id="total_revenue" name="total_revenue" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_revenue')" min="0" />
        </div>
        <div class="form-group">
            <x-input-label for="epc_id" value="EPC" />
            <select name="epc_id" id="epc_id" class="custom-select">
                <option value="">-- Select EPC --</option>
                @foreach ($epcs as $epc)
                <option value="{{$epc->id}}">{{$epc->status}} %</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cinema_id" value="{{ $cinema->id }}">

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('cinema-report.index') }}">Cancel</x-cancel-button>
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
{!! JsValidator::formRequest('App\Http\Requests\CinemaReportStoreRequest', '#submit-form') !!}
@endpush