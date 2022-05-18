<?php

namespace App\DataTables;

use App\Models\Admin\Coupon;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            
        ->addColumn('action', function ($query) {   
            return '<form action="'. route("Coupon.destroy",$query->id) .'" method="POST"" >
            
            <input name="_token" type="hidden" value="'. csrf_token() .'">
            <input name="_method" type="hidden" value="DELETE">
            <a href="' . route("Coupon.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
            <a href="' . route("Coupon.active", $query->id) . '" class="btn btn-warning " title="active/inactive" >
            <i class="fas fa-cogs fa-lg" style=" color: black !important;">
            </i></a> 
            <button type="submit" class="btn btn-danger" id="delete" title="delete" >
            <i class="fas fa-trash fa-lg"></i></button>
            
            </form>';
         
        })
        ->rawColumns(['action'])
        ->editColumn('Coupon_Percentage', function($query) {
            return    '<span class="badge badge-pill badge-warning">'.$query->discount.'% </span>';  ;
        })->escapeColumns('Coupon_Percentage')
        ->editColumn('status', function($query) {
            if ($query->status == 1 ) {
                return '<span class="badge badge-pill badge-success">Active</span>';
            }else{
                return '<span class="badge badge-pill badge-danger">inActive</span>';
            }  
        })->escapeColumns('status')
        ->editColumn('expired_date', function($query) {
            return Carbon::createFromTimeStamp(strtotime($query->expiry_date))->diffForHumans(now(),false);
        })->escapeColumns('expired_date');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('coupon-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('reload'),
            Button::make('create')->action("window.location = '".route('Coupon.create')."';")->addClass('btn btn-success'),
            Button::make('pageLength')->className('showrows'),
        )->parameters([
            'responsive' => true,
            'autoWidth' => false,
            "scrollX" => true, 
            'searching'=>true
         
        ]); 
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('Coupon_Percentage')->width(30)->addClass('text-center'),
            Column::make('code')->searchable(true),
            Column::computed('expired_date'),
            Column::make('status'),
            Column::make('updated_at'),
            Column::computed('action')
            ->width(250)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Coupon_' . date('YmdHis');
    }
}
