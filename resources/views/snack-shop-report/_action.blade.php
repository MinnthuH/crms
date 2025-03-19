<x-edit-button href="{{ route('snack-shop-report.edit', $snackShopReport->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-detail-button href="{{ route('snack-shop-report.show', $snackShopReport->id) }}"><i class="fas fa-eye"></i></x-detail-button>
@if(Auth::user()->role == 1)
<x-delete-button href="#" class="delete-button" data-url="{{ route('snack-shop-report.destroy', $snackShopReport->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
@endif
