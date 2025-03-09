<x-edit-button href="{{ route('hall.edit', $hall->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('hall.destroy', $hall->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
