<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Epc;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class EpcRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = Epc::class;
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
        $model = Epc::query();
        return DataTables::eloquent($model)
            ->editColumn('status', function ($epc) {
                return $epc->status . '%';
            })
            ->editColumn('created_at', function ($epc) {
                return $epc->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($epc) {
                return $epc->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($epc) {
                return view('epc._action', compact('epc'));
            })
            ->editColumn('responsive-icon', function ($epc) {
                return null;
            })
            ->toJson();
    }
}
