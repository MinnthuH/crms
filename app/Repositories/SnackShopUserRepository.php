<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\SnackShopUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class SnackShopUserRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = SnackShopUser::class;
    }

    public function find($id)
    {
        $record = $this->model::find($id);

        return $record;
    }

    public function create(array $data)
    {
        $record = $this->model::create($data);
        return $record;
    }

    public function update(array $data, $id)
    {
        $record = $this->model::find($id);
        $record->update($data);

        return $record;
    }

    public function delete($id)
    {
        $record = $this->model::find($id);
        $record->delete();
    }


    public function datatable(Request $request)
    {
        $model = SnackShopUser::query();
        return DataTables::eloquent($model)
            ->editColumn('name', function ($snackShopUser) {
                return optional($snackShopUser->user)->name; // Avoid errors if cinema is null
            })
            ->editColumn('snack_shop', function ($snackShopUser) {
                return optional($snackShopUser->snackShop)->name; // Avoid errors if cinema is null
            })

            ->editColumn('created_at', function ($snackShopUser) {
                return $snackShopUser->created_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->editColumn('updated_at', function ($snackShopUser) {
                return $snackShopUser->updated_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->addColumn('action', function ($snackShopUser) {
                return view('snack-shop-user._action', compact('snackShopUser'));
            })
            ->editColumn('responsive-icon', function ($snackShopUser) {
                return null;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
     
}

