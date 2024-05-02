<?php

class Kendaraan {
    private $merk;
    private $harga;

    public function __construct($merk, $harga) {
        $this->merk = $merk;
        $this->harga = $harga;
    }

    public function __destruct() {
    }

    public function get_merk() {
        return $this->merk;
    }

    public function get_harga() {
        return "Rp ".number_format($this->harga, 2);
    }

    public function set_merk($merk) {
        $this->merk = $merk;
    }

    public function set_harga($harga) {
        $this->harga = $harga;
    }

    public function display() {
        echo "Merk: ". $this->get_merk(). "<br />";
        echo "Harga: ". $this->get_harga(). "<br />";
    }
}