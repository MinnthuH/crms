<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class AdminUserRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = AdminUser::class;
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
        $model = AdminUser::query();
            return DataTables::eloquent($model)
            ->editColumn('cinema', function ($admin_user) {
                return optional($admin_user->cinema)->name; // Avoid errors if cinema is null
            })
            ->editColumn('status', function ($admin_user) {
                $status = $admin_user->acsrStatus; // Access like a property
                return '<span style="color: #'.$status['color'].'">'.$status['text'].'</span>';
            })
            ->editColumn('status', function ($admin_user) {
                $status = $admin_user->acsrStatus; // Access like a property
                return '<span style="color: #'.$status['color'].'">'.$status['text'].'</span>';
            })
            ->editColumn('role', function ($admin_user) {
                $role = $admin_user->acsrRole; // Access like a property
                return '<span style="color: #'.$role['color'].'">'.$role['text'].'</span>';
            })
            ->editColumn('created_at', function ($admin_user) {
                return $admin_user->created_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->editColumn('updated_at', function ($admin_user) {
                return $admin_user->updated_at?->format('Y-m-d H:i:s') ?? '-';
            })
            ->addColumn('action', function ($admin_user) {
                return view('admin-user._action', compact('admin_user'));
            })
            ->editColumn('responsive-icon', function ($admin_user) {
                return null;
            })
            ->rawColumns(['status', 'role'])
            ->toJson();
    }
}

