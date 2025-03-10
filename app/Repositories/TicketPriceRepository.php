<?php

namespace App\Repositories;

use Carbon\Carbon;
    use App\Models\TicketPrice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class TicketPriceRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = TicketPrice::class;
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
        $model = TicketPrice::query();
            return DataTables::eloquent($model)
            ->addColumn('price', function ($price) {
                return number_format($price->price) . ' MMK' ?? '-';
            })
                ->editColumn('created_at', function ($price) {
                    return $price->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('updated_at', function ($price) {
                    return $price->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($price) {
                    return view('ticket-price._action', compact('price'));
                })
                ->editColumn('responsive-icon', function ($price) {
                    return null;
                })
                ->toJson();
    }
    
    
}

