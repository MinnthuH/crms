@extends('layouts.app')

@section('title', 'Edit Cinema Report')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-edit tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0 tw-p-3">Edit{{$cinema->name}}<span></span> Cinema Report</h5>
    </div>
</div>
@endsection

@section('content')

<x-card class="tw-mb-5">

    <form method="post" action="{{ route('cinema-report.update', $cinemaReport->id) }}" id="submit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-input-label for="date" value="Date" />
            <x-text-input id="date" name="date" type="date" class="tw-mt-1 tw-block tw-w-full"
                value="{{ old('date', $cinemaReport->show_date) }}" />
        </div>

        <div class="form-group">
            <x-input-label for="movie_id" value="Movie" />
            <select name="movie_id" id="movie_id" class="custom-select">
                <option value="">-- Movie Name --</option>
                @foreach ($movies as $movie)
                <option value="{{$movie->id}}" {{ $cinemaReport->movie_id == $movie->id ? 'selected' : '' }}>
                    {{$movie->name}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="hall_id" value="Hall" />
            <select name="hall_id" id="hall_id" class="custom-select">
                <option value="">-- Select Hall --</option>
                @foreach ($halls as $hall)
                <option value="{{$hall->id}}" {{ $cinemaReport->hall_id == $hall->id ? 'selected' : '' }}>
                    {{$hall->name}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="showtime_id" value="Showtime" />
            <select name="showtime_id" id="showtime_id" class="custom-select">
                <option value="">-- Select Showtime --</option>
                @foreach ($showtimes as $showtime)
                <option value="{{$showtime->id}}" {{ $cinemaReport->showtime_id == $showtime->id ? 'selected' : '' }}>
                    {{Carbon\Carbon::parse($showtime->showtime)->format('h:i A')}}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Dynamic price inputs -->
        <!-- @foreach ($prices as $price)
        <div class="form-group">
            <x-input-label :for="$price" :value="$price . ' - MMK'" />
            <x-text-input :id="$price" :name="$price" type="number" class="tw-mt-1 tw-block tw-w-full"
                value="{{ old($price, $cinemaReport->$price) }}" />
        </div>
    @endforeach -->

        @foreach ($prices as $price)
        <div class="form-group">
            <x-input-label :for="$price" :value="$price . ' - MMK'" />
            <x-text-input :id="$price" :name="'prices[' . $price . ']'" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('prices.' . $price, $cinemaReport->$price)" min="0" />
        </div>
        @endforeach


        <div class="form-group">
            <x-input-label for="total_seats" value="Total Seats" />
            <x-text-input id="total_seats" name="total_seats" type="number" class="tw-mt-1 tw-block tw-w-full"
                value="{{ old('total_seats', $cinemaReport->total_seats) }}" />
        </div>

        <div class="form-group">
            <x-input-label for="total_revenue" value="Total Revenue" />
            <x-text-input id="total_revenue" name="total_revenue" type="number" class="tw-mt-1 tw-block tw-w-full"
                value="{{ old('total_revenue', $cinemaReport->total_revenue) }}" min="0" />
        </div>

        <div class="form-group">
            <x-input-label for="epc_id" value="EPC" />
            <select name="epc_id" id="epc_id" class="custom-select">
                <option value="">-- Select EPC --</option>
                @foreach ($epcs as $epc)
                <option value="{{$epc->id}}" {{ $cinemaReport->epc_id == $epc->id ? 'selected' : '' }}>
                    {{$epc->status}} %
                </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cinema_id" value="{{ $cinema->id }}">

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('cinema-report.index') }}">Cancel</x-cancel-button>
            <x-confirm-button>Update</x-confirm-button>
        </div>
    </form>

</x-card>

@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CinemaReportUpdateRequest', '#submit-form') !!}
@endpush