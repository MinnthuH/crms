<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class UserRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = User::class;
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
        $model = User::query();
        return DataTables::eloquent($model)
            ->editColumn('cinema', function ($user) {
                return optional($user->cinema)->name; // Avoid errors if cinema is null
            })
            ->editColumn('status', function ($user) {
                $status = $user->acsrStatus; // Access like a property
                return '<span style="color: #'.$status['color'].'">'.$status['text'].'</span>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->addColumn('action', function ($user) {
                return view('user._action', compact('user'));
            })
            ->editColumn('responsive-icon', function ($user) {
                return null;
            })
            ->rawColumns(['status'])
            ->toJson();
    }
    
}

