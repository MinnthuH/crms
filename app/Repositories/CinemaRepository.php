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
            ->addColumn('hall_ids', function ($cinema) {
                // Check if the hall relationship exists and return the names as badges
                if (!empty($cinema->hall_ids)) {
                    $hallNames = \App\Models\Hall::whereIn('id', json_decode($cinema->hall_ids))
                        ->pluck('name')
                        ->toArray();
                    
                    // Wrap each hall name in a badge and use flexbox for layout
                    $badges = array_map(fn($hall) => "<span class='badge bg-danger tw-mr-1 tw-py-1 tw-px-2'>$hall</span>", $hallNames);
                    
                    return "<div class='tw-flex tw-flex-wrap tw-justify-center'>" . implode('', $badges) . "</div>";
                }
                return '<span class="badge bg-secondary">No Hall</span>';
            })
            ->addColumn('showtime_ids', function ($cinema) {
                // Check if the showtime relationship exists and return the showtimes as badges
                if (!empty($cinema->showtime_ids)) {
                    $showtimes = \App\Models\Showtime::whereIn('id', json_decode($cinema->showtime_ids))
                        ->pluck('showtime')
                        ->toArray();
                    
                    // Format each showtime and wrap it in a badge, use flexbox
                    $badges = array_map(fn($showtime) => "<span class='badge bg-success tw-mr-1 tw-py-1 tw-px-2'>" . \Carbon\Carbon::parse($showtime)->format('h:i A') . "</span>", $showtimes);
                    
                    return "<div class='tw-flex tw-flex-wrap tw-justify-center'>" . implode('', $badges) . "</div>";
                }
                return '<span class="badge bg-secondary">No Showtime</span>';
            })
                ->addColumn('ticketprice_ids', function ($cinema) {
                    if (!empty($cinema->ticketprice_ids)) {
                        // Fetch ticket prices from TicketPrice model
                        $ticketPrices = \App\Models\TicketPrice::whereIn('id', json_decode($cinema->ticketprice_ids))->pluck('price')->toArray();
                        
                        // Wrap each price in a badge and use flexbox
                        $badges = array_map(fn($price) => "<span class='badge bg-primary tw-mr-1 tw-py-1 tw-px-2'>$price</span>", $ticketPrices);
                        
                        return "<div class='tw-flex tw-flex-wrap tw-justify-center'>" . implode('', $badges) . "</div>";
                    }
                    return '<span class="badge bg-secondary">No Price</span>';
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
                ->rawColumns(['hall_ids', 'showtime_ids', 'ticketprice_ids', 'action'])
                ->toJson();
    }


    
}
