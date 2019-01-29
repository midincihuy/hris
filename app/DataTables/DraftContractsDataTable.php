<?php

namespace App\DataTables;

use App\Contract;
use Yajra\DataTables\Services\DataTable;

class DraftContractsDataTable extends DataTable
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

                $edit = '<a href="draft_contracts/'.$contracts->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Assign NIK</a>';
                $button = $edit;
                return $button;
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
        return $model->newQuery()
        ->where('employee_status', 'Draft')
        ->where('status_active', 'Draft')
        ->select('id',
        'nik',
        'name',
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
            'id',
            'nik',
            'name',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DraftContracts_' . date('YmdHis');
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
            // $("#dataTableBuilder tbody").on("click", "tr", function () {
            //     var id = this.id;
            //     var index = $.inArray(id, selected);
  
            //     if ( index === -1 ) {
            //         selected.push( id );
            //     } else {
            //         selected.splice( index, 1 );
            //     }
            //     $("#hide_nik").val(selected.toString());
            //     $("#total_nik").text(selected.length);
            //     $(this).toggleClass("selected");
            // });
        }',
        'rowCallback'  => 'function( row, data, index ) {
            // $(row).attr("id", data.nik);
            // if ( $.inArray(data.nik, selected) !== -1 ) {
            //     $(row).addClass("selected");
            // }
            
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
