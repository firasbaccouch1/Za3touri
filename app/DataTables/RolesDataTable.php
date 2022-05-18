<?php

namespace App\DataTables;


use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;


class RolesDataTable extends DataTable
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
            return '<form action="'. route("Roles.destroy",$query->id) .'" method="POST"">
            
            <input name="_token" type="hidden" value="'. csrf_token() .'">
            <input name="_method" type="hidden" value="DELETE">
            <a href="' . route("Roles.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
            <button type="submit" class="btn btn-danger" id="delete" title="delete" >
            <i class="fas fa-trash fa-lg"></i></button>
            
            </form>';
         
        })
        ->rawColumns(['action'])
        ->editColumn('permissions', function($query) {

                return  '<span  class="badge badge-pill "  >'.$query->getAllPermissions()->pluck('name').'</span>' ;
            
        })->escapeColumns('permissions')
        ->editColumn('Guard', function($query) {
            return  '<span  class="badge badge-pill badge-danger"  >'.  $query->guard_name .'</span>' ;
        })->escapeColumns('Guard')
        ->editColumn('name', function($query) {
            if ($query -> name =='owner') {
                return  '<span  class="badge badge-pill badge-warning"  >'.  $query->name .'</span>' ;
            }else{
                return  '<span  class="badge badge-pill badge-primary"  >'.  $query->name .'</span>' ;
            }
        })->escapeColumns('name');
        
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reload'),
                        Button::make('create')->action("window.location = '".route('Roles.create')."';")->addClass('btn btn-success'),
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
            Column::computed('name')
      
            ->addClass('text-center')
            ->searchable(),
            Column::computed('Guard')
            
            ->addClass('text-center'),
            Column::computed('permissions')
           
            ->addClass('text-center'),
            Column::make('updated_at'),
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
        return 'Roles_' . date('YmdHis');
    }
}
