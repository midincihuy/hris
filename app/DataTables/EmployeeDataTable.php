<?php

namespace App\DataTables;

use App\Contract;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
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
        ->addColumn('action', function ($contracts) {
            return '<a href="employee/'.$contracts->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contract $model)
    {
        return $model->newQuery()->select('id', 'nik', 'name', 'gender',
        'contract_date', 'contract_duration', 'employee_status',
        'status_active', 'status_contract', 'division', 'department',
        'position', 'reminder', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'id',
            'nik',
            'name',
            'contract_date',
            // 'contract_duration',
            'employee_status',
            'status_active',
            // 'status_contract',
            // 'division',
            'department',
            'position',
            // 'reminder',
            // 'created_at',
            // 'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Employee_' . date('YmdHis');
    }

    protected function getBuilderParameters()
    {
      return [
        'dom'          => 'Blfrtip',
        'buttons'      => ['excel', 'reset', 'reload'],
        'pageLength'   => 10,
        'rowCallback'  => "function( row, data, index ) {
            $(row).attr('id', data.nik);
            if ( $.inArray(data.nik, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        }",
        'drawCallback' => "function() {
          $('#dataTableBuilder tbody').on('click', 'tr', function () {
              var id = this.id;
              var index = $.inArray(id, selected);

              if ( index === -1 ) {
                  selected.push( id );
              } else {
                  selected.splice( index, 1 );
              }
              $('#hide_nik').val(selected.toString());
              $('#total_nik').text(selected.length);
              $(this).toggleClass('selected');
          });
        }",
      ];
    }
}
