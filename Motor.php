<?php
require_once 'Kendaraan.php';

class Motor extends Kendaraan {
    private $cc;

    public function __construct($merk, $harga, $cc) {
        parent::__construct($merk, $harga);
        $this->cc = $cc;
    }

    public function display() {
        parent::display();
        echo "Jumpah cc: ". $this->cc. "<br />";
    }

    public function get_cc() {
        return $this->cc;
    }
}