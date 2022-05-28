<?php

namespace App\DataTables;

use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class UsersDataTable extends DataTable
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
            ->editColumn('name', function($query) {
                    return $query->first_name .' '. $query->last_name;
            })->escapeColumns('name')
            ->editColumn('updated_at', function($query) {
                return $query->updated_at->diffForHumans();
            })->escapeColumns('updated_at')
            ->editColumn('status', function($query) {
                if($query->banned != null){
                      return '<span class="badge badge-pill badge-warning">Banned By('.$query->banned->banned_by.')</span>';
                }else{
                    return '<span class="badge badge-pill badge-success">Active</span>';
                }
            })->escapeColumns('status')
            ->editColumn('email', function($query) {
                if (Auth::guard('admin')->user()->hasPermissionTo('admin')) {
                  return $query->email;
                }else{
                    return Str::mask($query->email,'*',0);
                }
            })->escapeColumns('email')
            ->editColumn('ban-User', function($query) {
                if($query->banned == null )
                return '<a title="ban user" href="'.route('Ban-User',$query->ip_address).'"><span class="btn btn-danger" ><i class="fas fa-user-alt-slash"></i></span></a>';
                else{
                    return '<a title="unban user" href="'.route('unBan-User',$query->ip_address).'"><span class="btn btn-success" ><i class="fas fa-user-check"></i></span></a>';
                }
            })->escapeColumns('ban-User');
        
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Users\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->with('banned');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('reload'),
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
            
            Column::computed('name')->class('text-center'),
            Column::computed('email')->class('text-center'),
            Column::computed('status')->class('text-center'),
            Column::make('updated_at')->class('text-center'),
            Column::computed('ban-User')->class('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
