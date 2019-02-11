<?php

namespace App\DataTables;

use App\Family;
use Yajra\DataTables\Services\DataTable;

class FamilyDataTable extends DataTable
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
        ->addColumn('action', function ($family) {
            $edit = '<a href="family/'.$family->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $button = $edit;
            return $button;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Family $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Family $model)
    {
        return $model->newQuery()
        ->where('employee_id', $this->employee_id)
        ->select('id', 
        'relation',
        'nik',
        'name',
        'gender',
        'place_of_birth',
        'date_of_birth',
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
            'relation',
            'nik',
            'name',
            'gender',
            'place_of_birth',
            'date_of_birth',
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
        return 'Family_' . date('YmdHis');
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
