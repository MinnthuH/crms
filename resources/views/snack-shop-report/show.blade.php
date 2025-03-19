@extends('layouts.app')

@section('title', 'Snack Shop Report Details')

@section('snack-shop-report-page-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-info tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0 tw-p-3">Snack Shop Report Details</h5>
    </div>
    <div>
        <x-exit-button href="{{ route('snack-shop-report.index') }}">
            <i class="fas fa-arrow-left tw-mr-1"></i>Back
        </x-exit-button>
    </div>
</div>
@endsection

@section('content')
<x-card class="tw-pb-5">
    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-text-gray-800">
        <div><strong>ရုံအမည် :</strong> {{ $snackShopReport->cinema->name ?? 'N/A' }}</div>
        <div><strong>မုန်ဆိုင်အမည် :</strong> {{ $snackShopReport->snackShop->name ?? 'N/A' }}</div>
        <div><strong>တာဝန်ခံ အမည်:</strong> {{ $snackShopReport->user->name ?? 'N/A' }}</div>

        <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($snackShopReport->date ?? '00:00:00')->format('d-m-Y') }}</div>
        <div><strong>စာရင်းဖွင့် (Opening Balance):</strong> {{ number_format($snackShopReport->opening_balance) }} MMK</div>

        <div><strong>စာရင်းရရောင်းရငွေ:</strong> {{ number_format($snackShopReport->sales) }} MMK</div>
        <div><strong>အပ်ငွေ:</strong> {{ number_format($snackShopReport->save_amount) }} MMK</div>
        <div><strong>ယူငွေ/သုံးငွေ :</strong> {{ number_format($snackShopReport->total_expenses) }} MMK</div>
        <div><strong> လွှဲငွေ :</strong> {{ number_format($snackShopReport->transfer_amount) }} MMK</div>
        <div><strong>မုန့်ဆိုင်ငွေလက်ကျန် (Closing Balance):</strong> {{ number_format($snackShopReport->closing_balance) }} MMK</div>
        <div><strong>ပိုငွေ / လို‌ငွေ:</strong> {{ number_format($snackShopReport->surplus_deficits) }} MMK</div>
        <div><strong>ပိုငွေ / လို‌ငွေ လက်ကျန်စာရင်း:</strong> {{ number_format($snackShopReport->total_surplus_deficits) }} MMK</div>
        <div><strong>Description:</strong> {{ $snackShopReport->description ?? 'N/A' }}</div>
    </div>
</x-card>
@endsection
