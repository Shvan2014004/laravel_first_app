<?php

namespace App\DataTables;

use App\Models\Income;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;



class IncomeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->order(function($query){
               $query->orderBy('created_at', 'desc');
        })->addIndexColumn()
        ->addColumn('action', function ($income) {      
      $btn = "<a href='javascript:void(0);' data-toggle='modal' 
            data-id=''.$income->id.'' data-original-title='Edit' 
            id='edit-income' data-target='#editincomeModal'
              class='btn btn-primary edit-income pr-4'>
             <span class='fa fa-pencil'></span></a>";
           $btn .= '<a href="javascript:void(0);" id="view-income" 
           data-toggle="modal" data-original-title="View"
 data-target="#viewincomeModal"
            data-id="'.$income->id.'" class="btn btn-info bolded">
           <i class="fa fa-eye" ></i></a>';
            $btn .= '<a href="javascript:void(0);" id="delete-income" 
            data-toggle="modal" data-original-title="Delete" 
data-target="#deleteincomeModal"
             data-id="'.$income->id.'" class="btn btn-danger pr-4"">
            <span class="fa fa-trash" ></span></a>';
           return $btn;
        })->addColumn('checkbox', function ($income) {
              $checkBox = '<input type="checkbox" id="'.$income->id.'"/>';
             return $checkBox;
        })->rawColumns(['action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\income $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Income $model)
    {
        return $model->newQuery()->select('*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Incomedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('date'),
            Column::make('description'),
            Column::make('amount'),
            Column::make('type'),
            Column::make('created_at'),
            Column::make('updated_at'),
                
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
   
    protected function filename(): string {
        return 'Income_' . date('YmdHis');
    }
}