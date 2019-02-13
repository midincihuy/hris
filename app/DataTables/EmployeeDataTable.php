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
            $edit = '<a href="employee/'.$contracts->id.'/edit" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>';
            $edit_detail_employee = '<a href="employee/'.$contracts->id.'/detailemployee" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit By Employee</a>';
            $edit_detail_hr = '<a href="employee/'.$contracts->id.'/detail" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit By HR</a>';
            $button = $edit.$edit_detail_employee.$edit_detail_hr;
            return $button;
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
        return $model->newQuery()->select('contracts.id', 'nik', 'contracts.name', 'gender',
        'contract_date', 'contract_duration', 'employee_status',
        'status_active', 'status_contract', 'division', 'department',
        'positions.name as position', 'reminder', 'contracts.created_at', 'contracts.updated_at')
        ->leftJoin('positions', 'position', '=', 'positions.id');
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
        'dom'          => 'Blrtip',
        'buttons'      => ['excel', 'reset', 'reload'],
        'pageLength'   => 10,
        'scrollX'       => 'true',
        'initComplete' => 'function () {
            $("#dataTableBuilder").attr("style","margin-left:0px;width:auto");
            $("#dataTableBuilder_paginate").attr("style","float:left;");

            // to select from list
            $("#dataTableBuilder tbody").on("click", "tr", function () {
                var id = this.id;
                var index = $.inArray(id, selected);
  
                if ( index === -1 ) {
                    selected.push( id );
                } else {
                    selected.splice( index, 1 );
                }
                $("#hide_nik").val(selected.toString());
                $("#total_nik").text(selected.length);
                $(this).toggleClass("selected");
            });
        }',
        'rowCallback'  => 'function( row, data, index ) {
            $(row).attr("id", data.nik);
            if ( $.inArray(data.nik, selected) !== -1 ) {
                $(row).addClass("selected");
            }
            
            var r = $("#dataTableBuilder_wrapper tfoot tr");

            $("#dataTableBuilder_wrapper thead").append(r);
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).attr("style","width:100px");
                $(input).appendTo($(column.footer()).empty())
                .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : "", true, false).draw();
                });
            });
        }',
      ];
    }
}
