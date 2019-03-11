<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sk;
use Terbilang;
use App;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;

class PrintController extends Controller
{
    
    public function do_print($type, $id)
    {
        setLocale(LC_TIME, 'id_ID.utf8');
        App::setLocale('id');
        return $this->{$type}($id);
    }

    public function sk($id){
        $sk = Sk::findOrFail($id);
        $jenis_sk = Str::slug($sk->jenis_surat);
        $company = Str::slug(Str::studly($sk->employee->position->company));
        return $this->{$company."_".$jenis_sk}($sk);
    }

    public function ptomniintivision_mutasi($sk){
        $x = 20;
        $y = 30;
        PDF::SetTitle('Print '.$sk->jenis_surat);
        PDF::SetAutoPageBreak(true);
       
        PDF::AddPage();
        
        PDF::SetFont('helvetica', '', 10);
        PDF::SetXY($x, $y);
        PDF::MultiCell(50, 5, "Kepada Yth.",0,'L');
        $y = PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(50, 5, "Sdr. ".$sk->employee->nama,0,'L');
        $y = PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(50, 5, "EM : ".$sk->employee->nik,0,'L');
        $y = PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(50, 5, "Di tempat",0,'L');


        $y = PDF::getY()+5;
        PDF::SetFont('helvetica', 'BU', 14);
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"SURAT KEPUTUSAN",0,'C');

        PDF::SetFont('helvetica', '', 12);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"No. ".$sk->no_surat,0,'C');
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Tentang",0,'C');
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(170,5,"Mutasi Jabatan",0,'C');


        PDF::SetFont('helvetica', '', 10);
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(20,5,"Mengingat",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"1. ",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Optimalisasi sumber daya manusia yang ada dalam hirarki organisasi ".$sk->employee->position->company.".",0,'J',0,1,'','',true,0,true);
        
        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"2. ",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Kebutuhan Operasional Departemen ".$sk->employee->position->department->name.", Divisi ".$sk->employee->position->division->name.",  ".$sk->employee->position->company.".",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+40, $y);
        PDF::MultiCell(20,5,"3. ",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+50, $y);
        PDF::MultiCell(110,5,"Dibutuhkannya Surat Keputusan dalam rangka Mutasi Jabatan pada ".$sk->employee->position->company." demi terselenggaranya tertib administrasi.",0,'J',0,1,'','',true,0,true);
       
        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(25,5,"Menimbang",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+20, $y);
        PDF::MultiCell(20,5,":",0,'L',0,1,'','',true,0,true);

        PDF::SetXY($x+40, $y);
        PDF::MultiCell(120,5,"Usulan Mutasi No. ".$sk->ref_no,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Dengan ini perusahaan memutuskan dan menetapkan bahwa :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Terhitung mulai tanggal <b>".$sk->start_date->formatLocalized("%d %B %Y")."</b>, Saudara dimutasikan sebagai <b>".$sk->employee->position->name."</b> di Departemen ".$sk->employee->position->department->name.", Divisi ".$sk->employee->position->division->name.", ".$sk->employee->position->company.", dengan menjalani masa percobaan sampai dengan tanggal <b>".$sk->end_date->formatLocalized("%d %B %Y")."</b>.",0,'J',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Selama Masa Percobaan, kinerja Saudara akan dievaluasi. Hasil evaluasi kinerja Saudara akan diputuskan pada akhir Masa Percobaan, yaitu dapat berupa :",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(150,5,"a. Ditetapkan sebagai ".$sk->employee->position->name."; atau",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(150,5,"b. Diperpanjang Masa Percobaan; atau",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x+10, $y);
        PDF::MultiCell(150,5,"c. Kembali ke jabatan semula.",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Mengenai tugas & tanggung jawab Saudara, akan diberikan pengarahan oleh ".$sk->employee->position->parent->name.".",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Demikian Surat Keputusan ini dibuat sekaligus sebagai ketetapan yang berlaku sejak tanggal diterbitkannya.",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Ditetapkan di",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+30, $y);
        PDF::MultiCell(150,5,": Jakarta",0,'L',0,1,'','',true,0,true);

        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Pada Tanggal",0,'L',0,1,'','',true,0,true);
        PDF::SetXY($x+30, $y);
        PDF::MultiCell(150,5,": ".$sk->start_date->formatLocalized('%d %B %Y'),0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+5;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"Atas Nama ".$sk->employee->position->company,0,'L',0,1,'','',true,0,true);

        $y=PDF::getY()+25;
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"<u>Andriane Tjepaka Dewi</u>",0,'L',0,1,'','',true,0,true);
        $y=PDF::getY();
        PDF::SetXY($x, $y);
        PDF::MultiCell(150,5,"HRGA Division Head",0,'L',0,1,'','',true,0,true);

        PDF::Output("$sk->jenis_surat.pdf");
    }

}
