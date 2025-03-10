<?php

namespace App\Repositories;

use Carbon\Carbon;
    use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class MovieRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = Movie::class;
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
        $model = Movie::query();
            return DataTables::eloquent($model)
                ->editColumn('created_at', function ($movie) {
                    return $movie->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('updated_at', function ($movie) {
                    return $movie->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($movie) {
                    return view('movie._action', compact('movie'));
                })
                ->editColumn('responsive-icon', function ($movie) {
                    return null;
                })
                ->toJson();
    }
}

