@extends('layouts.app')

@section('title', 'Create Snack Shop User')
@section('snack-shop-user-page-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-plus-circle tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0">Create Snack Shop User</h5>
    </div>
    <div class=""></div>

</div>
@endsection

@section('content')

<x-card class="tw-mb-5">


    <form method="post" action="{{ route('snack-shop-user.store') }}" class="" id="submit-form">
        @csrf


        <div class="form-group">
            <x-input-label for="user_id" value="User" />
            <select name="user_id" id="user_id" class="custom-select">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <x-input-label for="snack_shop_id" value="Snack Shop" />
            <select name="snack_shop_id" id="snack_shop_id" class="custom-select">
                <option value="">-- Select Snack Shop --</option>
                @foreach ($snackShops as $snackShop)
                <option value="{{$snackShop->id}}">{{$snackShop->name}}</option>
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
{!! JsValidator::formRequest('App\Http\Requests\SnackShopUserStoreRequest', '#submit-form') !!}

<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "-- Select User --",
            allowClear: true
        });
        $('#snack_shop_id').select2({
            placeholder: "-- Select Snack Shop --",
            allowClear: true
        });
    });
</script>
@endpush