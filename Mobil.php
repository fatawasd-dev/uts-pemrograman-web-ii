<?php
require_once 'Kendaraan.php';

class Mobil extends Kendaraan {
    private $jumlahPintu;

    public function __construct($merk, $harga, $jumlahPintu) {
        parent::__construct($merk, $harga);
        $this->jumlahPintu = $jumlahPintu;
    }

    public function display() {
        parent::display();
        echo "Jumpah Pintu: ". $this->jumlahPintu. "<br />";
    }

    public function get_jumlah_pintu() {
        return $this->jumlahPintu;
    }
}