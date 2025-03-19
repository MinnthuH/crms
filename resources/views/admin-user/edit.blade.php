@extends('layouts.app')

@section('title', 'Edit Admin User')
<!-- @section('admin-user-page-active', 'active') -->

@section('header')
    <div class="tw-flex tw-justify-between tw-items-center">
        <div class="tw-flex tw-justify-between tw-items-center">
            <i class="fas fa-user tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
            <h5 class="tw-text-lg tw-mb-0 tw-p-3">Edit User</h5>
        </div>
        <div class=""></div>

    </div>
@endsection

@section('content')

    <x-card class="tw-mb-5">


        <form method="post" action="{{ route('admin-user.update', $admin_user->id) }}" class="" id="submit-form">
            @csrf
            @method('put')

             <div class="form-group">
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="tw-mt-1 tw-block tw-w-full"
                :value="old('name', $admin_user->name)" />

        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="tw-mt-1 tw-block tw-w-full"
                :value="old('email', $admin_user->email)" />

        </div>

        <div class="form-group">
            <x-input-label for="cinema_id" value="Cinema" />
            <select name="cinema_id" id="cinema_id" class="custom-select">
                <option value="">-- Select Cinema --</option>
                @foreach ($cinemas as $cinema)
                <option value="{{ $cinema->id }}" {{ old('cinema_id', $admin_user->cinema_id) == $cinema->id ? 'selected' : '' }}>
                    {{ $cinema->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="role" value="Role" />
            <select name="role" id="role" class="custom-select">
                <option value="2" {{ old('role', isset($admin_user) ? $admin_user->role : '') == 2 ? 'selected' : '' }}>Cinema</option>
                <option value="0" {{ old('role', isset($admin_user) ? $admin_user->role : '') == 0 ? 'selected' : '' }}>Snack Shop</option>
            </select>
        </div>

        <div class="form-group">
            <x-input-label for="status" value="Status" />
            <select name="status" id="status" class="custom-select">
                <option value="1" {{ old('status', isset($admin_user) ? $admin_user->status : '') == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', isset($admin_user) ? $admin_user->status : '') == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>


        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('admin-user.index') }}">Cancel</x-cancel-button>
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
