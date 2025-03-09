<?php

namespace App\Repositories;

use Carbon\Carbon;
    use App\Models\Hall;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class HallRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = Hall::class;
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
        $model = Hall::query();
            return DataTables::eloquent($model)
                ->editColumn('created_at', function ($hall) {
                    return $hall->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('updated_at', function ($hall) {
                    return $hall->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($hall) {
                    return view('hall._action', compact('hall'));
                })
                ->editColumn('responsive-icon', function ($hall) {
                    return null;
                })
                ->toJson();
    }
}

