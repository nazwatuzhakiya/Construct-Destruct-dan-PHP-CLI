<?php
class Suhu {
    private $celsius;
    public function __construct($celsius) {
        $this->celsius = $celsius;
    }
    public function tampilkanKonversi() {
        echo "suhu dalam celcius = " . $this->celsius . " derajat<br>";
        
        $kelvin = $this->celsius + 273.15;
        echo "suhu dalam kelvin = " . $kelvin . " derajat<br>";

        $fahrenheit = ($this->celsius * 9/5) + 32;
        echo "suhu dalam fahrenheit = " . $fahrenheit . " derajat<br>";

        echo "Sekian konversi suhu yang bisa dilakukan";
    }
}

if (isset($_GET['celsius'])) {
    $suhuAwal = $_GET['celsius'];
    $konverter = new Suhu($suhuAwal);
    $konverter->tampilkanKonversi();
} else {
    echo "Masukkan nilai suhu Celsius di URL, contoh: ?celsius=36";
}
?>