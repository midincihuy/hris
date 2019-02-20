<?php

namespace App\DataTables;

use App\Section;
use Yajra\DataTables\Services\DataTable;

class SectionsDataTable extends DataTable
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
            ->addColumn('division', function ($section) {
                return $section->department->division->name;
            })
            ->addColumn('department', function ($section) {
                return $section->department->name;
            })
            ->addColumn('action', 'sectionsdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Section $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Section $model)
    {
        return $model->newQuery()->select('id', 'name', 'department_id', 'created_at', 'updated_at');
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
            'name',
            [
                'data' => 'division',
                'title' => 'Division',
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'data' => 'department',
                'title' => 'Department',
                'searchable' => false,
                'orderable' => false,
            ],
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
        return 'Sections_' . date('YmdHis');
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
