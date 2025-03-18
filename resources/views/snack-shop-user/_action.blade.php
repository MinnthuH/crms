<x-edit-button href="{{ route('snack-shop-user.edit', $snackShopUser->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('snack-shop-user.destroy', $snackShopUser->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
