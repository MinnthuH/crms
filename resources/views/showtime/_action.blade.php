<x-edit-button href="{{ route('showtime.edit', $showtime->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('showtime.destroy', $showtime->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
