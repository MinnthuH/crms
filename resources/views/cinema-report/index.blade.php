@extends('layouts.app')

@section('title', 'Cinema Report')

@section('cinema-report-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-hotel tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0 tw-p-3">Cinema Report</h5>
    </div>
    <div>
        <x-create-button href="{{ route('cinema-report.create') }}"><i class="fas fa-plus-circle tw-mr-1"></i>create</x-create-button>
    </div>
</div>
@endsection

@section('content')
<x-card class="tw-pb-5">
    <table class="table table-bordered DataTable-tb">
        <thead>
            <tr>
                <th class="text-center no-sort no-search"></th>
                <th class="text-center">Cinema</th>
                <th class="text-center">Showtime</th>
                <th class="text-center">Hall</th>
                <th class="text-center">Movie</th>
                <th class="text-center">Total Seats</th>
                <th class="text-center">Total Revenue</th>
                <th class="text-center">EPC</th>
                <th class="text-center">Show Date</th>
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
                url: "{{ route('cinema-report-databale') }}",
                data: function(d) {

                }
            },
            columns: [{
                    data: 'responsive-icon',
                    class: 'text-center',

                },
                {
                    data: 'cinema_id',
                    class: 'text-center'
                },
                {
                    data: 'showtime_id',
                    class: 'text-center'
                },
                {
                    data: 'hall_id',
                    class: 'text-center'
                },
                {
                    data: 'movie_id',
                    class: 'text-center'
                },
                {
                    data: 'total_seats',
                    class: 'text-center'
                },
                {
                    data: 'total_revenue',
                    class: 'text-center'
                },
                {
                    data: 'epc_id',
                    class: 'text-center'
                },
                {
                    data: 'show_date',
                    class: 'text-center'
                },
                {
                    data: 'action',
                    class: 'text-center'
                },
            ],
            order: [
                [6, 'desc']
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