@extends('layouts.app')

@section('title', 'Edit Snack Shop User')
<!-- @section('admin-user-page-active', 'active') -->

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-edit tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0">Edit Snack Shop User</h5>
    </div>
    <div class=""></div>

</div>
@endsection

@section('content')

<x-card class="tw-mb-5">


    <form method="post" action="{{ route('snack-shop-user.update', $snackShopUser->id) }}" class="" id="submit-form">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="user_id" value="User" />
            <select name="user_id" id="user_id" class="custom-select">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $snackShopUser->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>
        

        <div class="form-group">
            <x-input-label for="cinema_id" value="Cinema" />
            <select name="cinema_id" id="cinema_id" class="custom-select">
                <option value="">-- Select Cinema --</option>
                @foreach ($snackShops as $snackShop)
                <option value="{{ $snackShop->id }}" {{ old('cinema_id', $snackShopUser->snack_shop_id) == $snackShop->id ? 'selected' : '' }}>
                    {{ $snackShop->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('snack-shop-user.index') }}">Cancel</x-cancel-button>
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
{!! JsValidator::formRequest('App\Http\Requests\AdminUserUpdateRequest', '#submit-form') !!}
@endpush