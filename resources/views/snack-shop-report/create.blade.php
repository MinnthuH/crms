@extends('layouts.app')

@section('title', 'Create Snack Shop Report')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-plus tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg tw-mb-0 tw-p-3">{{$cinema->name??'-'}}<span></span> Snack Shop Report</h5>
    </div>
    <div class=""></div>

</div>
@endsection

@section('content')

<x-card class="tw-mb-5">

    <form method="post" action="{{ route('snack-shop-report.store') }}" class="" id="submit-form">
        @csrf


        <div class="form-group">
            <x-input-label for="date" value="Date" />
            <x-text-input id="date" name="date" type="date" class="tw-mt-1 tw-block tw-w-full"
                :value="old('date')" />
        </div>


        <div class="form-group">
            <x-input-label for="opening_balance" value="စာရင်းဖွင့် (Opening Balance)" /> 
            <small class="tw-text-gray-500">နယ်ရုံ /ဘဏ်လွှဲရုံ အဓိကမနေ့ကမုန်ဆိုင်ငွေလက်ကျန်ပါ။ (အကြွေမပါ)</small>
            <x-text-input id="opening_balance" name="opening_balance" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('opening_balance')" />
        </div>
        <div class="form-group">
            <x-input-label for="sales" value="စာရင်းရရောင်းရငွေ" />
            <small class="tw-text-gray-500">ဒီနေ့ရောင်းရတဲ့ငွေ (‌စာရင်းရရောင်းရငွေ)</small>
            <x-text-input id="sales" name="sales" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('sales')"/>
        </div>

        <div class="form-group">
            <x-input-label for="save_amount" value="အပ်ငွေ" />
            <small class="tw-text-gray-500">ရန်ကုန်ငွေသိမ်းရုံ = ရုံးချုပ်သို့အပ်သောငွေသား နယ်ရုံ /ဘဏ်လွှဲရုံ = မုန်ဆိုင်မှ လာအပ်သောငွေသား</small>
            <x-text-input id="save_amount" name="save_amount" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('save_amount')" />
        </div>
        <div class="form-group">
            <x-input-label for="total_expenses" value="ယူငွေ / သုံးငွေ" />
            <small class="tw-text-gray-500">ကုန်ဝယ်၊ လစာ၊ အခြားသုံး</small>
            <x-text-input id="total_expenses" name="total_expenses" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_expenses')" />
        </div>
        <div class="form-group">
            <x-input-label for="transfer_amount" value="လွှဲငွေ" />
            <small class="tw-text-gray-500">ဘဏ်ဖြင့် လွှဲသောငွေ</small>
            <x-text-input id="transfer_amount" name="transfer_amount" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('transfer_amount')" />
        </div>
        <div class="form-group">
            <x-input-label for="closing_balance" value="မုန့်ဆိုင်ငွေလက်ကျန် (Closing Balance)" />
            <small class="tw-text-gray-500">နယ်ရုံ /ဘဏ်လွှဲရုံ အဓိက မနေ့ကမုန်ဆိုင်ငွေလက်ကျန် + ဒီနေ့အပ်ငွေ - ယူသုံးငွေ - လွှဲငွေ = မုန်ဆိုင်ငွေလက်ကျန် </small>
            <x-text-input id="closing_balance" name="closing_balance" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('closing_balance')" />
        </div>
        <div class="form-group">
            <x-input-label for="surplus_deficits" value=" ပိုငွေ / လို‌ငွေ" />
            <small class="tw-text-gray-500">စာရင်းရရောင်း‌ငွေ နှင့် အပ်‌ငွေ ပိုရင် ၅၀၀ / လိုရင် -၅၀၀ (အနှတ်လက္ခဏာပြပါ) </small>
            <x-text-input id="surplus_deficits" name="surplus_deficits" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('surplus_deficits')" />
        </div>
        <div class="form-group">
            <x-input-label for="total_surplus_deficits" value="ပိုငွေ / လို‌ငွေ လက်ကျန်စာရင်း" />
            <small class="tw-text-gray-500">ဥပမာ ၁-၁၁-၂၀၂၃ = ၁၀၀၀ ပို။ ၂-၁၁-၂၀၂၃ =  -၅၀၀ လို။ ၂-၁၁-၂၀၂၃ လက်ကျန်စာရင်း = ၅၀၀ </small>
            <x-text-input id="total_surplus_deficits" name="total_surplus_deficits" type="number" class="tw-mt-1 tw-block tw-w-full"
                :value="old('total_surplus_deficits')" />
        </div>
        <div class="form-group">
            <x-input-label for="description" value="Description" />
            <x-text-input id="description" name="description" class="tw-mt-1 tw-block tw-w-full"
                :value="old('description')" />
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="cinema_id" value="{{ $cinema_id }}">
        <input type="hidden" name="snack_shop_id" value="{{ $snack_shop_id }}">

        <div class="tw-flex tw-justify-center tw-items-center tw-gap-4 tw-mt-5">
            <x-cancel-button href="{{ route('snack-shop-report.index') }}">Cancel</x-cancel-button>
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
{!! JsValidator::formRequest('App\Http\Requests\SnackShopReportStoreRequest', '#submit-form') !!}


@endpush