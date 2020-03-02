<?php 
namespace App\Http\Helper;

class Myhelper{

    public function timestamp_ID($value = ""){
        $time_s     = explode(" ", $value);
        $date       = $time_s[0];
        $time       = $time_s[1];

        $date_id    = explode("-", $date);
        $bulan      = $this->getMonth((int)$date_id[1]);
        return $date_id[2]." ".$bulan." ".$date_id[0]." / ".$time;
    }

    public function getMonth($bln){
        switch($bln){
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}
?>