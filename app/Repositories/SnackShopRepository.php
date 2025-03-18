<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\SnackShop;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class SnackShopRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = SnackShop::class;
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
        $model = SnackShop::query();
        return DataTables::eloquent($model)
            ->editColumn('cinema', function ($snackShop) {
                return optional($snackShop->cinema)->name; // Avoid errors if cinema is null
            })
            ->editColumn('created_at', function ($snackShop) {
                return $snackShop->created_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->editColumn('updated_at', function ($snackShop) {
                return $snackShop->updated_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->addColumn('action', function ($snackShop) {
                return view('snack-shop._action', compact('snackShop'));
            })
            ->editColumn('responsive-icon', function ($snackShop) {
                return null;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
     
}

