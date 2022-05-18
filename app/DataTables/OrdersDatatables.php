<?php

namespace App\DataTables;

use App\Models\Users\Orders;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDatatables extends DataTable
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
            ->editColumn('action', function($query) {
              if ($query->status == 'paid') {
               return '<select name="guard_name" class="form-control text-center" onchange="javascript:handleSelect(this)" style="padding: 0.3rem 0.75rem; border-radius: 50px;">
               <option selected value="' .route("order.update",[$query->id,'paid']).'" >paid</option>
               <option value="' .route("order.update",[$query->id,'unpaid']).'" >unpaid</option>
               <option value="' .route("order.update",[$query->id,'cancel']).'" >cancel</option>
               <option value="' .route("order.update",[$query->id,'delivered']).'" >delivered</option>
               <option value="' .route("order.update",[$query->id,'shipped']).'" >shipped</option>
                </select>';
              }
              if ($query->status == 'unpaid') {
                return '<select name="guard_name" class="form-control text-center" onchange="javascript:handleSelect(this)" style="padding: 0.3rem 0.75rem; border-radius: 50px;">
                 <option value="' .route("order.update",[$query->id,'paid']).'" >paid</option>
                 <option selected value="' .route("order.update",[$query->id,'unpaid']).'" >unpaid</option>
                 <option value="' .route("order.update",[$query->id,'cancel']).'" >cancel</option>
                 <option value="' .route("order.update",[$query->id,'delivered']).'" >delivered</option>
                 <option value="' .route("order.update",[$query->id,'shipped']).'" >shipped</option>
                 </select>';
               }
               if ($query->status == 'cancel') {
                return '<select name="guard_name" class="form-control text-center" onchange="javascript:handleSelect(this)" style="padding: 0.3rem 0.75rem; border-radius: 50px;">
                <option value="' .route("order.update",[$query->id,'paid']).'" >paid</option>
                <option value="' .route("order.update",[$query->id,'unpaid']).'" >unpaid</option>
                <option selected value="' .route("order.update",[$query->id,'cancel']).'" >cancel</option>
                <option value="' .route("order.update",[$query->id,'delivered']).'" >delivered</option>
                <option value="' .route("order.update",[$query->id,'shipped']).'" >shipped</option>
                 </select>';
               }
               if ($query->status == 'delivered') {
                return '<select name="guard_name" class="form-control text-center" onchange="javascript:handleSelect(this)" style="padding: 0.3rem 0.75rem; border-radius: 50px;">
                <option value="' .route("order.update",[$query->id,'paid']).'" >paid</option>
                <option value="' .route("order.update",[$query->id,'unpaid']).'" >unpaid</option>
                <option value="' .route("order.update",[$query->id,'cancel']).'" >cancel</option>
                <option selected value="' .route("order.update",[$query->id,'delivered']).'" >delivered</option>
                <option value="' .route("order.update",[$query->id,'shipped']).'" >shipped</option>
                 </select>';
               }
               if ($query->status == 'shipped') {
                return '<select name="guard_name" class="form-control text-center" onchange="javascript:handleSelect(this)" style="padding: 0.3rem 0.75rem; border-radius: 50px;">
                <option value="' .route("order.update",[$query->id,'paid']).'" >paid</option>
                <option value="' .route("order.update",[$query->id,'unpaid']).'" >unpaid</option>
                <option value="' .route("order.update",[$query->id,'cancel']).'" >cancel</option>
                <option value="' .route("order.update",[$query->id,'delivered']).'" >delivered</option>
                <option selected value="' .route("order.update",[$query->id,'shipped']).'" >shipped</option>
                 </select>';
               }
            })->escapeColumns('action')
            ->editColumn('created_at' ,function($query) {
                return Carbon::parse($query->created_at)->diffForHumans();
            })->escapeColumns('created_at')
            ->editColumn('payment_url' ,function($query) {
                return '<a href="'.$query->payment_url.'" target="_blank" class="btn btn-primary">Invoice</a>';
            })->escapeColumns('payment_url')
            ->editColumn('Price' ,function($query) {
                return '<span target="_blank" class="btn btn-light">$'.$query['data']['purchases']['Total'].'</span>';
            })->escapeColumns('Price')
            ->editColumn('view' ,function($query) {
                return  '<a href="' . route("Order.show", $query->id) . '" class="btn btn-info " title="show details" ><i class="fas fa-eye fa-lg"></i></a>';
            })->escapeColumns('view')
            ->editColumn('status' ,function($query) {
                if ($query->status == 'paid') {
                    return '<span class="badge badge-pill badge-primary">Paid</span>';
                }elseif($query->status == 'unpaid') {
                    return '<span class="badge badge-pill badge-dark">Unpaid</span>';
                }
                elseif($query->status == 'cancel') {
                    return '<span class="badge badge-pill badge-danger">Canceled</span>';
                }
                elseif($query->status == 'delivered') {
                    return '<span class="badge badge-pill badge-success">Delivered</span>';
                }
                elseif($query->status == 'shipped') {
                    return '<span class="badge badge-pill badge-warning">Shipped</span>';
                }
            })->escapeColumns('status');
            
    }       

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Users\Orders $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Orders $model)
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
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reload'),
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
            Column::make('order_number')->addClass('text-center')->searchable(true),
            Column::computed('Price')->addClass('text-center')->searchable(false),
            Column::computed('payment_url')->addClass('text-center')->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::computed('status')->addClass('text-center')->searchable(false),
            Column::computed('view')->addClass('text-center')->searchable(false),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->searchable(false)
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
        return 'OrdersDatatables_' . date('YmdHis');
    }
}
