<?php

namespace App\DataTables;

use App\Models\Admin\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class AdminDataTable extends DataTable
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
         if (!$query->getRoleNames()->contains('owner')) {
            return             '<form action="'. route("Admins.destroy",$query->id) .'" method="POST"">
            <input name="_token" type="hidden" value="'. csrf_token() .'">
            <input name="_method" type="hidden" value="DELETE">
            <a href="' . route("Admins.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> 
            <button type="submit" class="btn btn-danger" id="delete" title="delete" >
            <i class="fas fa-trash fa-lg"></i></button>
            
            </form>';
         }else{
            '<a href="' . route("Admins.edit", $query->id) . '" class="btn btn-info " title="edit" ><i class="fas fa-edit fa-lg" style=" color: rgba(40, 91, 185, 0.726) !important;"></i></a> ';
         }
        })
        ->rawColumns(['action'])
        ->editColumn('photo', function($query) {
            return  '<img style="width: 100px;height:60px;" src="'.asset($query->photo).'">';
        })->escapeColumns('photo')
        ->editColumn('role', function($query) {
            if ($query->getRoleNames()->contains('owner')) {
                return  '<span  class="badge badge-pill badge-warning"  >Owner</span>' ;
            }else{
                return  '<span  class="badge badge-pill badge-primary"  >'.  $query->getRoleNames() .'</span>' ;
            }
        })->escapeColumns('role')
        ->editColumn('email', function($query) {
            if (auth()->user()->getRoleNames()->contains('owner')) {
              return $query->email;
            }else{
                if(auth()->user()->email == $query->email){
                return $query->email;
                }else{
                return Str::mask($query->email,'*',0);
                }
            }
        })->escapeColumns('email');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
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
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reload'),
                        Button::make('create')->action("window.location = '".route('Admins.create')."';")->addClass('btn btn-success'),
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
            Column::make('name')->searchable(true),
            Column::make('email')->searchable(false),
            Column::computed('role')
            ->addClass('text-center')
            ->searchable(false),
            Column::make('updated_at')->searchable(false),
            Column::computed('action')
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
        return 'Admin_' . date('YmdHis');
    }
}
