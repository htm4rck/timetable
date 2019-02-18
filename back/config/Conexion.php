<?php
Class Conexion{
	private $host="localhost";
    private $usuario="postgres";
    private $pass="root";
    private $bd="dbtimetable";

    private $cn;

	public function Conectar(){
		try{
            $this->cn = new PDO('pgsql:host='.$this->host.';port=5432;dbname='.$this->bd,$this->usuario,$this->pass);
            $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->cn;
        }catch(Exception $e){
            die('Error : ' . $e->GetMessage());
            return null;
        }
    }

    public function closeCn(){
        $this->cn= null;
    }
}
/*
$select ="SELECT * FROM HAPPYLAND.EMPLOYEE";
$cn = new Conexion();
$stmt=$cn->Conectar()->prepare($select);
$stmt->execute();
$array=$stmt->fetchAll();
echo(count($array));
*/