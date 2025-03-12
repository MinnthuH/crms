<x-edit-button href="{{ route('cinema.edit', $cinema->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('cinema.destroy', $cinema->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
