<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Contract;
use App\DataTables\DraftContractsDataTable;
use App\Events\Event;
use Auth;
use Illuminate\Support\Facades\Gate;
use PDF;
use Illuminate\Support\Str;


class DraftContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DraftContractsDataTable $dataTable)
    {
        return $dataTable->render('admin.draft_contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('draft_contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        return view('admin.draft_contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('draft_contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        switch($contract->contract_type){
            case "PKWT":
                $employee_status = "KK";
                break;
            case "Probation":
                $employee_status = "KP";
                break;
            case "PKWTT":
                $employee_status = "KT";
                break;
            default:
                break;
        }
        $contract->fill($request->all());
        $contract->fill([
            'employee_status' => $employee_status,
            'status_active' => 'Aktif',
        ]);
  
        $contract->save();

        $employee = $contract->employee;
        $employee->nik = $contract->nik;
        $employee->save();
  
        return redirect()->route('admin.contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected $terbilang = [];
    public function print(Contract $contract)
    {
        $contract_type = Str::slug(Str::studly($contract->contract_type));
        $company = Str::slug(Str::studly($contract->position_role->company));
        setLocale(LC_TIME, 'id_ID.utf8');
        $this->terbilang = [
            '3' => 'tiga',
            '6' => 'enam',
            '12' => 'dua belas',
        ];
        $this->{$company."_".$contract_type}($contract);

        // return $contract;
    }

    public function ptomniintivision_pkwt($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"PERJANJIAN KERJA WAKTU TERTENTU (PKWT)",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y += 5;
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"Nomor: ".$contract->contract_number,0,'C');

        $y += 15;
        PDF::Line($x+19,$y+5,$x+189,$y+5);

        PDF::SetFont('helvetica', '', 10);
        $x += 19;
        $y+=5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Perjanjian Kerja Untuk Waktu Tertentu ini dibuat dan ditandatangani pada hari ini, <b>".$contract->contract_date->formatLocalized('%A')."</b>, tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, oleh dan antara:",0,'L',0,1,'','',true,0,true);

        $y+=15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>1.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>PT. OMNI INTIVISION</b>, suatu perseroan terbatas berkedudukan di Jakarta, SCTV Tower, Jalan Asia Afrika Lot 19, Jakarta 10270,dalam hal ini diwakili oleh <b>Andriane Tjepaka Dewi</b>, yang bertindak dalam jabatannya selaku <b><italic>HRGA Division Head</italic></b> dari dan oleh karenanya sah bertindak untuk dan atas nama serta mewakili kepentingan PT Omni Intivision (untuk selanjutnya disebut <b>\"Pihak Pertama/ Pengusaha\"</b>); dan ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>2.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>".$contract->name."</b>, beralamat di <b>".$contract->employee->alamat_ktp." RT ".$contract->employee->rt." RW ".$contract->employee->rw." Kelurahan ".$contract->employee->kelurahan." Kecamatan ".$contract->employee->kecamatan." ".$contract->employee->kota."</b> No KTP <b>".$contract->employee->no_ktp."</b>, dalam hal ini bertindak untuk dan atas nama diri sendiri (untuk selanjutnya disebut <b>\"Pihak Kedua/ Pekerja\"</b>).",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"<b>Pihak Pertama</b> dan <b>Pihak Kedua</b> untuk selanjutnya secara bersama-sama disebut \"Para Pihak\" dan masing-masing disebut \"Pihak\".",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Para Pihak masing-masing bertindak dalam jabatannya sebagaimana tersebut di atas saling menerangkan terlebih dahulu hal-hal sebagai berikut:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"A.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> adalah suatu perseroan terbatas yang bergerak di bidang penyiaran televisi swasta berjaringan termasuk di dalamnya kelompok usaha <b>Pihak Pertama</b>, yang dalam kegiatan operasionalnya membutuhkan tenaga kerja dengan status sebagai karyawan tidak tetap; dan",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"B.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> menerima <b>Pihak Kedua</b> untuk bekerja pada <b>Pihak Pertama</b> untuk waktu tertentu yang didasarkan atas <b>jangka waktu tertentu</b>. <b>Pihak Kedua</b> telah menerima penjelasan dari <b>Pihak Pertama</b> terhadap jenis dan sifat pekerjaan yang akan dilakukan <b>Pihak Kedua</b> dan <b>Pihak Kedua</b> setuju dan menerima status hubungan kerja dimaksud.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"C.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"Para Pihak sepakat untuk membuat dan menandatangani Perjanjian Kerja Waktu Tertentu yang didasarkan atas <b>jangka waktu tertentu</b> yang dilakukan oleh <b>Pihak Kedua</b> sesuai peraturan perundang-undangan yang berlaku (untuk selanjutnya disebut \"Perjanjian\").",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Berdasarkan hal-hal tersebut di atas Para Pihak telah sepakat untuk mengikatkan diri dalam Perjanjian ini dengan ketentuan-ketentuan dan syarat-syarat sebagai berikut:",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 1",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penempatan dan Pelaksanaan Tugas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini bersedia bekerja di <b>Pihak Pertama</b> untuk ditempatkan pada:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+15, $y);
        PDF::MultiCell(30,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+15, $y+5);
        PDF::MultiCell(30,5,"Department/Divisi",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+45, $y);
        PDF::MultiCell(150,5,": ".$contract->position_role->name,0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+45, $y+5);
        PDF::MultiCell(150,5,": ".$contract->position_role->department->name."/".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam melaksanakan pekerjaannya, <b>Pihak Kedua</b> wajib melapor dan bertanggung jawab kepada <b>".$contract->position_role->parent->name."</b> sebagai atasan dari <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Ruang lingkup tugas dan tanggung jawab <b>Pihak Kedua</b> meliputi tetapi tidak terbatas pada yang tercantum dalam Lampiran Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 2
        PDF::AddPage();

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 2",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Jangka Waktu Perjanjian",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Perjanjian ini dibuat untuk jangka waktu <b>".$contract->contract_duration." (".$this->terbilang[$contract->contract_duration].") bulan</b> terhitung sejak tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, sampai dengan tanggal <b>".$contract->contract_expire_date->formatLocalized('%d %B %Y')."</b> dan dapat diperpanjang dengan pemberitahuan secara tertulis oleh <b>Pihak Pertama</b> kepada <b>Pihak Kedua</b> dalam waktu 7 (tujuh) hari sebelum jangka waktu Perjanjian ini berakhir.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila jangka waktu yang diperjanjikan berakhir, hubungan kerja antara <b>Pihak Pertama</b> dengan <b>Pihak Kedua</b> putus demi hukum dan tanpa adanya ikatan bagi <b>Pihak Pertama</b> untuk memberi uang pesangon dan atau pemberian lain kepada <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Perjanjian <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> masing-masing pada setiap saat dan dengan alasan apapun berhak memutuskan hubungan kerja. Apabila <b>Pihak Kedua</b> berkeinginan untuk memutuskan hubungan kerja sebelum masa perjanjian berakhir maka <b>Pihak Kedua</b> wajib memberikan pemberitahuan tertulis kepada <b>Pihak Pertama</b> minimal 30 hari sebelum tanggal efektif pengakhiran hubungan kerja. Ketentuan ini tidak berlaku dalam hal terjadi pelanggaran berat dan atau pelanggaran pidana oleh salah satu pihak.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Perjanjian akan dievaluasi atas hasil kerja <b>Pihak Kedua</b>. Apabila evaluasi tersebut dinilai memuaskan oleh <b>Pihak Pertama</b> maka <b>Pihak Kedua</b> akan ditetapkan oleh <b>Pihak Pertama</b> sebagai karyawan tetap dengan suatu Surat Pengangkatan yang ditetapkan oleh <b>Pihak Pertama</b>. Atau <b>Pihak Pertama</b> dapat memperpanjang kembali masa Perjanjian <b>Pihak Kedua</b> karena <b>Pihak Pertama</b> masih memerlukan waktu untuk melihat kinerja <b>Pihak Kedua</b> dan <b>Pihak Pertama</b> memberikan kesempatan kepada <b>Pihak Kedua</b> untuk melakukan peningkatan dan perbaikan kinerja <b>Pihak Kedua</b> selama waktu yang disetujui bersama.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 3",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Waktu Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> wajib hadir untuk melaksanakan tugas pekerjaan setuap saat, tanpa alasan apapun, kecuali atas persetujuan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Jam kerja <b>Pihak Kedua</b> akan disesuaikan dengan kebutuhan kerja, situasi, kondisi operasional, dan jadwal kerja yang diatur oleh <b>Pihak Pertama</b>, dengan ketentuan kehadiran dalam 1 (satu) minggu tidak kurang 40 (empat puluh) jam kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> berhak melakukan pengaturan jam kerja <b>Pihak Kedua</b> sesuai dengan kebutuhan kerja, situasi, kondisi operasional kerja termasuk shift kerja.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 4",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Upah dan Fasilitas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> akan memberikan upah kepada <b>Pihak Kedua</b> setiap bulan seperti yang tercantum dalam lampiran Perjanjian ini, dan dibayarkan sesuai dengan jadwal yang ditetapkan oleh <b>Pihak Pertama</b>. <b>Pihak Pertama</b> akan menanggung pajak penghasilan dari upah yang diterima <b>Pihak Kedua</b> sesuai dengan ketentuan perundangan yang berlaku apabila <b>Pihak Kedua</b> mempunyai NPWP.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> diikutsertakan dalam program BPJS Ketenagakerjaan dan BPJS Kesehatan sesuai ketentuan perundangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan mendapatkan manfaat kesehatan setelah masa kerjanya lebih dari 3 (tiga) bulan, sesuai dengan ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 3
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam hal <b>Pihak Kedua</b> ditugaskan melakukan perjalanan ke luar kota atau luar negri oleh <b>Pihak Pertama</b>, maka ketentuan mengenai biaya atau kompensasi terkait dengan pekerjaan ke luar kota atau luar negri tersebut mengikuti dan tunduk pada ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Tunjangan Hari Raya (THR) akan berpedoman kepada Peraturan Perusahaan dan peraturan perundang-undangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Fasilitas Cuti tahunan diberikan kepada <b>Pihak Kedua</b> sebanyak 12 (dua belas) hari dan dapat diambil setelah <b>Pihak Kedua</b> bekerja di <b>Pihak Pertama</b> selama 12 (dua belas) bulan berturut-turut.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 5",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Hasil Pekerjaan dan Hak Milik Intelektual",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini setuju dan mengakui serta menyatakan bahwa seluruh hasil karya, penampilan, suara, rekaman-rekaman, program televisi serta segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> adalah sepenuhnya merupakan Hak Atas Kekayaan Intelektual milik <b>Pihak Pertama</b>, untuk itu <b>Pihak Kedua</b> dengan ini menyatakan segala hak yang ada pada dan dapat dijalankan dari yang dihasilkan oleh <b>Pihak Kedua</b> termasuk namun tidak terbatas hak menggandakan, memperbanyak, mengalihkan, menjual, menayangkan, menyiarkan seluruh atau sebagian dan mendistribusikan seluruh atau sebagian hasil karya <b>Pihak Kedua</b> yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain dalam bentuk apapun baik di dalam maupun di luar wilayah Negara Republik Indonesia kepada <b>Pihak Pertama</b> dan <b>Pihak Pertama</b> dengan ini menerima penyerahan tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> merupakan Pihak yang memiliki dan memegang Hak Atas Kekayaan Intelektual sebagaimana diatur dalam Pasal 5 Perjanjian ini dan berhak untuk mendaftarkan segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> kepada instansi pemerintah atau lembaga lainnya yang berwenang, dan bilamana diperlukan maka <b>Pihak Kedua</b> akan memberikan suatu dokumentasi tersendiri untuk pendaftaran tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> tidak berhak atas segala pendapatan atau bagian apapun dari hasil pengumuman, pencetakan, penggandaan, pendistribusian, pengeksploitasian, dan penyimpanan serta segala sesuatu yang timbul dari Hak Atas Kekayaan Intelektual sebagaimana disebutkan dalam butir 5.1. Pasal ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila <b>Pihak Kedua</b> berhenti atau diberhentikan oleh <b>Pihak Pertama</b> dengan cara apapun juga, maka <b>Pihak Kedua</b> wajib mengembalikan asli atau salinan/copy atau rekaman atas seluruh dokumen, gambar, disket, CD-ROM dan bahan-bahan lainnya terkait dengan Hasil Pekerjaan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 6",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Disiplin dan Peraturan Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan bekerja dengan penuh disiplin dan tanggung-jawab, serta memenuhi kewajibannya dengan mentaati tata tertib dan Peraturan Perusahaan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Disamping ketentuan yahng berlaku pada Peraturan Perusahaan dan Peraturan Tenaga Kerja, <b>Pihak Kedua</b> memahami dan akan mematuhi ketentuan sebagai berikut :",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 4
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan dan atau mutasi yang diputuskan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan  atau transfer/pengalihan antar Perusahaan afiliasi/grup dalam satu kota atau antar kota.<b>Pihak Kedua</b> wajib melaksanakan perintah tersebut yang merupakan kewenangan/hak prerogative <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa selama waktu dan hari kerja <b>Pihak Pertama</b>, dengan alasan apapun <b>Pihak Kedua</b> dilarang melakukan pekerjaan atau terikat dengan pihak lain selain untuk <b>Pihak Pertama</b>. Apabila <b>Pihak Kedua</b> bermaksud melakukan pekerjaan sampingan dan atau mengikat hubungan kerja dengan lembaga lain, wajib mengajukan dan mendapat ijin tertulis kepada dan dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menerima pemberian baik berupa barang maupun fasilitas dari Pihak Ketiga, yang diketahui atau patut diduga ada kaitannya dengan jabatan/fungsi <b>Pihak Kedua</b> di <b>Pihak Pertama</b>. Apabila pemberian dari Pihak Ketiga tidak mungkin ditolak, <b>Pihak Kedua</b> wajib menyerahkan pemberian tersebut ke <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> wajib selalu menjaga kerahasiaan <b>Pihak Pertama</b> dan dengan alasan atau bentuk apapun dilarang memberikan informasi yang berkaitan dengan <b>Pihak Pertama</b> kepada pihak lain, kecuali dengan ijin tertulis dari pimpinan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mengkopi/menduplikasi program dan atau produk milik <b>Pihak Pertama</b> tanpa ijin tertulis dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.7.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan atau terlibat langsung maupun tidak langsung dalam kegiatan yang merugikan <b>Pihak Pertama</b>, termasuk namun tidak terbatas pada manipulasi, korupsi, penggelapan, ataupun penyalahgunaan keuangan <b>Pihak Pertama</b> serta perusakan peralatan atau perlengkapan lain milik <b>Pihak Pertama</b>. ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.8.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menyalahgunakan kewenangan jabatan/fungsi untuk kepentingan di luar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.9.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menggunakan aset <b>Pihak Pertama</b> untuk kepentingan diluar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.10.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan perbuatan-perbuatan yang melanggar ketentuan hukum pidana dan atau kesusilaan di tempat kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.11.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mabuk, membawa dan atau memakai obat terlarang di lingkungan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.12.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak memberikan keterangan palsu atau yang dipalsukan pada saat proses penerimaan karyawan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju bahaw pelanggaran terhadap salah satu dari ketentuan pada butir 6.2. Pasal ini akan termasuk dalam kategori \"Kesalahan Berat\" yang berakibat Pemutusan Hubungan Kerja (PHK) secara langsung oleh <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> tidak menuntut apapun, kecuali yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 5
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal lain yang tidak atau belum diatur dalam perjanjian kerja ini akan merujuk pada Peraturan Perusahaan yang berlaku dan apabila masih belum jelas akan ditetapkan kemudian oleh Perusahaan dalam bentuk kebijaksanaan tertulis.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 7",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penyelesaian Perselisihan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila timbul perselisihan mengenai penafsiran pelaksanaan Perjanjian ini, Para Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat dengan berpedoman kepada Peraturan Perusahaan yang berlaku pada Perusahaan dan peraturan ketenagakerjaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila perselisihan tidak dapat diselesaikan sebagaimana dimaksud pada butir 7.1. Pasal ini, maka Para Pihak sepakat untuk menyelesaikannya sesuai dengan peraturan perundang-undangan di bidang ketenagakerjaan yang berlaku di Republik Indonesia.",0,'J',0,1,'','',true,0,true);
        
        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 8",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penutup",0,'C');
        
        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini, akan diatur lebih lanjut oleh Perusahaan berdasarkan ketentuan perundangan yang berlaku dan ketentuan yang berlaku di Perusahaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini menyatakan akan tunduk pada syarat-syarat yang ditetapkan dalam Perjanjian ini. Kecuali yang ditentukan dalam Perjanjian ini, maka <b>Pihak Kedua</b> tidak dapat menuntut fasilitas-fasilitas lainnya dari <b>Pihak Pertama</b> yang tidak diatur dalam Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Demikian Perjanjian Kerja ini dibuat dalam rangkap 2 (dua) asli dan ditandatangani oleh Para Pihak tanpa ada paksaan dari pihak manapun dan dalam keadaan sehat rohani maupun jasmani, karena itu mengikat kedua belah pihak untuk dilaksanakan.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Pihak Pertama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,"Pihak Kedua",0,'C',0,1,'','',true,0,true);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"PT OMNI INTIVISION",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Andriane Tjepaka Dewi",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,$contract->name,0,'C',0,1,'','',true,0,true);
        PDF::SetFont('helvetica', 'I', 10);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"HRGA Division Head",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', '', 10);
        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }

    public function ptelangprimaretailindo_pkwt($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"PERJANJIAN KERJA WAKTU TERTENTU (PKWT)",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y += 5;
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"Nomor: ".$contract->contract_number,0,'C');

        $y += 15;
        PDF::Line($x+19,$y+5,$x+189,$y+5);

        PDF::SetFont('helvetica', '', 10);

        $x += 19;
        $y+=5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Perjanjian Kerja Untuk Waktu Tertentu ini dibuat dan ditandatangani pada hari ini, <b>".$contract->contract_date->formatLocalized('%A')."</b>, tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, oleh dan antara:",0,'L',0,1,'','',true,0,true);

        $y+=15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>1.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>PT. Elang Prima Retailindo</b>, suatu perseroan terbatas berkedudukan di Jakarta, SCTV Tower, Jalan Asia Afrika Lot 19, Jakarta 10270,dalam hal ini diwakili oleh <b>Sri Dewi</b>, yang bertindak dalam jabatannya selaku <b><italic>Director</italic></b> dari dan oleh karenanya sah bertindak untuk dan atas nama serta mewakili kepentingan PT Elang Prima Retailindo (untuk selanjutnya disebut <b>\"Pihak Pertama/ Pengusaha\"</b>); dan ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>2.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>".$contract->name."</b>, beralamat di <b>".$contract->employee->alamat_ktp." RT ".$contract->employee->rt." RW ".$contract->employee->rw." Kelurahan ".$contract->employee->kelurahan." Kecamatan ".$contract->employee->kecamatan." ".$contract->employee->kota."</b> No KTP <b>".$contract->employee->no_ktp."</b>, dalam hal ini bertindak untuk dan atas nama diri sendiri (untuk selanjutnya disebut <b>\"Pihak Kedua/ Pekerja\"</b>).",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"<b>Pihak Pertama</b> dan <b>Pihak Kedua</b> untuk selanjutnya secara bersama-sama disebut \"Para Pihak\" dan masing-masing disebut \"Pihak\".",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Para Pihak masing-masing bertindak dalam jabatannya sebagaimana tersebut di atas saling menerangkan terlebih dahulu hal-hal sebagai berikut:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"A.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> adalah suatu perseroan terbatas yang bergerak di bidang perdagangan besar termasuk di dalamnya kelompok usaha <b>Pihak Pertama</b>, yang dalam kegiatan operasionalnya membutuhkan tenaga kerja dengan status sebagai karyawan tidak tetap; dan",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"B.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> menerima <b>Pihak Kedua</b> untuk bekerja pada <b>Pihak Pertama</b> untuk waktu tertentu yang didasarkan atas <b>jangka waktu tertentu</b>. <b>Pihak Kedua</b> telah menerima penjelasan dari <b>Pihak Pertama</b> terhadap jenis dan sifat pekerjaan yang akan dilakukan <b>Pihak Kedua</b> dan <b>Pihak Kedua</b> setuju dan menerima status hubungan kerja dimaksud.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"C.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"Para Pihak sepakat untuk membuat dan menandatangani Perjanjian Kerja Waktu Tertentu yang didasarkan atas <b>jangka waktu tertentu</b> yang dilakukan oleh <b>Pihak Kedua</b> sesuai peraturan perundang-undangan yang berlaku (untuk selanjutnya disebut \"Perjanjian\").",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Berdasarkan hal-hal tersebut di atas Para Pihak telah sepakat untuk mengikatkan diri dalam Perjanjian ini dengan ketentuan-ketentuan dan syarat-syarat sebagai berikut:",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 1",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penempatan dan Pelaksanaan Tugas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini bersedia bekerja di <b>Pihak Pertama</b> untuk ditempatkan pada:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+15, $y);
        PDF::MultiCell(30,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+15, $y+5);
        PDF::MultiCell(30,5,"Department/Divisi",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+45, $y);
        PDF::MultiCell(150,5,": ".$contract->position_role->name,0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+45, $y+5);
        PDF::MultiCell(150,5,": ".$contract->position_role->department->name."/".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam melaksanakan pekerjaannya, <b>Pihak Kedua</b> wajib melapor dan bertanggung jawab kepada <b>".$contract->position_role->parent->name."</b> sebagai atasan dari <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Ruang lingkup tugas dan tanggung jawab <b>Pihak Kedua</b> meliputi tetapi tidak terbatas pada yang tercantum dalam Lampiran Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 2
        PDF::AddPage();

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 2",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Jangka Waktu Perjanjian",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Perjanjian ini dibuat untuk jangka waktu <b>".$contract->contract_duration." (".$this->terbilang[$contract->contract_duration].") bulan</b> terhitung sejak tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, sampai dengan tanggal <b>".$contract->contract_expire_date->formatLocalized('%d %B %Y')."</b> dan dapat diperpanjang dengan pemberitahuan secara tertulis oleh <b>Pihak Pertama</b> kepada <b>Pihak Kedua</b> dalam waktu 7 (tujuh) hari sebelum jangka waktu Perjanjian ini berakhir.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila jangka waktu yang diperjanjikan berakhir, hubungan kerja antara <b>Pihak Pertama</b> dengan <b>Pihak Kedua</b> putus demi hukum dan tanpa adanya ikatan bagi <b>Pihak Pertama</b> untuk memberi uang pesangon dan atau pemberian lain kepada <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Perjanjian <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> masing-masing pada setiap saat dan dengan alasan apapun berhak memutuskan hubungan kerja. Apabila <b>Pihak Kedua</b> berkeinginan untuk memutuskan hubungan kerja sebelum masa perjanjian berakhir maka <b>Pihak Kedua</b> wajib memberikan pemberitahuan tertulis kepada <b>Pihak Pertama</b> minimal 30 hari sebelum tanggal efektif pengakhiran hubungan kerja. Ketentuan ini tidak berlaku dalam hal terjadi pelanggaran berat dan atau pelanggaran pidana oleh salah satu pihak.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Perjanjian akan dievaluasi atas hasil kerja <b>Pihak Kedua</b>. Apabila evaluasi tersebut dinilai memuaskan oleh <b>Pihak Pertama</b> maka <b>Pihak Kedua</b> akan ditetapkan oleh <b>Pihak Pertama</b> sebagai karyawan tetap dengan suatu Surat Pengangkatan yang ditetapkan oleh <b>Pihak Pertama</b>. Atau <b>Pihak Pertama</b> dapat memperpanjang kembali masa Perjanjian <b>Pihak Kedua</b> karena <b>Pihak Pertama</b> masih memerlukan waktu untuk melihat kinerja <b>Pihak Kedua</b> dan <b>Pihak Pertama</b> memberikan kesempatan kepada <b>Pihak Kedua</b> untuk melakukan peningkatan dan perbaikan kinerja <b>Pihak Kedua</b> selama waktu yang disetujui bersama.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 3",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Waktu Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> wajib hadir untuk melaksanakan tugas pekerjaan setuap saat, tanpa alasan apapun, kecuali atas persetujuan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Jam kerja <b>Pihak Kedua</b> akan disesuaikan dengan kebutuhan kerja, situasi, kondisi operasional, dan jadwal kerja yang diatur oleh <b>Pihak Pertama</b>, dengan ketentuan kehadiran dalam 1 (satu) minggu tidak kurang 40 (empat puluh) jam kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> berhak melakukan pengaturan jam kerja <b>Pihak Kedua</b> sesuai dengan kebutuhan kerja, situasi, kondisi operasional kerja termasuk shift kerja.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 4",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Upah dan Fasilitas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> akan memberikan upah kepada <b>Pihak Kedua</b> setiap bulan seperti yang tercantum dalam lampiran Perjanjian ini, dan dibayarkan sesuai dengan jadwal yang ditetapkan oleh <b>Pihak Pertama</b>. <b>Pihak Pertama</b> akan menanggung pajak penghasilan dari upah yang diterima <b>Pihak Kedua</b> sesuai dengan ketentuan perundangan yang berlaku apabila <b>Pihak Kedua</b> mempunyai NPWP.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> diikutsertakan dalam program BPJS Ketenagakerjaan dan BPJS Kesehatan sesuai ketentuan perundangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan mendapatkan manfaat kesehatan setelah masa kerjanya lebih dari 3 (tiga) bulan, sesuai dengan ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 3
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam hal <b>Pihak Kedua</b> ditugaskan melakukan perjalanan ke luar kota atau luar negri oleh <b>Pihak Pertama</b>, maka ketentuan mengenai biaya atau kompensasi terkait dengan pekerjaan ke luar kota atau luar negri tersebut mengikuti dan tunduk pada ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Tunjangan Hari Raya (THR) akan berpedoman kepada Peraturan Perusahaan dan peraturan perundang-undangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Fasilitas Cuti tahunan diberikan kepada <b>Pihak Kedua</b> sebanyak 12 (dua belas) hari dan dapat diambil setelah <b>Pihak Kedua</b> bekerja di <b>Pihak Pertama</b> selama 12 (dua belas) bulan berturut-turut.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 5",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Hasil Pekerjaan dan Hak Milik Intelektual",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini setuju dan mengakui serta menyatakan bahwa seluruh hasil karya, penampilan, suara, rekaman-rekaman, program televisi serta segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> adalah sepenuhnya merupakan Hak Atas Kekayaan Intelektual milik <b>Pihak Pertama</b>, untuk itu <b>Pihak Kedua</b> dengan ini menyatakan segala hak yang ada pada dan dapat dijalankan dari yang dihasilkan oleh <b>Pihak Kedua</b> termasuk namun tidak terbatas hak menggandakan, memperbanyak, mengalihkan, menjual, menayangkan, menyiarkan seluruh atau sebagian dan mendistribusikan seluruh atau sebagian hasil karya <b>Pihak Kedua</b> yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain dalam bentuk apapun baik di dalam maupun di luar wilayah Negara Republik Indonesia kepada <b>Pihak Pertama</b> dan <b>Pihak Pertama</b> dengan ini menerima penyerahan tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> merupakan Pihak yang memiliki dan memegang Hak Atas Kekayaan Intelektual sebagaimana diatur dalam Pasal 5 Perjanjian ini dan berhak untuk mendaftarkan segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> kepada instansi pemerintah atau lembaga lainnya yang berwenang, dan bilamana diperlukan maka <b>Pihak Kedua</b> akan memberikan suatu dokumentasi tersendiri untuk pendaftaran tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> tidak berhak atas segala pendapatan atau bagian apapun dari hasil pengumuman, pencetakan, penggandaan, pendistribusian, pengeksploitasian, dan penyimpanan serta segala sesuatu yang timbul dari Hak Atas Kekayaan Intelektual sebagaimana disebutkan dalam butir 5.1. Pasal ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila <b>Pihak Kedua</b> berhenti atau diberhentikan oleh <b>Pihak Pertama</b> dengan cara apapun juga, maka <b>Pihak Kedua</b> wajib mengembalikan asli atau salinan/copy atau rekaman atas seluruh dokumen, gambar, disket, CD-ROM dan bahan-bahan lainnya terkait dengan Hasil Pekerjaan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 6",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Disiplin dan Peraturan Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan bekerja dengan penuh disiplin dan tanggung-jawab, serta memenuhi kewajibannya dengan mentaati tata tertib dan Peraturan Perusahaan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Disamping ketentuan yahng berlaku pada Peraturan Perusahaan dan Peraturan Tenaga Kerja, <b>Pihak Kedua</b> memahami dan akan mematuhi ketentuan sebagai berikut :",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 4
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan dan atau mutasi yang diputuskan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan  atau transfer/pengalihan antar Perusahaan afiliasi/grup dalam satu kota atau antar kota.<b>Pihak Kedua</b> wajib melaksanakan perintah tersebut yang merupakan kewenangan/hak prerogative <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa selama waktu dan hari kerja <b>Pihak Pertama</b>, dengan alasan apapun <b>Pihak Kedua</b> dilarang melakukan pekerjaan atau terikat dengan pihak lain selain untuk <b>Pihak Pertama</b>. Apabila <b>Pihak Kedua</b> bermaksud melakukan pekerjaan sampingan dan atau mengikat hubungan kerja dengan lembaga lain, wajib mengajukan dan mendapat ijin tertulis kepada dan dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menerima pemberian baik berupa barang maupun fasilitas dari Pihak Ketiga, yang diketahui atau patut diduga ada kaitannya dengan jabatan/fungsi <b>Pihak Kedua</b> di <b>Pihak Pertama</b>. Apabila pemberian dari Pihak Ketiga tidak mungkin ditolak, <b>Pihak Kedua</b> wajib menyerahkan pemberian tersebut ke <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> wajib selalu menjaga kerahasiaan <b>Pihak Pertama</b> dan dengan alasan atau bentuk apapun dilarang memberikan informasi yang berkaitan dengan <b>Pihak Pertama</b> kepada pihak lain, kecuali dengan ijin tertulis dari pimpinan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mengkopi/menduplikasi program dan atau produk milik <b>Pihak Pertama</b> tanpa ijin tertulis dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.7.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan atau terlibat langsung maupun tidak langsung dalam kegiatan yang merugikan <b>Pihak Pertama</b>, termasuk namun tidak terbatas pada manipulasi, korupsi, penggelapan, ataupun penyalahgunaan keuangan <b>Pihak Pertama</b> serta perusakan peralatan atau perlengkapan lain milik <b>Pihak Pertama</b>. ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.8.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menyalahgunakan kewenangan jabatan/fungsi untuk kepentingan di luar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.9.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menggunakan aset <b>Pihak Pertama</b> untuk kepentingan diluar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.10.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan perbuatan-perbuatan yang melanggar ketentuan hukum pidana dan atau kesusilaan di tempat kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.11.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mabuk, membawa dan atau memakai obat terlarang di lingkungan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.12.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak memberikan keterangan palsu atau yang dipalsukan pada saat proses penerimaan karyawan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju bahaw pelanggaran terhadap salah satu dari ketentuan pada butir 6.2. Pasal ini akan termasuk dalam kategori \"Kesalahan Berat\" yang berakibat Pemutusan Hubungan Kerja (PHK) secara langsung oleh <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> tidak menuntut apapun, kecuali yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 5
        PDF::AddPage();

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal lain yang tidak atau belum diatur dalam perjanjian kerja ini akan merujuk pada Peraturan Perusahaan yang berlaku dan apabila masih belum jelas akan ditetapkan kemudian oleh Perusahaan dalam bentuk kebijaksanaan tertulis.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 7",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penyelesaian Perselisihan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila timbul perselisihan mengenai penafsiran pelaksanaan Perjanjian ini, Para Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat dengan berpedoman kepada Peraturan Perusahaan yang berlaku pada Perusahaan dan peraturan ketenagakerjaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila perselisihan tidak dapat diselesaikan sebagaimana dimaksud pada butir 7.1. Pasal ini, maka Para Pihak sepakat untuk menyelesaikannya sesuai dengan peraturan perundang-undangan di bidang ketenagakerjaan yang berlaku di Republik Indonesia.",0,'J',0,1,'','',true,0,true);
        
        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 8",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penutup",0,'C');
        
        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini, akan diatur lebih lanjut oleh Perusahaan berdasarkan ketentuan perundangan yang berlaku dan ketentuan yang berlaku di Perusahaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini menyatakan akan tunduk pada syarat-syarat yang ditetapkan dalam Perjanjian ini. Kecuali yang ditentukan dalam Perjanjian ini, maka <b>Pihak Kedua</b> tidak dapat menuntut fasilitas-fasilitas lainnya dari <b>Pihak Pertama</b> yang tidak diatur dalam Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Demikian Perjanjian Kerja ini dibuat dalam rangkap 2 (dua) asli dan ditandatangani oleh Para Pihak tanpa ada paksaan dari pihak manapun dan dalam keadaan sehat rohani maupun jasmani, karena itu mengikat kedua belah pihak untuk dilaksanakan.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Pihak Pertama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,"Pihak Kedua",0,'C',0,1,'','',true,0,true);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"PT ELANG PRIMA RETAILINDO",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Sri Dewi",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,$contract->name,0,'C',0,1,'','',true,0,true);
        PDF::SetFont('helvetica', 'I', 10);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"Director",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', '', 10);
        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }

    public function ptomniintivision_pkwtt($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"SURAT KEPUTUSAN PENGANGKATAN KARYAWAN TETAP",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y=PDF::getY();
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"No. ".$contract->contract_number,0,'C');

        PDF::SetFont('helvetica', '', 10);
        $x += 19;
        $y=PDF::getY()+15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(20,5,"Mengingat",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"1. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Optimalisasi sumber daya manusia yang ada dalam hirarki organisasi PT. Omni Intivision.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"2. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Kebutuhan Operasional Departemen ".$contract->position_role->department->name.", Divisi ".$contract->position_role->division->name.", PT Omni Intivision.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"3. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Dibutuhkannya Surat Keputusan dalam rangka pengangkatan sebagai Karyawan Tetap pada PT. Omni Intivision demi terselenggaranya tertib administrasi.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(30,5,"Menimbang",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(120,5,"Usulan Status Karyawan No. ".$contract->contract_reference_no,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(100,5,"Dengan ini perusahaan memutuskan bahwa :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(160,5,"Terhitung mulai tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, Saudara/i yang tersebut di bawah ini diangkat menjadi <b><u>Karyawan Tetap</u></b> pada PT. Omni Intivision.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Nama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"EM",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->nik,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Tempat/Tanggal Lahir",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->employee->tempat_lahir.", ".$contract->employee->tanggal_lahir->formatLocalized('%d %B %Y'),0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Departemen / Divisi",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->position_role->department->name." / ".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->jabatan,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Dengan ketentuan sebagai berikut :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(150,5,"a. Melaksanakan tugas dengan sebaik-baiknya dan penuh tanggung jawab",0,'L',0,1,'','',true,0,true);
        
        $y=PDF::getY();
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(150,5,"b. Mematuhi ketentuan dan Peraturan Perusahaan yang berlaku",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Keputusan ini berlaku sejak tanggal ditetapkan, apabila di kemudian hari terdapat kekeliruan dalam Surat Keputusan ini akan diadakan pembetulan sebagaimana mestinya.",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Ditetapkan di : Jakarta",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Pada Tanggal : ".$contract->contract_date->formatLocalized('%d %B %Y'),0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Atas Nama PT Omni Intivision",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Sutanto Hartono",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Director",0,'L',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }

    public function ptelangprimaretailindo_pkwtt($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"SURAT KEPUTUSAN PENGANGKATAN KARYAWAN TETAP",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y=PDF::getY();
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"No. ".$contract->contract_number,0,'C');

        PDF::SetFont('helvetica', '', 10);
        $x += 19;
        $y=PDF::getY()+15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(20,5,"Mengingat",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"1. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Optimalisasi sumber daya manusia yang ada dalam hirarki organisasi PT. Elang Prima Retailindo.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"2. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Kebutuhan Operasional Departemen ".$contract->position_role->department->name.", Divisi ".$contract->position_role->division->name.", PT Elang Prima Retailindo.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"3. ",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Dibutuhkannya Surat Keputusan dalam rangka pengangkatan sebagai Karyawan Tetap pada PT. Elang Prima Retailindo demi terselenggaranya tertib administrasi.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(30,5,"Menimbang",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(120,5,"Usulan Status Karyawan No. ".$contract->contract_reference_no,1,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(100,5,"Dengan ini perusahaan memutuskan bahwa :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(160,5,"Terhitung mulai tanggal ".$contract->contract_date->formatLocalized('%d %B %Y').", Saudara/i yang tersebut di bawah ini diangkat menjadi <b><u>Karyawan Tetap</u></b> pada PT. Elang Prima Retailindo.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Nama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"EM",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->nik,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Tempat/Tanggal Lahir",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->employee->tempat_lahir.", ".$contract->employee->tanggal_lahir->formatLocalized('%d %B %Y'),0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Departemen / Divisi",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->position_role->department->name." / ".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(40,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(100,5,": ".$contract->jabatan,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Dengan ketentuan sebagai berikut :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(150,5,"a. Melaksanakan tugas dengan sebaik-baiknya dan penuh tanggung jawab",0,'L',0,1,'','',true,0,true);
        
        $y=PDF::getY();
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(150,5,"b. Mematuhi ketentuan dan Peraturan Perusahaan yang berlaku",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Keputusan ini berlaku sejak tanggal ditetapkan, apabila di kemudian hari terdapat kekeliruan dalam Surat Keputusan ini akan diadakan pembetulan sebagaimana mestinya.",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Ditetapkan di : Jakarta",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Pada Tanggal : ".$contract->contract_date->formatLocalized('%d %B %Y'),0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Atas Nama PT Elang Prima Retailindo",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"<b>Sri Dewi</b>",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Director",0,'L',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }

    public function ptomniintivision_probation($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"PERJANJIAN KERJA WAKTU TERTENTU (PKWT)",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y += 5;
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"Nomor: ".$contract->contract_number,0,'C');

        $y += 5;
        PDF::Line($x+19,$y+5,$x+189,$y+5);

        PDF::SetFont('helvetica', '', 10);
        $x += 19;
        $y+=5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Perjanjian Kerja Untuk Waktu Tertentu ini dibuat dan ditandatangani pada hari ini, <b>".$contract->contract_date->formatLocalized('%A')."</b>, tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, oleh dan antara:",0,'L',0,1,'','',true,0,true);

        $y+=15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>1.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>PT. OMNI INTIVISION</b>, suatu perseroan terbatas berkedudukan di Jakarta, SCTV Tower, Jalan Asia Afrika Lot 19, Jakarta 10270,dalam hal ini diwakili oleh <b>Andriane Tjepaka Dewi</b>, yang bertindak dalam jabatannya selaku <b><italic>HRGA Division Head</italic></b> dari dan oleh karenanya sah bertindak untuk dan atas nama serta mewakili kepentingan PT Omni Intivision (untuk selanjutnya disebut <b>\"Pihak Pertama/ Pengusaha\"</b>); dan ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>2.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>".$contract->name."</b>, beralamat di ".$contract->employee->alamat_ktp." RT ".$contract->employee->rt." RW ".$contract->employee->rw." Kelurahan ".$contract->employee->kelurahan." Kecamatan ".$contract->employee->kecamatan." ".$contract->employee->kota." No KTP ".$contract->employee->no_ktp.", dalam hal ini bertindak untuk dan atas nama diri sendiri (untuk selanjutnya disebut <b>\"Pihak Kedua/ Pekerja\"</b>).",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"<b>Pihak Pertama</b> dan <b>Pihak Kedua</b> untuk selanjutnya secara bersama-sama disebut \"Para Pihak\" dan masing-masing disebut \"Pihak\".",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Para Pihak masing-masing bertindak dalam jabatannya sebagaimana tersebut di atas saling menerangkan terlebih dahulu hal-hal sebagai berikut:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"A.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> adalah suatu perseroan terbatas yang bergerak di bidang penyiaran televisi swasta berjaringan termasuk di dalamnya kelompok usaha <b>Pihak Pertama</b>, yang dalam kegiatan operasionalnya membutuhkan tenaga kerja dengan status sebagai karyawan tidak tetap; dan",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"B.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> menerima <b>Pihak Kedua</b> untuk bekerja pada <b>Pihak Pertama</b> untuk waktu tertentu yang didasarkan atas <b>jangka waktu tertentu</b>. <b>Pihak Kedua</b> telah menerima penjelasan dari <b>Pihak Pertama</b> terhadap jenis dan sifat pekerjaan yang akan dilakukan <b>Pihak Kedua</b> dan <b>Pihak Kedua</b> setuju dan menerima status hubungan kerja dimaksud.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"C.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"Para Pihak sepakat untuk membuat dan menandatangani Perjanjian Kerja Waktu Tertentu yang didasarkan atas <b>jangka waktu tertentu</b> yang dilakukan oleh <b>Pihak Kedua</b> sesuai peraturan perundang-undangan yang berlaku (untuk selanjutnya disebut \"Perjanjian\").",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Berdasarkan hal-hal tersebut di atas Para Pihak telah sepakat untuk mengikatkan diri dalam Perjanjian ini dengan ketentuan-ketentuan dan syarat-syarat sebagai berikut:",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 1",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penempatan dan Pelaksanaan Tugas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini bersedia bekerja di <b>Pihak Pertama</b> untuk ditempatkan pada:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+15, $y);
        PDF::MultiCell(30,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+15, $y+5);
        PDF::MultiCell(30,5,"Department/Divisi",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+45, $y);
        PDF::MultiCell(150,5,": ".$contract->position_role->name,0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+45, $y+5);
        PDF::MultiCell(150,5,": ".$contract->position_role->department->name."/".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam melaksanakan pekerjaannya, <b>Pihak Kedua</b> wajib melapor dan bertanggung jawab kepada <b>".$contract->position_role->parent->name."</b> sebagai atasan dari <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Ruang lingkup tugas dan tanggung jawab <b>Pihak Kedua</b> meliputi tetapi tidak terbatas pada yang tercantum dalam Lampiran Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 2
        PDF::AddPage();

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 2",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Jangka Waktu Perjanjian & Masa Percobaan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju untuk bekerja efektif tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b> dengan Masa Percobaan selama <b>".$contract->contract_duration." (".$this->terbilang[$contract->contract_duration].") bulan</b> terhitung mulai tanggal tersebut sampai dengan tanggal <b>".$contract->contract_expire_date->formatLocalized('%d %B %Y')."</b>.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama Masa Percobaan <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> masing-masing pada setiap saat dan dengan alasan apapun berhak memutuskan hubungan kerja. Apabila <b>Pihak Kedua</b> berkeinginan untuk memutuskan hubungan kerja sebelum masa perjanjian berakhir maka <b>Pihak Kedua</b> wajib memberikan pemberitahuan tertulis kepada <b>Pihak Pertama</b> minimal 30 hari sebelum tanggal efektif pengakhiran hubungan kerja. Ketentuan ini tidak berlaku dalam hal terjadi pelanggaran berat dan atau pelanggaran pidana oleh salah satu pihak.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Perjanjian akan dievaluasi atas hasil kerja <b>Pihak Kedua</b>. Apabila evaluasi tersebut dinilai memuaskan oleh <b>Pihak Pertama</b> maka <b>Pihak Kedua</b> akan ditetapkan oleh <b>Pihak Pertama</b> sebagai karyawan tetap dengan suatu Surat Pengangkatan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 3",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Waktu Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> wajib hadir untuk melaksanakan tugas pekerjaan setuap saat, tanpa alasan apapun, kecuali atas persetujuan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Jam kerja <b>Pihak Kedua</b> akan disesuaikan dengan kebutuhan kerja, situasi, kondisi operasional, dan jadwal kerja yang diatur oleh <b>Pihak Pertama</b>, dengan ketentuan kehadiran dalam 1 (satu) minggu tidak kurang 40 (empat puluh) jam kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> berhak melakukan pengaturan jam kerja <b>Pihak Kedua</b> sesuai dengan kebutuhan kerja, situasi, kondisi operasional kerja termasuk shift kerja.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 4",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Upah dan Fasilitas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> akan memberikan upah kepada <b>Pihak Kedua</b> setiap bulan seperti yang tercantum dalam lampiran Perjanjian ini, dan dibayarkan sesuai dengan jadwal yang ditetapkan oleh <b>Pihak Pertama</b>. <b>Pihak Pertama</b> akan menanggung pajak penghasilan dari upah yang diterima <b>Pihak Kedua</b> sesuai dengan ketentuan perundangan yang berlaku apabila <b>Pihak Kedua</b> mempunyai NPWP.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> diikutsertakan dalam program BPJS Ketenagakerjaan dan BPJS Kesehatan sesuai ketentuan perundangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan mendapatkan manfaat kesehatan setelah masa kerjanya lebih dari 3 (tiga) bulan, sesuai dengan ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 3
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam hal <b>Pihak Kedua</b> ditugaskan melakukan perjalanan ke luar kota atau luar negri oleh <b>Pihak Pertama</b>, maka ketentuan mengenai biaya atau kompensasi terkait dengan pekerjaan ke luar kota atau luar negri tersebut mengikuti dan tunduk pada ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Tunjangan Hari Raya (THR) akan berpedoman kepada Peraturan Perusahaan dan peraturan perundang-undangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Fasilitas Cuti tahunan diberikan kepada <b>Pihak Kedua</b> sebanyak 12 (dua belas) hari dan dapat diambil setelah <b>Pihak Kedua</b> bekerja di <b>Pihak Pertama</b> selama 12 (dua belas) bulan berturut-turut.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 5",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Hasil Pekerjaan dan Hak Milik Intelektual",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini setuju dan mengakui serta menyatakan bahwa seluruh hasil karya, penampilan, suara, rekaman-rekaman, program televisi serta segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> adalah sepenuhnya merupakan Hak Atas Kekayaan Intelektual milik <b>Pihak Pertama</b>, untuk itu <b>Pihak Kedua</b> dengan ini menyatakan segala hak yang ada pada dan dapat dijalankan dari yang dihasilkan oleh <b>Pihak Kedua</b> termasuk namun tidak terbatas hak menggandakan, memperbanyak, mengalihkan, menjual, menayangkan, menyiarkan seluruh atau sebagian dan mendistribusikan seluruh atau sebagian hasil karya <b>Pihak Kedua</b> yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain dalam bentuk apapun baik di dalam maupun di luar wilayah Negara Republik Indonesia kepada <b>Pihak Pertama</b> dan <b>Pihak Pertama</b> dengan ini menerima penyerahan tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> merupakan Pihak yang memiliki dan memegang Hak Atas Kekayaan Intelektual sebagaimana diatur dalam Pasal 5 Perjanjian ini dan berhak untuk mendaftarkan segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> kepada instansi pemerintah atau lembaga lainnya yang berwenang, dan bilamana diperlukan maka <b>Pihak Kedua</b> akan memberikan suatu dokumentasi tersendiri untuk pendaftaran tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> tidak berhak atas segala pendapatan atau bagian apapun dari hasil pengumuman, pencetakan, penggandaan, pendistribusian, pengeksploitasian, dan penyimpanan serta segala sesuatu yang timbul dari Hak Atas Kekayaan Intelektual sebagaimana disebutkan dalam butir 5.1. Pasal ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila <b>Pihak Kedua</b> berhenti atau diberhentikan oleh <b>Pihak Pertama</b> dengan cara apapun juga, maka <b>Pihak Kedua</b> wajib mengembalikan asli atau salinan/copy atau rekaman atas seluruh dokumen, gambar, disket, CD-ROM dan bahan-bahan lainnya terkait dengan Hasil Pekerjaan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 6",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Disiplin dan Peraturan Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan bekerja dengan penuh disiplin dan tanggung-jawab, serta memenuhi kewajibannya dengan mentaati tata tertib dan Peraturan Perusahaan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Disamping ketentuan yahng berlaku pada Peraturan Perusahaan dan Peraturan Tenaga Kerja, <b>Pihak Kedua</b> memahami dan akan mematuhi ketentuan sebagai berikut :",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 4
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan dan atau mutasi yang diputuskan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan  atau transfer/pengalihan antar Perusahaan afiliasi/grup dalam satu kota atau antar kota.<b>Pihak Kedua</b> wajib melaksanakan perintah tersebut yang merupakan kewenangan/hak prerogative <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa selama waktu dan hari kerja <b>Pihak Pertama</b>, dengan alasan apapun <b>Pihak Kedua</b> dilarang melakukan pekerjaan atau terikat dengan pihak lain selain untuk <b>Pihak Pertama</b>. Apabila <b>Pihak Kedua</b> bermaksud melakukan pekerjaan sampingan dan atau mengikat hubungan kerja dengan lembaga lain, wajib mengajukan dan mendapat ijin tertulis kepada dan dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menerima pemberian baik berupa barang maupun fasilitas dari Pihak Ketiga, yang diketahui atau patut diduga ada kaitannya dengan jabatan/fungsi <b>Pihak Kedua</b> di <b>Pihak Pertama</b>. Apabila pemberian dari Pihak Ketiga tidak mungkin ditolak, <b>Pihak Kedua</b> wajib menyerahkan pemberian tersebut ke <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> wajib selalu menjaga kerahasiaan <b>Pihak Pertama</b> dan dengan alasan atau bentuk apapun dilarang memberikan informasi yang berkaitan dengan <b>Pihak Pertama</b> kepada pihak lain, kecuali dengan ijin tertulis dari pimpinan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mengkopi/menduplikasi program dan atau produk milik <b>Pihak Pertama</b> tanpa ijin tertulis dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.7.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan atau terlibat langsung maupun tidak langsung dalam kegiatan yang merugikan <b>Pihak Pertama</b>, termasuk namun tidak terbatas pada manipulasi, korupsi, penggelapan, ataupun penyalahgunaan keuangan <b>Pihak Pertama</b> serta perusakan peralatan atau perlengkapan lain milik <b>Pihak Pertama</b>. ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.8.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menyalahgunakan kewenangan jabatan/fungsi untuk kepentingan di luar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.9.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menggunakan aset <b>Pihak Pertama</b> untuk kepentingan diluar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.10.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan perbuatan-perbuatan yang melanggar ketentuan hukum pidana dan atau kesusilaan di tempat kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.11.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mabuk, membawa dan atau memakai obat terlarang di lingkungan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.12.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak memberikan keterangan palsu atau yang dipalsukan pada saat proses penerimaan karyawan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju bahaw pelanggaran terhadap salah satu dari ketentuan pada butir 6.2. Pasal ini akan termasuk dalam kategori \"Kesalahan Berat\" yang berakibat Pemutusan Hubungan Kerja (PHK) secara langsung oleh <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> tidak menuntut apapun, kecuali yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 5
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal lain yang tidak atau belum diatur dalam perjanjian kerja ini akan merujuk pada Peraturan Perusahaan yang berlaku dan apabila masih belum jelas akan ditetapkan kemudian oleh Perusahaan dalam bentuk kebijaksanaan tertulis.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 7",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penyelesaian Perselisihan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila timbul perselisihan mengenai penafsiran pelaksanaan Perjanjian ini, Para Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat dengan berpedoman kepada Peraturan Perusahaan yang berlaku pada Perusahaan dan peraturan ketenagakerjaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila perselisihan tidak dapat diselesaikan sebagaimana dimaksud pada butir 7.1. Pasal ini, maka Para Pihak sepakat untuk menyelesaikannya sesuai dengan peraturan perundang-undangan di bidang ketenagakerjaan yang berlaku di Republik Indonesia.",0,'J',0,1,'','',true,0,true);
        
        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 8",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penutup",0,'C');
        
        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini, akan diatur lebih lanjut oleh Perusahaan berdasarkan ketentuan perundangan yang berlaku dan ketentuan yang berlaku di Perusahaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini menyatakan akan tunduk pada syarat-syarat yang ditetapkan dalam Perjanjian ini. Kecuali yang ditentukan dalam Perjanjian ini, maka <b>Pihak Kedua</b> tidak dapat menuntut fasilitas-fasilitas lainnya dari <b>Pihak Pertama</b> yang tidak diatur dalam Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Demikian Perjanjian Kerja ini dibuat dalam rangkap 2 (dua) asli dan ditandatangani oleh Para Pihak tanpa ada paksaan dari pihak manapun dan dalam keadaan sehat rohani maupun jasmani, karena itu mengikat kedua belah pihak untuk dilaksanakan.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Pihak Pertama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,"Pihak Kedua",0,'C',0,1,'','',true,0,true);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"PT OMNI INTIVISION",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Andriane Tjepaka Dewi",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,$contract->name,0,'C',0,1,'','',true,0,true);
        PDF::SetFont('helvetica', 'I', 10);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"HRGA Division Head",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', '', 10);
        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }


    public function ptelangprimaretailindo_probation($contract)
    {
        $x = 1;
        $y = 30;
        PDF::SetTitle('Print '.$contract->contract_type);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"PERJANJIAN KERJA WAKTU TERTENTU (PKWT)",0,'C');

        PDF::SetFont('helvetica', 'B', 12);
        $y += 5;
        PDF::SetXY($x+21, $y);
        PDF::MultiCell(170,5,"Nomor: ".$contract->contract_number,0,'C');

        $y += 5;
        PDF::Line($x+19,$y+5,$x+189,$y+5);

        PDF::SetFont('helvetica', '', 10);
        $x += 19;
        $y+=5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Perjanjian Kerja Untuk Waktu Tertentu ini dibuat dan ditandatangani pada hari ini, <b>".$contract->contract_date->formatLocalized('%A')."</b>, tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b>, oleh dan antara:",0,'L',0,1,'','',true,0,true);

        $y+=15;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>1.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>PT. ELANG PRIMA RETAILINDO</b>, suatu perseroan terbatas berkedudukan di Jakarta, SCTV Tower, Jalan Asia Afrika Lot 19, Jakarta 10270,dalam hal ini diwakili oleh <b>Sri Dewi</b>, yang bertindak dalam jabatannya selaku <b><italic>Director</italic></b> dari dan oleh karenanya sah bertindak untuk dan atas nama serta mewakili kepentingan PT Elang Prima Retailindo (untuk selanjutnya disebut <b>\"Pihak Pertama/ Pengusaha\"</b>); dan ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(5,5,"<b>2.</b>",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"<b>".$contract->name."</b>, beralamat di ".$contract->employee->alamat_ktp." RT ".$contract->employee->rt." RW ".$contract->employee->rw." Kelurahan ".$contract->employee->kelurahan." Kecamatan ".$contract->employee->kecamatan." ".$contract->employee->kota." No KTP ".$contract->employee->no_ktp.", dalam hal ini bertindak untuk dan atas nama diri sendiri (untuk selanjutnya disebut <b>\"Pihak Kedua/ Pekerja\"</b>).",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"<b>Pihak Pertama</b> dan <b>Pihak Kedua</b> untuk selanjutnya secara bersama-sama disebut \"Para Pihak\" dan masing-masing disebut \"Pihak\".",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Para Pihak masing-masing bertindak dalam jabatannya sebagaimana tersebut di atas saling menerangkan terlebih dahulu hal-hal sebagai berikut:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"A.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> adalah suatu perseroan terbatas yang bergerak di bidang perdagangan besar termasuk di dalamnya kelompok usaha <b>Pihak Pertama</b>, yang dalam kegiatan operasionalnya membutuhkan tenaga kerja dengan status sebagai karyawan tidak tetap; dan",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"B.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"bahwa <b>Pihak Pertama</b> menerima <b>Pihak Kedua</b> untuk bekerja pada <b>Pihak Pertama</b> untuk waktu tertentu yang didasarkan atas <b>jangka waktu tertentu</b>. <b>Pihak Kedua</b> telah menerima penjelasan dari <b>Pihak Pertama</b> terhadap jenis dan sifat pekerjaan yang akan dilakukan <b>Pihak Kedua</b> dan <b>Pihak Kedua</b> setuju dan menerima status hubungan kerja dimaksud.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(6,5,"C.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+5, $y);
        PDF::MultiCell(165,5,"Para Pihak sepakat untuk membuat dan menandatangani Perjanjian Kerja Waktu Tertentu yang didasarkan atas <b>jangka waktu tertentu</b> yang dilakukan oleh <b>Pihak Kedua</b> sesuai peraturan perundang-undangan yang berlaku (untuk selanjutnya disebut \"Perjanjian\").",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Berdasarkan hal-hal tersebut di atas Para Pihak telah sepakat untuk mengikatkan diri dalam Perjanjian ini dengan ketentuan-ketentuan dan syarat-syarat sebagai berikut:",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 1",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penempatan dan Pelaksanaan Tugas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini bersedia bekerja di <b>Pihak Pertama</b> untuk ditempatkan pada:",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+15, $y);
        PDF::MultiCell(30,5,"Jabatan",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+15, $y+5);
        PDF::MultiCell(30,5,"Department/Divisi",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+45, $y);
        PDF::MultiCell(150,5,": ".$contract->position_role->name,0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+45, $y+5);
        PDF::MultiCell(150,5,": ".$contract->position_role->department->name."/".$contract->position_role->division->name,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam melaksanakan pekerjaannya, <b>Pihak Kedua</b> wajib melapor dan bertanggung jawab kepada <b>".$contract->position_role->parent->name."</b> sebagai atasan dari <b>Pihak Kedua</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"1.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Ruang lingkup tugas dan tanggung jawab <b>Pihak Kedua</b> meliputi tetapi tidak terbatas pada yang tercantum dalam Lampiran Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 2
        PDF::AddPage();

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 2",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Jangka Waktu Perjanjian & Masa Percobaan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju untuk bekerja efektif tanggal <b>".$contract->contract_date->formatLocalized('%d %B %Y')."</b> dengan Masa Percobaan selama <b>".$contract->contract_duration." (".$this->terbilang[$contract->contract_duration].") bulan</b> terhitung mulai tanggal tersebut sampai dengan tanggal <b>".$contract->contract_expire_date->formatLocalized('%d %B %Y')."</b>.",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama Masa Percobaan <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> masing-masing pada setiap saat dan dengan alasan apapun berhak memutuskan hubungan kerja. Apabila <b>Pihak Kedua</b> berkeinginan untuk memutuskan hubungan kerja sebelum masa perjanjian berakhir maka <b>Pihak Kedua</b> wajib memberikan pemberitahuan tertulis kepada <b>Pihak Pertama</b> minimal 30 hari sebelum tanggal efektif pengakhiran hubungan kerja. Ketentuan ini tidak berlaku dalam hal terjadi pelanggaran berat dan atau pelanggaran pidana oleh salah satu pihak.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Selama masa Percobaan akan dievaluasi atas hasil kerja <b>Pihak Kedua</b>. Apabila evaluasi tersebut dinilai memuaskan oleh <b>Pihak Pertama</b> maka <b>Pihak Kedua</b> akan ditetapkan oleh <b>Pihak Pertama</b> sebagai karyawan tetap dengan suatu Surat Pengangkatan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 3",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Waktu Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> wajib hadir untuk melaksanakan tugas pekerjaan setuap saat, tanpa alasan apapun, kecuali atas persetujuan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Jam kerja <b>Pihak Kedua</b> akan disesuaikan dengan kebutuhan kerja, situasi, kondisi operasional, dan jadwal kerja yang diatur oleh <b>Pihak Pertama</b>, dengan ketentuan kehadiran dalam 1 (satu) minggu tidak kurang 40 (empat puluh) jam kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"3.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> berhak melakukan pengaturan jam kerja <b>Pihak Kedua</b> sesuai dengan kebutuhan kerja, situasi, kondisi operasional kerja termasuk shift kerja.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 4",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Upah dan Fasilitas",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> akan memberikan upah kepada <b>Pihak Kedua</b> setiap bulan seperti yang tercantum dalam lampiran Perjanjian ini, dan dibayarkan sesuai dengan jadwal yang ditetapkan oleh <b>Pihak Pertama</b>. <b>Pihak Pertama</b> akan menanggung pajak penghasilan dari upah yang diterima <b>Pihak Kedua</b> sesuai dengan ketentuan perundangan yang berlaku apabila <b>Pihak Kedua</b> mempunyai NPWP.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> diikutsertakan dalam program BPJS Ketenagakerjaan dan BPJS Kesehatan sesuai ketentuan perundangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan mendapatkan manfaat kesehatan setelah masa kerjanya lebih dari 3 (tiga) bulan, sesuai dengan ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 3
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Dalam hal <b>Pihak Kedua</b> ditugaskan melakukan perjalanan ke luar kota atau luar negri oleh <b>Pihak Pertama</b>, maka ketentuan mengenai biaya atau kompensasi terkait dengan pekerjaan ke luar kota atau luar negri tersebut mengikuti dan tunduk pada ketentuan dan aturan yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Tunjangan Hari Raya (THR) akan berpedoman kepada Peraturan Perusahaan dan peraturan perundang-undangan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"4.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Fasilitas Cuti tahunan diberikan kepada <b>Pihak Kedua</b> sebanyak 12 (dua belas) hari dan dapat diambil setelah <b>Pihak Kedua</b> bekerja di <b>Pihak Pertama</b> selama 12 (dua belas) bulan berturut-turut.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 5",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Hasil Pekerjaan dan Hak Milik Intelektual",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini setuju dan mengakui serta menyatakan bahwa seluruh hasil karya, penampilan, suara, rekaman-rekaman, program televisi serta segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> adalah sepenuhnya merupakan Hak Atas Kekayaan Intelektual milik <b>Pihak Pertama</b>, untuk itu <b>Pihak Kedua</b> dengan ini menyatakan segala hak yang ada pada dan dapat dijalankan dari yang dihasilkan oleh <b>Pihak Kedua</b> termasuk namun tidak terbatas hak menggandakan, memperbanyak, mengalihkan, menjual, menayangkan, menyiarkan seluruh atau sebagian dan mendistribusikan seluruh atau sebagian hasil karya <b>Pihak Kedua</b> yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain dalam bentuk apapun baik di dalam maupun di luar wilayah Negara Republik Indonesia kepada <b>Pihak Pertama</b> dan <b>Pihak Pertama</b> dengan ini menerima penyerahan tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Pertama</b> merupakan Pihak yang memiliki dan memegang Hak Atas Kekayaan Intelektual sebagaimana diatur dalam Pasal 5 Perjanjian ini dan berhak untuk mendaftarkan segala sesuatu yang dihasilkan <b>Pihak Kedua</b> secara sendiri dan atau bersama-sama dengan pihak lain selama melaksanakan pekerjaan dan atau bekerja pada <b>Pihak Pertama</b> kepada instansi pemerintah atau lembaga lainnya yang berwenang, dan bilamana diperlukan maka <b>Pihak Kedua</b> akan memberikan suatu dokumentasi tersendiri untuk pendaftaran tersebut.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> tidak berhak atas segala pendapatan atau bagian apapun dari hasil pengumuman, pencetakan, penggandaan, pendistribusian, pengeksploitasian, dan penyimpanan serta segala sesuatu yang timbul dari Hak Atas Kekayaan Intelektual sebagaimana disebutkan dalam butir 5.1. Pasal ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"5.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila <b>Pihak Kedua</b> berhenti atau diberhentikan oleh <b>Pihak Pertama</b> dengan cara apapun juga, maka <b>Pihak Kedua</b> wajib mengembalikan asli atau salinan/copy atau rekaman atas seluruh dokumen, gambar, disket, CD-ROM dan bahan-bahan lainnya terkait dengan Hasil Pekerjaan kepada <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 6",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Disiplin dan Peraturan Kerja",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> akan bekerja dengan penuh disiplin dan tanggung-jawab, serta memenuhi kewajibannya dengan mentaati tata tertib dan Peraturan Perusahaan yang berlaku.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Disamping ketentuan yahng berlaku pada Peraturan Perusahaan dan Peraturan Tenaga Kerja, <b>Pihak Kedua</b> memahami dan akan mematuhi ketentuan sebagai berikut :",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 4
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan dan atau mutasi yang diputuskan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> bersedia menerima penugasan  atau transfer/pengalihan antar Perusahaan afiliasi/grup dalam satu kota atau antar kota.<b>Pihak Kedua</b> wajib melaksanakan perintah tersebut yang merupakan kewenangan/hak prerogative <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa selama waktu dan hari kerja <b>Pihak Pertama</b>, dengan alasan apapun <b>Pihak Kedua</b> dilarang melakukan pekerjaan atau terikat dengan pihak lain selain untuk <b>Pihak Pertama</b>. Apabila <b>Pihak Kedua</b> bermaksud melakukan pekerjaan sampingan dan atau mengikat hubungan kerja dengan lembaga lain, wajib mengajukan dan mendapat ijin tertulis kepada dan dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menerima pemberian baik berupa barang maupun fasilitas dari Pihak Ketiga, yang diketahui atau patut diduga ada kaitannya dengan jabatan/fungsi <b>Pihak Kedua</b> di <b>Pihak Pertama</b>. Apabila pemberian dari Pihak Ketiga tidak mungkin ditolak, <b>Pihak Kedua</b> wajib menyerahkan pemberian tersebut ke <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.5.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> wajib selalu menjaga kerahasiaan <b>Pihak Pertama</b> dan dengan alasan atau bentuk apapun dilarang memberikan informasi yang berkaitan dengan <b>Pihak Pertama</b> kepada pihak lain, kecuali dengan ijin tertulis dari pimpinan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.6.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mengkopi/menduplikasi program dan atau produk milik <b>Pihak Pertama</b> tanpa ijin tertulis dari <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.7.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan atau terlibat langsung maupun tidak langsung dalam kegiatan yang merugikan <b>Pihak Pertama</b>, termasuk namun tidak terbatas pada manipulasi, korupsi, penggelapan, ataupun penyalahgunaan keuangan <b>Pihak Pertama</b> serta perusakan peralatan atau perlengkapan lain milik <b>Pihak Pertama</b>. ",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.8.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menyalahgunakan kewenangan jabatan/fungsi untuk kepentingan di luar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.9.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan menggunakan aset <b>Pihak Pertama</b> untuk kepentingan diluar kepentingan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.10.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan melakukan perbuatan-perbuatan yang melanggar ketentuan hukum pidana dan atau kesusilaan di tempat kerja.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.11.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak akan mabuk, membawa dan atau memakai obat terlarang di lingkungan <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(15,5,"6.2.12.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+25, $y);
        PDF::MultiCell(150,5,"Bahwa <b>Pihak Kedua</b> tidak memberikan keterangan palsu atau yang dipalsukan pada saat proses penerimaan karyawan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> setuju bahaw pelanggaran terhadap salah satu dari ketentuan pada butir 6.2. Pasal ini akan termasuk dalam kategori \"Kesalahan Berat\" yang berakibat Pemutusan Hubungan Kerja (PHK) secara langsung oleh <b>Pihak Pertama</b> dan <b>Pihak Kedua</b> tidak menuntut apapun, kecuali yang ditetapkan oleh <b>Pihak Pertama</b>.",0,'J',0,1,'','',true,0,true);

        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        // Page 5
        PDF::AddPage();

        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"6.4.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal lain yang tidak atau belum diatur dalam perjanjian kerja ini akan merujuk pada Peraturan Perusahaan yang berlaku dan apabila masih belum jelas akan ditetapkan kemudian oleh Perusahaan dalam bentuk kebijaksanaan tertulis.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 7",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penyelesaian Perselisihan",0,'C');

        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila timbul perselisihan mengenai penafsiran pelaksanaan Perjanjian ini, Para Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mufakat dengan berpedoman kepada Peraturan Perusahaan yang berlaku pada Perusahaan dan peraturan ketenagakerjaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"7.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Apabila perselisihan tidak dapat diselesaikan sebagaimana dimaksud pada butir 7.1. Pasal ini, maka Para Pihak sepakat untuk menyelesaikannya sesuai dengan peraturan perundang-undangan di bidang ketenagakerjaan yang berlaku di Republik Indonesia.",0,'J',0,1,'','',true,0,true);
        
        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Pasal 8",0,'C');

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Penutup",0,'C');
        
        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.1.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini, akan diatur lebih lanjut oleh Perusahaan berdasarkan ketentuan perundangan yang berlaku dan ketentuan yang berlaku di Perusahaan.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.2.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"<b>Pihak Kedua</b> dengan ini menyatakan akan tunduk pada syarat-syarat yang ditetapkan dalam Perjanjian ini. Kecuali yang ditentukan dalam Perjanjian ini, maka <b>Pihak Kedua</b> tidak dapat menuntut fasilitas-fasilitas lainnya dari <b>Pihak Pertama</b> yang tidak diatur dalam Perjanjian ini.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(10,5,"8.3.",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(165,5,"Demikian Perjanjian Kerja ini dibuat dalam rangkap 2 (dua) asli dan ditandatangani oleh Para Pihak tanpa ada paksaan dari pihak manapun dan dalam keadaan sehat rohani maupun jasmani, karena itu mengikat kedua belah pihak untuk dilaksanakan.",0,'J',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        $y=PDF::getY()+10;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Pihak Pertama",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,"Pihak Kedua",0,'C',0,1,'','',true,0,true);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"PT ELANG PRIMA RETAILINDO",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'BU', 10);
        $y=PDF::getY()+20;
        PDF::SetXY($x, $y);
        PDF::MultiCell(50,5,"Sri Dewi",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', 'B', 10);
        PDF::SetXY($x+120, $y);
        PDF::MultiCell(50,5,$contract->name,0,'C',0,1,'','',true,0,true);
        PDF::SetFont('helvetica', 'I', 10);
        PDF::SetXY($x, $y+5);
        PDF::MultiCell(50,5,"Director",0,'L',0,1,'','',true,0,true);

        PDF::SetFont('helvetica', '', 10);
        PDF::SetXY($x, -15);
        PDF::MultiCell(175,5,"Page ".PDF::PageNo()." of ".PDF::getAliasNbPages(),0,'C',0,1,'','',true,0,true);

        PDF::Output("$contract->contract_type.pdf");
    }
}
