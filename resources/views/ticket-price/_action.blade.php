<x-edit-button href="{{ route('ticket-price.edit', $price->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('ticket-price.destroy', $price->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
