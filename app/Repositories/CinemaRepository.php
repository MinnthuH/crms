<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class CinemaRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = Cinema::class;
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
        $model = Cinema::query();
            return DataTables::eloquent($model)
                ->addColumn('hall_id', function ($cinema) {
                    return $cinema->hall->name;
                })
                ->addColumn('showtime_id', function ($cinema) {
                    return \Carbon\Carbon::parse($cinema->showtime->showtime)->format('h:i A'); 
                })
                ->addColumn('ticketprice_id', function ($cinema) {
                    return $cinema->ticketprice->price;
                })
                ->editColumn('updated_at', function ($cinema) {
                    return $cinema->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($cinema) {
                    return view('cinema._action', compact('cinema'));
                })
                ->editColumn('responsive-icon', function ($cinema) {
                    return null;
                })
                ->toJson();
    }


    
}
