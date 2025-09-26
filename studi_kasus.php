<?php
class Karyawan {
    private $nama;
    private $golongan;
    private $totalJamLembur;
    private $gajiPokok;
    private $gajiGolongan = [
        "Ia" => 1250000, "Ib" => 1250000, "Ic" => 1300000, "Id" => 1350000,
        "IIa" => 2000000, "IIb" => 2100000, "IIc" => 2200000, "IId" => 2300000,
        "IIIa" => 2400000, "IIIb" => 2500000, "IIIc" => 2600000, "IIId" => 2700000,
        "IVa" => 2800000, "IVb" => 2900000, "IVc" => 3000000, "IVd" => 3100000
    ];
    private const TARIF_LEMBUR = 15000;

    public function __construct($nama, $golongan, $totalJamLembur) {
        $this->nama = $nama;
        $this->golongan = $golongan;
        $this->totalJamLembur = $totalJamLembur;
        $this->gajiPokok = $this->gajiGolongan[$this->golongan] ?? 0;
    }

    public function __destruct() {
        echo "\nObjek {$this->nama} telah dihapus dari memori.\n";
    }

    public function getNama() {
        return $this->nama;
    }
    
    public function getGolongan() {
        return $this->golongan;
    }
    
    public function getTotalJamLembur() {
        return $this->totalJamLembur;
    }

    public function getGajiPokok() {
        return $this->gajiPokok;
    }

    public function hitungTotalGaji() {
        $gajiLembur = $this->totalJamLembur * self::TARIF_LEMBUR;
        return $this->gajiPokok + $gajiLembur;
    }
}

if (php_sapi_name() == 'cli') {
    echo "Masukkan data karyawan (Nama, Golongan, Jam Lembur) dipisahkan koma:\n";
    echo "Contoh: Winny,IIb,30\n";
    echo "Tekan Enter kosong untuk selesai.\n\n";

    $daftarKaryawan = [];
    $input_handle = fopen("php://stdin", "r");

    while (true) {
        echo "Input: ";
        $line = trim(fgets($input_handle));
        
        if (empty($line)) {
            break;
        }

        $data = explode(',', $line);
        if (count($data) == 3) {
            $nama = trim($data[0]);
            $golongan = trim($data[1]);
            $jamLembur = (int) trim($data[2]);
            $daftarKaryawan[] = new Karyawan($nama, $golongan, $jamLembur);
        } else {
            echo "Format input salah. Silakan coba lagi.\n";
        }
    }
    
    fclose($input_handle);

    echo "\n----------------------------------------------------\n";
    echo "Nama Karyawan | Golongan | Total Jam Lembur | Total Gaji\n";
    echo "----------------------------------------------------\n";

    foreach ($daftarKaryawan as $karyawan) {
        echo str_pad($karyawan->getNama(), 14) . " | ";
        echo str_pad($karyawan->getGolongan(), 9) . " | ";
        echo str_pad($karyawan->getTotalJamLembur(), 17) . " | ";
        echo number_format($karyawan->hitungTotalGaji(), 0, ',', '.') . "\n";
    }

    echo "----------------------------------------------------\n";

} else {
    echo "Skrip ini dirancang untuk dijalankan melalui PHP CLI.";
}
?>