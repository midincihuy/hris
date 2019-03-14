<?php

namespace App\DataTables;

use App\Contract;
use Yajra\DataTables\Services\DataTable;

class EmployeeContractDataTable extends DataTable
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
            ->editColumn('contract_date', function($contract){
                return $contract->contract_date->formatLocalized('%d %B %Y');
            })
            ->editColumn('contract_expire_date', function($contract){
                return $contract->contract_expire_date->formatLocalized('%d %B %Y');
            })
            ->addColumn('action', function($contract){
                $print = '<a href="'.route('admin.do_print', ['contract', $contract->id]).'" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i> Print</a>';
                return $print;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Contract $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contract $model)
    {
        setLocale(LC_TIME, 'id_ID.utf8');
        return $model->newQuery()
        ->where('employee_id', $this->employee_id)->
        select('id', 
        'contract_number', 
        'contract_date', 
        'contract_expire_date', 
        'contract_reference_no', 
        'created_at', 
        'updated_at')
        ->orderBy('id');
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
            'contract_number',
            'contract_date', 
            'contract_expire_date', 
            'contract_reference_no', 
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
        return 'EmployeeContract_' . date('YmdHis');
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
                $(input).attr("style","width:auto");
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
