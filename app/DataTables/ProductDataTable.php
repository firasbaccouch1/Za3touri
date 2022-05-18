<?php

namespace App\DataTables;

use App\Models\Admin\Product;
use App\Scopes\ProductScope;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            return '<form action="'. route("Product.destroy",$query->id) .'" method="POST"">
            
            <input name="_token" type="hidden" value="'. csrf_token() .'">
            <input name="_method" type="hidden" value="DELETE">
            <a href="' . route("Product.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
            <a href="' . route("Product.active", $query->id) . '" class="btn btn-warning " title="active/inactive" >
            <i class="fas fa-cogs fa-lg" style=" color: black !important;">
            </i></a> 
            <a href="' . route("Product.show", $query->id) . '" class="btn btn-primary " title="show details" ><i class="fas fa-eye fa-lg"></i></a> 
            <button type="submit" class="btn btn-danger" id="delete" title="delete" >
            <i class="fas fa-trash fa-lg"></i></button>
            
            </form>';
         
        })
        ->rawColumns(['action'])
        ->editColumn('photo', function($query) {
            return  '<img  src="'.asset($query->thumbnail).'"style="width: 100px;height: 70px" >' ;
        })->escapeColumns('photo')
        ->editColumn('status', function($query) {
            if ($query->status == 1 ) {
                return '<span class="badge badge-pill badge-success">Active</span>';
            }else{
                return '<span class="badge badge-pill badge-danger">inActive</span>';
            }
       
        })->escapeColumns('status')
        ->editColumn('price', function($query) {
            return  '<span  class="badge badge-pill badge-secondary"  >$'.  $query->price .'</span>' ;
        })->escapeColumns('price')
    ->editColumn('category', function($query) {
        return  '<span    ><i class ="'.  $query->category->icon .' fa-lg"></span>' ;
    })->escapeColumns('category')
    ->editColumn('discount', function($query) {
        if ($query->discount == null) {
            return '<span class="badge badge-pill badge-info">No Discount</span>';
        }else{
            return '<span class="badge badge-pill badge-warning">'.$query->discount->discount.'%</span>';

        }
  
    })->escapeColumns('discount');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->withoutGlobalScope(ProductScope::class)->with('discount','category');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('reload'),
                        Button::make('print'),
                        Button::make('create')->action("window.location = '".route('Product.create')."';")->addClass('btn btn-success'),
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
            ->addClass('text-center')
            ->searchable(false),
            Column::make('name_en')->title('name')->searchable(true),
            Column::make('status')->searchable(false),
            Column::computed('category')->searchable(false),
            Column::make('price')->searchable(false),
            Column::computed('discount')->searchable(false),
            Column::make('updated_at')->searchable(false),
            Column::computed('action')
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
        return 'Product_' . date('YmdHis');
    }
}
