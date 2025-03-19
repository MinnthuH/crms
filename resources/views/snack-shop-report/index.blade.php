@extends('layouts.app')

@section('title', 'Snack Shop Report')

@section('snackshop-report-page-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-receipt tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0 tw-p-3">Snack Shop Report</h5>
    </div>
    <div>
        @if (Auth::user()->role == 0)
        <x-create-button href="{{ route('snack-shop-report.create') }}"><i class="fas fa-plus-circle tw-mr-1"></i>create</x-create-button>
        @elseif(Auth::user()->role == 1)
        <x-download-button href="{{ route('snack-shop-report.download', ['date' => now()->toDateString()]) }}"><i class="fas fa-download tw-mr-1"></i>Daily Download</x-download-button>
        <x-download-button href="{{ route('export-snack-shop-weekly') }}"><i class="fas fa-download tw-mr-1"></i>Weekly Download</x-download-button>

        @endif
    </div>
</div>
@endsection

@section('content')
<x-card class="tw-pb-5">
    <table class="table table-bordered DataTable-tb">
        <thead>
            <tr>
                <th class="text-center no-sort no-search"></th>
                <th class="text-center">မုန်ဆိုင်အမည်</th>
                <th class="text-center">Date</th>
                <th class="text-center">စာရင်းဖွင့် (Opening Balance)</th>
                <th class="text-center">စာရင်းရရောင်းရငွေ</th>
                <th class="text-center">အပ်ငွေ</th>
                <th class="text-center">ယူငွေ / သုံးငွေ</th>
                <th class="text-center">လွှဲငွေ</th>
                <th class="text-center">စာရင်းပိတ်ငွေ</th>
                <th class="text-center"> ပိုငွေ / လို‌ငွေ</th>
                <th class="text-center no-sort no-search">Action</th>
            </tr>
        </thead>
    </table>
</x-card>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = new DataTable('.DataTable-tb', {
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('snack-shop-report-databale') }}",
                data: function(d) {

                }
            },
            columns: [{
                    data: 'responsive-icon',
                    class: 'text-center',

                },
                {
                    data: 'snack_shop_id',
                    class: 'text-center',

                },
                {
                    data: 'date',
                    class: 'text-center'
                },
                {
                    data: 'opening_balance',
                    class: 'text-center'
                },
                {
                    data: 'sales',
                    class: 'text-center'
                },
                {
                    data: 'save_amount',
                    class: 'text-center'
                },
                {
                    data: 'total_expenses',
                    class: 'text-center'
                },
                {
                    data: 'transfer_amount',
                    class: 'text-center'
                },
                {
                    data: 'closing_balance',
                    class: 'text-center'
                },
                {
                    data: 'surplus_deficits',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'text-center'
                },
            ],
            order: [
                [3, 'desc']
            ],
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                },
                {
                    targets: 'no-search',
                    searchable: false
                },
                {
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    className: 'control'
                }
            ],


        });

        $(document).on('click', '.delete-button', function(e) {
            event.preventDefault();
            var url = $(this).data('url');
            deleteDialog.fire().then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            table.ajax.reload();
                            toastr.success(response.message);
                        }
                    })
                }
            });


        });
    })
</script>
@endpush