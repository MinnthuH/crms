<?php

namespace App\Repositories;

use Carbon\Carbon;
    use App\Models\Showtime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class ShowtimeRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = Showtime::class;
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
        $model = Showtime::query();
            return DataTables::eloquent($model)
            ->addColumn('showtime', function ($showtime) {
                return Carbon::parse($showtime->showtime)->format('h:i A');
            })
                ->editColumn('created_at', function ($showtime) {
                    return $showtime->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('updated_at', function ($showtime) {
                    return $showtime->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($showtime) {
                    return view('showtime._action', compact('showtime'));
                })
                ->editColumn('responsive-icon', function ($showtime) {
                    return null;
                })
                ->toJson();
    }
}

