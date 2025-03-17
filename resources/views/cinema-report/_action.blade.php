<x-edit-button href="{{ route('cinema-report.edit', $cinemaReport->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-detail-button href="{{ route('cinema-report.show', $cinemaReport->id) }}"><i class="fas fa-eye"></i></x-detail-button>
@if(Auth::user()->role == 1)
<x-delete-button href="#" class="delete-button" data-url="{{ route('cinema-report.destroy', $cinemaReport->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
@endif
