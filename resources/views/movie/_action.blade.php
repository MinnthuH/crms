<x-edit-button href="{{ route('movie.edit', $movie->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('movie.destroy', $movie->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
