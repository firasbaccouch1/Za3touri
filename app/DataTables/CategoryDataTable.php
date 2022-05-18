<?php

namespace App\DataTables;

use App\Models\Admin\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
class CategoryDataTable extends DataTable
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
              
                return '       <form action="'. route("Category.destroy",$query->id ) .'" method="POST"">

                <input name="_token" type="hidden" value="'. csrf_token() .'">
                <input name="_method" type="hidden" value="DELETE">
                <a href="' . route("Category.edit", $query->id) . '" class="btn btn-info " ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
                <a href="' . route("Category.active", $query->id) . '" class="btn btn-warning " title="active/inactive" >
                <i class="fas fa-cogs fa-lg" style=" color: black !important;">
                </i></a> 
                <button type="submit" class="btn btn-danger"   id="delete">
                <i class="fas fa-trash fa-lg"></i></button>
                
                </form>';
             
            })
            ->rawColumns(['action'])
            ->editColumn('icon', function( $query) {
                return  '<i  class="'.$query->icon.'  fa-3x" ></i>' ;
            })->escapeColumns('icon')
            ->editColumn('discount', function( $query) {
                    if ($query->discount == null) {
                        return  '<span class="badge badge-pill badge-warning">No Discount</span>' ;
                    }else{
                        return  '<span class="badge badge-pill badge-info">'.$query->discount->discount.'%</span>' ;
                    }
            })->escapeColumns('discount')
            ->editColumn('active', function( $query) {
                if ($query->active == 1 ) {
                    return '<span class="badge badge-pill badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-pill badge-danger">inActive</span>';
                }
           
            })->escapeColumns('active');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->newQuery()->with('discount');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('reload'),
                        Button::make('print'),
                        Button::make('create')->action("window.location = '".route('Category.create')."';")->addClass('btn btn-success'),
                        Button::make('pageLength')->className('showrows'),
                    )->parameters([
                        'responsive' => true,
                        'autoWidth' =>false,
                        "scrollX" => true,
                            
                        
                        
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
            Column::computed('icon')
            ->exportable(true)
            ->printable(true)
            ->width(200)
            ->addClass('text-center')
            ->searchable(false),
            Column::make('name_en')->width(100)->searchable(true),
            Column::computed('discount')->width(50)->addClass('text-center')->searchable(false),
            Column::make('active')->width(50)->searchable(false), 
            Column::make('updated_at')->width(50)->searchable(false),
            Column::computed('action')
            ->width('30%')
            ->addClass('text-center')
            ->exportable(false)
            ->printable(false)
            ->searchable(false) ,
            
   
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
