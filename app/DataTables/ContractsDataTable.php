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
        ->addColumn('division', function ($employee) {
            return $employee->position->division->name;
        })
        ->addColumn('department', function ($employee) {
            return ($employee->position->department ? $employee->position->department->name : "-");
        })
        ->addColumn('section', function ($employee) {
            return ($employee->position->section ? $employee->position->section->name : "-");
        })
        ->addColumn('position', function($contracts){
            return $contracts->position->name;
        })
        ->editColumn('contract_date', function($contracts){
            return $contracts->contract_date->formatLocalized('%d %B %Y');
        })
        ->editColumn('contract_expire_date', function($contracts){
            return $contracts->contract_expire_date->formatLocalized('%d %B %Y');
        })
        ->addColumn('action', function ($contracts) {
            $edit = '<a href="contracts/'.$contracts->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';

            $print = "";
            if($contracts->employee){
                $edit .= ' <a href="contracts/'.$contracts->id.'/renew" class="btn btn-xs btn-warning"><i class="fa fa-refresh"></i> Renew</a>';
                $print = ' <a href="draft_contracts/'.$contracts->id.'/print" class="btn btn-xs btn-success" target="_blank"><i class="glyphicon glyphicon-print"></i> Print</a>';
            }else{
                $edit = "<span class='alert-danger'>Contract Has been Renewed</span>";
            }

            $button = '<div class="btn-group">'.$edit.'</div>';
            $button .= $print;
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
        setLocale(LC_TIME, 'id_ID.utf8');
        return $model->newQuery()
        ->where('employee_status', 'KK')
        ->where('status_active', 'Aktif')
        ->whereDate('contract_date', '<=', date("Y-m-d"))
        ->whereDate('contract_expire_date', '>', date("Y-m-d"))
        ->select('contracts.id', 
        'nik', 
        'contracts.name', 
        'contract_number', 
        'gender',
        'contract_date', 
        'contract_expire_date', 
        'contract_duration', 
        'employee_status',
        'status_active', 
        'status_contract',
        'position_id', 
        'employee_id', 
        'reminder', 
        'contracts.created_at', 
        'contracts.updated_at')
        ->join('positions','contracts.position_id', '=', 'positions.id')
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
            'name',
            'contract_number', 
            'contract_date',
            'contract_expire_date',
            // 'contract_duration',
            'employee_status',
            'status_active',
            'status_contract',
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
