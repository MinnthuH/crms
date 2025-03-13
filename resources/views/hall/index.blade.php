@extends('layouts.app')

@section('title', 'Hall')

@section('hall-page-active', 'active')

@section('header')
<div class="tw-flex tw-justify-between tw-items-center">
    <div class="tw-flex tw-justify-between tw-items-center">
        <i class="fas fa-hotel tw-p-3 tw-bg-white tw-rounded-lg tw-shadow tw-mr-1"></i>
        <h5 class="tw-text-lg mb-0">Hall</h5>
    </div>
    <div>
        <x-create-button href="{{ route('hall.create') }}"><i class="fas fa-plus-circle tw-mr-1"></i>create</x-create-button>
    </div>
</div>
@endsection

@section('content')
<x-card class="tw-pb-5">
    <table class="table table-bordered DataTable-tb">
        <thead>
            <tr>
                <th class="text-center no-sort no-search"></th>
                <th class="text-center">Name</th>
                <th class="text-center">Created at</th>
                <th class="text-center">Updated at</th>
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
                url: "{{ route('hall-databale') }}",
                data: function(d) {

                }
            },
            columns: [{
                    data: 'responsive-icon',
                    class: 'text-center',

                },
                {
                    data: 'name',
                    class: 'text-center'
                },
                {
                    data: 'created_at',
                    class: 'text-center'
                },
                {
                    data: 'updated_at',
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