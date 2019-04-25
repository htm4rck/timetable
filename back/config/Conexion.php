<?php
class Conexion
{
    #private $host = "localhost";
    #private $usuario = "postgres";
    #private $pass = "root";
    #private $bd = "timetable";
    private $host = "ec2-54-204-2-25.compute-1.amazonaws.com";
    private $usuario = "dludvwpnxfoqud";
    private $pass = "d66a8140338af78307279d60255e0138f5895f1d7f32893cd2aa2d3985ab8f95";
    private $bd = "d31n7sqn0k8u5j";

    private $cn;

    public function Conectar()
    {
        try {
            $this->cn = new PDO('pgsql:host=' . $this->host . ';port=5432;dbname=' . $this->bd, $this->usuario, $this->pass);
            $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->cn;
        } catch (Exception $e) {
            die('Error : ' . $e->GetMessage());
            return null;
        }
    }

    public function closeCn()
    {
        $this->cn = null;
    }
}








