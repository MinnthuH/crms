@extends('layouts.app')

@section('title', 'Create EPC')

@section('header')
    <div class="tw-flex tw-justify-between tw-items-center">
        <div class="tw-flex tw-justify-between tw-items-center">
            <i class="fas fa-plus tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
            <h5 class="tw-text-lg tw-mb-0">Create EPC</h5>
        </div>
        <div class=""></div>

    </div>
@endsection

@section('content')

    <x-card class="tw-mb-5">


        <form method="post" action="{{ route('epc.store') }}" class="" id="submit-form">
            @csrf


            <div class="form-group">
                <x-input-label for="status" value="Status" />
                <x-text-input id="status" name="status" type="number" class="tw-mt-1 tw-block tw-w-full"
                    :value="old('status')" />

            </div>

            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
                <x-cancel-button href="{{ route('epc.index') }}">Cancel</x-cancel-button>
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
    {!! JsValidator::formRequest('App\Http\Requests\HallStoreRequest', '#submit-form') !!}
@endpush
