@extends('layouts.app')

@section('title', 'Change Password')



@section('header')
    <div class="tw-flex tw-justify-between tw-items-center">
       <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-lock tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0">Change Password</h5>
       </div>
       <div></div>
    </div>
@endsection

@section('content')
<x-card>
<form method="post" action="{{ route('change.password.update') }}" class="tw-mt-6 tw-space-y-6" id="submit-form">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="tw-mt-1 tw-block tw-w-full" autocomplete="current-password" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="tw-mt-1 tw-block tw-w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="tw-mt-1 tw-block tw-w-full" autocomplete="new-password" />
        </div>

        <div class="tw-flex tw-items-center tw-justify-center tw-gap-4">
            <x-cancel-button href="{{ route('dashboard') }}">Cancel</x-cancel-button>
            <x-confirm-button>Confirm</x-confirm-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="tw-text-sm tw-text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</x-card>

@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\ChangePasswordRequest','#submit-form') !!}
@endpush
