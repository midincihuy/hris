<?php

namespace App\DataTables;

use App\Applicant;
use Yajra\DataTables\Services\DataTable;

class ApplicantsDataTable extends DataTable
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
        ->addColumn('action', function ($applicants) {
            $button = '<a href="applicants/'.$applicants->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i> View</a>';

            $recuited = $applicants->recruitment ? "Recruited" : "Not Recruited";
            $btn_recuited = $applicants->recruitment ? "success" : "warning";
            return $button."<br/><span class='alert-$btn_recuited'>".$recuited."</span>";
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Applicant $model)
    {
        return $model->newQuery()
        ->select('id', 
            'id_pelamar',
            'posisi_yang_dilamar',
            'nama',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'kewarganegaraan',
            'no_ktp',
            'alamat_ktp',
            'rt',
            'rw',
            'kelurahan',
            'kecamatan',
            'kota',
            'kode_pos',
            'telephone_rumah',
            'handphone',
            'skype_id',
            'agama',
            'golongan_darah',
            'pendidikan_terakhir',
            'institusi_pendidikan',
            'jurusan',
            'tahun_masuk',
            'tahun_keluar',
            'informasi_lowongan',
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
            // 'id_pelamar',
            'posisi_yang_dilamar',
            'nama',
            'jenis_kelamin',
            // 'tempat_lahir',
            // 'tanggal_lahir',
            // 'kewarganegaraan',
            // 'no_ktp',
            // 'alamat_ktp',
            // 'rt',
            // 'rw',
            // 'kelurahan',
            // 'kecamatan',
            // 'kota',
            // 'kode_pos',
            // 'telephone_rumah',
            'handphone',
            // 'skype_id',
            // 'agama',
            // 'golongan_darah',
            'pendidikan_terakhir',
            'institusi_pendidikan',
            'jurusan',
            // 'tahun_masuk',
            // 'tahun_keluar',
            // 'informasi_lowongan',
            // 'created_at',
            // 'updated_at'
        ];
    }

    protected $exportColumns = [
            // 'id',
            'id_pelamar',
            'posisi_yang_dilamar',
            'nama',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'kewarganegaraan',
            'no_ktp',
            'alamat_ktp',
            'rt',
            'rw',
            'kelurahan',
            'kecamatan',
            'kota',
            'kode_pos',
            'telephone_rumah',
            'handphone',
            'skype_id',
            'agama',
            'golongan_darah',
            'pendidikan_terakhir',
            'institusi_pendidikan',
            'jurusan',
            'tahun_masuk',
            'tahun_keluar',
            'informasi_lowongan',
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
        return 'Applicants_' . date('YmdHis');
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
