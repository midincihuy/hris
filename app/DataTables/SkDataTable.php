<?php

namespace App\DataTables;

use App\Sk;
use Yajra\DataTables\Services\DataTable;

class SkDataTable extends DataTable
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
            ->editColumn('start_date', function($sk){
                return $sk->start_date->formatLocalized('%d %B %Y');
            })
            ->editColumn('end_date', function($sk){
                return $sk->end_date->formatLocalized('%d %B %Y');
            })
            ->addColumn('action', function($sk){
                $print = '<a href="'.route('admin.do_print', ['sk', $sk->id]).'" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i> Print</a>';
                return $print;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sk $model)
    {
        setLocale(LC_TIME, 'id_ID.utf8');
        return $model->newQuery()->select('id', 
        'no_surat', 
        'jenis_surat', 
        'ref_no', 
        'start_date', 
        'end_date', 
        'created_at', 
        'updated_at');
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
            'no_surat',
            'jenis_surat', 
            'ref_no', 
            'start_date', 
            'end_date', 
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
        return 'Sk_' . date('YmdHis');
    }

    protected function getBuilderParameters()
    {
      return [
        'dom'          => 'Blrtip',
        'buttons'      => ['excel', 'reset', 'reload'],
        'pageLength'   => 10,
        'order'         => [
            3, 'desc'
        ],
        'scrollX'       => 'true',
        'initComplete' => 'function () {
            $("#dataTableBuilder").attr("style","margin-left:0px;width:auto");
            $("#dataTableBuilder_paginate").attr("style","float:left;");
        }',
        'rowCallback'  => 'function( row, data, index ) {
            
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
