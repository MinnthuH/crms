@extends('layouts.app')

@section('title', 'Edit Snack Shop Report')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-edit tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0 tw-p-3">Edit{{$cinema->name}}<span></span> Snack Shop Report</h5>
    </div>
</div>
@endsection

@section('content')

<x-card class="tw-mb-5">

    <form method="post" action="{{ route('snack-shop-report.update', $snackShopReport->id) }}" id="submit-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-input-label for="date" value="Date" />
            <x-text-input id="date" name="date" type="date" class="tw-mt-1 tw-block tw-w-full"
                :value="old('date', $snackShopReport->date)" />
        </div>


        <div class="form-group">
            <x-input-label for="opening_balance" value="Opening Balance" />
            <x-text-input
                id="opening_balance"
                name="opening_balance"
                type="number"
                class="tw-mt-1 tw-block tw-w-full"
                :value="old('opening_balance', (int) $snackShopReport->opening_balance)" />
        </div>

        <div class="form-group">
            <x-input-label for="sales" value="Sales" />
            <x-text-input id="sales" name="sales" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('sales', (int) $snackShopReport->sales)" />
        </div>

        <div class="form-group">
            <x-input-label for="save_amount" value="Save Amount" />
            <x-text-input id="save_amount" name="save_amount" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('save_amount', (int) $snackShopReport->save_amount)" />
        </div>
        <div class="form-group">
            <x-input-label for="total_expenses" value="Total Expenses" />
            <x-text-input id="total_expenses" name="total_expenses" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_expenses', (int) $snackShopReport->total_expenses)" />
        </div>
        <div class="form-group">
            <x-input-label for="transfer_amount" value="Transfer Amount" />
            <x-text-input id="transfer_amount" name="transfer_amount" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('transfer_amount', (int) $snackShopReport->transfer_amount)" />
        </div>
        <div class="form-group">
            <x-input-label for="closing_balance" value="Closing Balance" />
            <x-text-input id="closing_balance" name="closing_balance" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('closing_balance', (int) $snackShopReport->closing_balance)" />
        </div>
        <div class="form-group">
            <x-input-label for="surplus_deficits" value="Surplus/Deficits" />
            <x-text-input id="surplus_deficits" name="surplus_deficits" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('surplus_deficits', (int) $snackShopReport->surplus_deficits)" />
        </div>
        <div class="form-group">
            <x-input-label for="total_surplus_deficits" value="Total Surplus/Deficits" />
            <x-text-input id="total_surplus_deficits" name="total_surplus_deficits" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_surplus_deficits', (int) $snackShopReport->total_surplus_deficits)" />
        </div>
        <div class="form-group">
            <x-input-label for="description" value="Description" />
            <x-text-input id="description" name="description" class="tw-mt-1 tw-block tw-w-full"
                :value="old('description', $snackShopReport->description)" />
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cinema_id" value="{{ $cinema_id }}">
        <input type="hidden" name="snack_shop_id" value="{{ $snack_shop_id }}">

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('snack-shop-report.index') }}">Cancel</x-cancel-button>
            <x-confirm-button>Update</x-confirm-button>
        </div>
    </form>

</x-card>

@endsection

@push('scripts')
{!! JsValidator::formRequest('App\Http\Requests\SnackShopReportUpdateRequest', '#submit-form') !!}
@endpush