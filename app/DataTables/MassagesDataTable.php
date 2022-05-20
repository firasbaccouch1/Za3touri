<?php

namespace App\DataTables;

use App\Models\Users\Message;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MassagesDataTable extends DataTable
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
                return '<form action="'. route("Massages.delete",$query->id) .'" method="POST"">
                <input name="_token" type="hidden" value="'. csrf_token() .'">
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-danger" id="delete" title="delete" >
                <i class="fas fa-trash fa-lg"></i></button>
                </form>'; 
            })
            ->rawColumns(['action'])
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->diffForHumans();
            })->escapeColumns('updated_at');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Users\Message $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Message $model)
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
                    ->setTableId('massages-table')
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
            Column::make('name')->class('text-center')->searchable(true),
            Column::make('email')->class('text-center'),
            Column::make('subject')->class('text-center'),
            Column::make('message')->class('text-center'),
            Column::make('updated_at')->class('text-center'),
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
        return 'Massages_' . date('YmdHis');
    }
}
