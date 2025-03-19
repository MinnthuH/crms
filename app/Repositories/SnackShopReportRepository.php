<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\CinemaReport;
use Illuminate\Http\Request;
use App\Models\SnackShopReport;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class SnackShopReportRepository implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = SnackShopReport::class;
    }

    public function find($id)
    {
        $record = $this->model::with(['cinema', 'snackShop', 'user'])->find($id);

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
        $model = SnackShopReport::query();
        $user = Auth::user();

        if ($user->role == 1) {
            // If the user is Snack Shop (role 0), return all records
            $model = $model->with(['snackShop', 'user', 'cinema']); // Eager load relationships
        } else {
            // If the user is not Snack Shop (role 0), filter by user's cinema_id
            $model = $model->where('cinema_id', $user->cinema_id)
                           ->with(['snackShop', 'user', 'cinema']); // Eager load relationships
        }
        return DataTables::eloquent($model)
            ->editColumn('snack_shop_id', function ($snackShopReport) {
                return $snackShopReport->snackShop->name;
            })
            ->editColumn('opening_balance', function ($snackShopReport) {
                return number_format((int) $snackShopReport->opening_balance) . ' MMK';
            })
            ->editColumn('sales', function ($snackShopReport) {
                return number_format((int) $snackShopReport->sales) . ' MMK';
            })
            ->editColumn('save_amount', function ($snackShopReport) {
                return number_format((int) $snackShopReport->save_amount) . ' MMK';
            })
            ->editColumn('total_expenses', function ($snackShopReport) {
                return number_format((int) $snackShopReport->total_expenses) . ' MMK';
            })
            ->editColumn('transfer_amount', function ($snackShopReport) {
                return number_format((int) $snackShopReport->transfer_amount) . ' MMK';
            })
            ->editColumn('closing_balance', function ($snackShopReport) {
                return number_format((int) $snackShopReport->closing_balance) . ' MMK';
            })
            ->editColumn('surplus_deficits', function ($snackShopReport) {
                return number_format((int) $snackShopReport->surplus_deficits) . ' MMK';
            })
            ->editColumn('total_surplus_deficits', function ($snackShopReport) {
                return number_format((int) $snackShopReport->total_surplus_deficits) . ' MMK';
            })
            ->editColumn('description', function ($snackShopReport) {
                return $snackShopReport->description;
            })
     
            ->addColumn('action', function ($snackShopReport) {
                return view('snack-shop-report._action', compact('snackShopReport'));
            })
            ->editColumn('responsive-icon', function ($price) {
                return null;
            })
            ->toJson();
    }
}
