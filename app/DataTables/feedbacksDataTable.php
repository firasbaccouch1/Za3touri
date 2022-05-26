<?php

namespace App\DataTables;

use App\Models\Users\Feedback;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class feedbacksDataTable extends DataTable
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
                return '<form action="'. route("feedback.delete",$query->id) .'" method="POST"">
            
                <input name="_token" type="hidden" value="'. csrf_token() .'">
                <input name="_method" type="hidden" value="DELETE">
                <a href="' . route("Feedback.active", $query->id) . '" class="btn btn-warning " title="active/inactive" >
                <i class="fas fa-cogs fa-lg" style=" color: black !important;">
                </i></a> 
                <button type="submit" class="btn btn-danger" id="delete" title="delete" >
                <i class="fas fa-trash fa-lg"></i></button>
                
                </form>'; 
            })
            ->rawColumns(['action'])
            ->editColumn('name', function($query) {
                return $query->user->first_name .' '.$query->user->last_name;
            })->escapeColumns('name')
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->diffForHumans();
            })->escapeColumns('status')
            ->editColumn('status', function($query) {
                if ($query->status == 1 ) {
                    return '<span class="badge badge-pill badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-pill badge-danger">inActive</span>';
                }
           
            })->escapeColumns('status');
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Users\feedback $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Feedback $model)
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('feedbacks-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reset'),
                        Button::make('pageLength')->className('showrows'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('name')->addClass('text-center'),
            Column::make('message')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('updated_at')->addClass('text-center'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
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
        return 'feedbacks_' . date('YmdHis');
    }
}
