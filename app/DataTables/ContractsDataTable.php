<?php

namespace App\DataTables;

use App\Contract;
use Yajra\DataTables\Services\DataTable;

class ContractsDataTable extends DataTable
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
            $edit = '<a href="contracts/'.$contracts->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $renew = ' <a href="contracts/'.$contracts->id.'/renew" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-new"></i> Renew</a>';
            $print = ' <a href="draft_contracts/'.$contracts->id.'/print" class="btn btn-xs btn-success" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a>';
            $button = $edit.$renew.$print;
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
        return $model->newQuery()
        ->where('employee_status', 'KK')
        ->where('status_active', 'Aktif')
        ->select('contracts.id', 
        'nik', 
        'contracts.name', 
        'contract_number', 
        'gender',
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
            'contract_number', 
            'contract_date',
            // 'contract_duration',
            'employee_status',
            'status_active',
            // 'status_contract',
            // 'division',
            'department',
            [
                'data' => 'position',
                'title' => 'position',
                'searchable' => false,
                'orderable' => false,
            ],
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
        return 'Contracts_' . date('YmdHis');
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
        }',
        'rowCallback' => 'function () {
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
