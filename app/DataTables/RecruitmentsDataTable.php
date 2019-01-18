<?php

namespace App\DataTables;

use App\Recruitment;
use Yajra\DataTables\Services\DataTable;

class RecruitmentsDataTable extends DataTable
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
        ->addColumn('action', function ($recruitments) {
            $view_recruitment_btn = '<a href="recruitments/'.$recruitments->id.'" class="btn btn-xs btn-primary"><i class="fa fa-search"></i> View</a>';
            $edit_recruitment_btn = '<a href="recruitments/'.$recruitments->id.'/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
            $create_contract_btn = $recruitments->status_offering == "Disarankan" ? '<a href="recruitments/'.$recruitments->id.'/create_contract" class="btn btn-xs btn-warning"><i class="fa fa-file"></i> Create Contract</a>' : '';
            return $view_recruitment_btn." ".$edit_recruitment_btn." ".$create_contract_btn;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recruitment $model)
    {
        return $model->newQuery()
        ->select('id', 
        'no_ptk',
        'tanggal_ptk',
        'jenis_ptk',
        'tanggal_interview_hr',
        'status_interview_hr',
        'tanggal_test_bidang',
        'status_test_bidang',
        'tanggal_psikotest',
        'ist',
        'pauli',
        'hasil_psikotest',
        'tanggal_interview_user',
        'status_interview_user',
        'tanggal_offering',
        'status_offering',
        'jabatan_final',
        'created_by',
        'updated_by',
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
            'no_ptk',
            'tanggal_ptk',
            'jenis_ptk',
            'tanggal_interview_hr',
            'status_interview_hr',
            'tanggal_test_bidang',
            'status_test_bidang',
            'tanggal_psikotest',
            'ist',
            'pauli',
            'hasil_psikotest',
            'tanggal_interview_user',
            'status_interview_user',
            'tanggal_offering',
            'status_offering',
            'jabatan_final',
            'created_by',
            'updated_by',
            // 'created_at',
            // 'updated_at'
        ];
    }

    protected $exportColumns = [
            // 'id',
            'no_ptk',
            'tanggal_ptk',
            'jenis_ptk',
            'tanggal_interview_hr',
            'status_interview_hr',
            'tanggal_test_bidang',
            'status_test_bidang',
            'tanggal_psikotest',
            'ist',
            'pauli',
            'hasil_psikotest',
            'tanggal_interview_user',
            'status_interview_user',
            'tanggal_offering',
            'status_offering',
            'jabatan_final',
            'created_by',
            'updated_by',
            // 'created_at',
            // 'updated_at'
        ];

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Recruitments_' . date('YmdHis');
    }

    protected function getBuilderParameters()
    {
      return [
        'dom'          => 'Blrtip',
        'buttons'      => ['create', 'excel', 'reset', 'reload'],
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
