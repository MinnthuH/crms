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
            <x-input-label for="hall_id" value="Hall" />
            <select name="hall_id" id="hall_id" class="custom-select">
                <option value="">-- Select Hall --</option>
                @foreach ($hall as $hall)
                <option value="{{$hall->id}}">{{$hall->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="showtime_id" value="Showtime" />
            <select name="showtime_id" id="showtime_id" class="custom-select">
                <option value="">-- Select Showtime --</option>
                @foreach ($showtime as $showtime)
               <option value=" {{ $showtime->id}}"> {{ Carbon\Carbon::parse($showtime->showtime)->format('h:i A') }}</option>
                @endforeach


            </select>
        </div>


        <div class="form-group">
            <x-input-label for="ticketprice_id" value="Ticket Price" />
            <select name="ticketprice_id" id="ticketprice_id" class="custom-select">
                <option value="">-- Select Ticket Price --</option>
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
        $('#hall_id').select2({

        });
    });
    $(document).ready(function() {
        $('#showtime_id').select2({

        });
    });
    $(document).ready(function() {
        $('#ticketprice_id').select2({

        });
    });
</script>
@endpush