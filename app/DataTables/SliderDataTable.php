<?php

namespace App\DataTables;

use App\Models\Admin\Category;
use App\Models\Admin\Slider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
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
                return '<form action="'. route("Slider.destroy",$query->id) .'" method="POST"" >
                
                <input name="_token" type="hidden" value="'. csrf_token() .'">
                <input name="_method" type="hidden" value="DELETE">
                <a href="' . route("Slider.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
                <a href="' . route("Slider.active", $query->id) . '" class="btn btn-warning " title="active/inactive" >
                <i class="fas fa-cogs fa-lg" style=" color: black !important;">
                </i></a> 
                <button type="submit" class="btn btn-danger" id="delete" title="delete" >
                <i class="fas fa-trash fa-lg"></i></button>
                
                </form>';
             
            })
            ->rawColumns(['action'])
            ->editColumn('photo', function($query) {
                return  '<img  src="'.asset($query->photo).'"style="width: 150px;height: 80px" >' ;
            })->escapeColumns('photo')
            ->editColumn('active', function($query) {
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
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
    {
        return $model->newQuery()->with('category');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('reload'),
                        Button::make('print'),
                        Button::make('create')->action("window.location = '".route('Slider.create')."';")->addClass('btn btn-success'),
                        Button::make('pageLength')->className('showrows'),
                    )->parameters([
                        'responsive' => true,
                        'autoWidth' => false,
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
            Column::computed('photo')
            ->exportable(true)
            ->printable(true)
            ->width(200)
            ->addClass('text-center')
            ->searchable(false),
            Column::make('title_en')->title('Title')->addClass('text-center')->width(80)->searchable(true), 
            Column::make('category.name_en')->title('Category')->addClass('text-center')->width(80)->searchable(false),
            Column::make('active')->title('Status')->addClass('text-center')->width(30)->searchable(false), 
            Column::make('updated_at')->addClass('text-center')->width(80)->searchable(false),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(250)
            ->addClass('text-center')
            ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Slider_' . date('YmdHis');
    }
}
