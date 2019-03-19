<?php

namespace App\DataTables;

use App\Contract;
use App\Employee;
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
        ->addColumn('division', function ($employee) {
            return $employee->position->division->name;
        })
        ->addColumn('department', function ($employee) {
            return ($employee->position->department ? $employee->position->department->name : "-");
        })
        ->addColumn('section', function ($employee) {
            return ($employee->position->section ? $employee->position->section->name : "-");
        })
        ->addColumn('position', function($employee){
            return $employee->position->name;
        })
        ->addColumn('action', function ($employee) {
            $edit = '<a href="employee/'.$employee->id.'/edit" class="btn btn-xs btn-default"><i class="fa fa-search"></i> View</a>';
            $edit_detail_employee = '<a href="employee/'.$employee->id.'/detailemployee" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit By Employee</a>';
            $edit_detail_hr = '<a href="employee/'.$employee->id.'/detail" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit By HR</a>';
            $btn_group = '<div class="btn-group">'.$edit_detail_employee.$edit_detail_hr.'</div>';
            $button = $edit.$btn_group;
            return $button;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return $model->newQuery()
        ->whereNotIn('employee_status', ['Draft','Cancel'])
        ->whereNotIn('status_active', ['Draft','Cancel'])
        ->select('employees.id', 
        'employees.nik', 
        'nama', 
        'employee_status', 
        'status_active', 
        'jenis_kelamin',
        'position_id',
        'employees.created_at', 
        'employees.updated_at')
        ->join('positions','employees.position_id', '=', 'positions.id')
        ->leftJoin('sections', 'positions.section_id', '=', 'sections.id')
        ->leftJoin('departments', 'positions.department_id', '=', 'departments.id')
        ->join('divisions', 'positions.division_id', '=', 'divisions.id');
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
            'nama',
            // 'contract_date',
            // 'contract_number',
            // 'contract_type',
            // // 'contract_duration',
            'employee_status',
            'status_active',
            // // 'status_contract',
            [
                'data' => 'division',
                'name' => 'divisions.name',
                'title' => 'Division',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'department',
                'name' => 'departments.name',
                'title' => 'Department',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'section',
                'name' => 'sections.name',
                'title' => 'Section',
                'searchable' => true,
                'orderable' => false,
            ],
            [
                'data' => 'position',
                'name' => 'positions.name',
                'title' => 'Position',
                'searchable' => true,
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
