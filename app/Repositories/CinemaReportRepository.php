<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\CinemaReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class CinemaReportRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = CinemaReport::class;
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


    // public function datatable(Request $request)
    // {
        
    //     $model = CinemaReport::query();
    //         return DataTables::eloquent($model)
    //             ->editColumn('cinema_id', function ($cinemaReport) {
    //                 return optional($cinemaReport->cinema)->name;
    //             })
    //             ->editColumn('showtime_id', function ($cinemaReport) {
    //                 return Carbon::parse($cinemaReport->showtime->showtime)->format('h:i A');
    //             })
    //             ->editColumn('hall_id', function ($cinemaReport) {
    //                 return optional($cinemaReport->hall)->name;
    //             })
    //             ->editColumn('movie_id', function ($cinemaReport) {
    //                 return optional($cinemaReport->movie)->name;
    //             })
    //             // ->editColumn('total_revenue', function ($cinemaReport) {
    //             //     return $cinemaReport->total_revenue . ' MMK';
    //             // })
    //             ->editColumn('epc_id', function ($cinemaReport) {
    //                 return optional($cinemaReport->epc)->status . '%';
    //             })
    //             // ->editColumn('created_at', function ($cinemaReport) {
    //             //     return $cinemaReport->created_at->format('Y-m-d H:i:s');
    //             // })
    //             // ->editColumn('show_date', function ($cinemaReport) {
    //             //     return $cinemaReport->show_date->format('Y-m-d');
    //             // })
    //             ->editColumn('updated_at', function ($cinemaReport) {
    //                 return $cinemaReport->updated_at->format('Y-m-d H:i:s');
    //             })
    //             ->addColumn('action', function ($cinemaReport) {
    //                 return view('cinema-report._action', compact('cinemaReport'));
    //             })
    //             ->editColumn('responsive-icon', function ($cinemaReport) {
    //                 return null;
    //             })
    //             ->toJson();
    // }

    public function datatable(Request $request)
{
    // Check if the request is an AJAX request
    if ($request->ajax()) {
        // Get the current authenticated user
        $user = Auth::user();

        // Initialize the query for CinemaReport
        $model = CinemaReport::query();

        // Check the role of the user
        if ($user->role == 1) {
            // If the user is Admin (role 1), return all records
            $model = $model->with(['cinema', 'showtime', 'hall', 'movie', 'epc']); // Eager load relationships
        } else {
            // If the user is not Admin (role 0), filter by user's cinema_id
            $model = $model->where('cinema_id', $user->cinema_id)
                           ->with(['cinema', 'showtime', 'hall', 'movie', 'epc']); // Eager load relationships
        }

        // Apply DataTables to the query
        return DataTables::eloquent($model)
            ->editColumn('cinema_id', function ($cinemaReport) {
                return optional($cinemaReport->cinema)->name;
            })
            ->editColumn('showtime_id', function ($cinemaReport) {
                return Carbon::parse($cinemaReport->showtime->showtime)->format('h:i A');
            })
            ->editColumn('hall_id', function ($cinemaReport) {
                return optional($cinemaReport->hall)->name;
            })
            ->editColumn('movie_id', function ($cinemaReport) {
                return optional($cinemaReport->movie)->name;
            })
            ->editColumn('epc_id', function ($cinemaReport) {
                return optional($cinemaReport->epc)->status . '%';
            })
            ->editColumn('updated_at', function ($cinemaReport) {
                return $cinemaReport->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($cinemaReport) {
                return view('cinema-report._action', compact('cinemaReport'));
            })
            ->editColumn('responsive-icon', function ($cinemaReport) {
                return null;
            })
            ->toJson();
    }
}

}
