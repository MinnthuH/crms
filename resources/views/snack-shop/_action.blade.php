<x-edit-button href="{{ route('snack-shop.edit', $snackShop->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('snack-shop.destroy', $snackShop->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
