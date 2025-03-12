<x-edit-button href="{{ route('epc.edit', $epc->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('epc.destroy', $epc->id) }}"><i
        class="fas fa-trash"></i></x-delete-button>
