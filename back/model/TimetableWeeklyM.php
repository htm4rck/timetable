<?php
class SemanalM{

    public function insertarM(SemanalB $semanal ){
        try{
        $cn= new Conexion;
        $stmt=$cn->Conectar()->prepare("INSERT INTO horario_semanal (id_semanal,descripcion,fecha,fecha_inicio,id_administrador) VALUES (null,:descripcion,:fecha,:fecha_inicio,:id_administrador)");
        $stmt->bindParam(':descripcion',$semanal->getDescripcion(),PDO::PARAM_STR);
        $stmt->bindParam(':fecha',$semanal->getFecha(),PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio',$semanal->getFecha_inicio(),PDO::PARAM_STR);
        $stmt->bindParam(':id_administrador',$semanal->getAdministrador()->getid_administrador(),PDO::PARAM_INT);
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }

    public function editarM(SemanalB $semanal){
        try{
        $cn=new Conexion;
        echo $semanal->getAdministrador()->getId_Administrador();
        $stmt=$cn->Conectar()->prepare("UPDATE horario_semanal SET descripcion=:descripcion,fecha=:fecha,fecha_inicio=:fecha_inicio,id_administrador=:id_administrador WHERE id_semanal=:id_semanal");
        $stmt->bindParam(':descripcion',$semanal->getDescripcion(),PDO::PARAM_STR);
        $stmt->bindParam(':fecha',$semanal->getFecha(),PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio',$semanal->getFecha_inicio(),PDO::PARAM_STR);
        $stmt->bindParam(':id_administrador',$semanal->getAdministrador()->getId_Administrador(),PDO::PARAM_INT);
        $stmt->bindParam(':id_semanal',$semanal->getId_semanal(),PDO::PARAM_STR);
        $cn->closeCn();
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }

    public function eliminarM($id_semanal){
        try{
            $cn = new Conexion;
            $stmt = $cn->Conectar()->prepare("DELETE FROM horario_semanal WHERE id_semanal=:id_semanal");
            $stmt->bindParam(':id_semanal', $id_semanal, PDO::PARAM_INT);
            $stmt->execute();
            return true;
            }catch(Exception $e){
                return false;
            }finally{
                $cn->closeCn();
                $stmt=null;
            }
    }

    public function listarM(){
        try{
        $cn=new Conexion;
        $stmt=$cn->Conectar()->prepare("SELECT * FROM horario_semanal");
        $stmt->execute();
        $array = $stmt->fetchAll();
        $lista = array();
        for ($i = 0; $i < count($array); $i++) {
            $semanal = new SemanalB;
            $semanal->setId_semanal($array[$i]['id_semanal']);
            $semanal->setDescripcion($array[$i]['descripcion']);
            $semanal->setFecha($array[$i]['fecha']);
            $semanal->setFecha_inicio($array[$i]['fecha_inicio']);
            $administradorM = new AdministradorM;
            $administrador = $administradorM->getAdministradorM($array[$i]['id_administrador']);
            $semanal->setAdministrador($administrador);
            $lista[$i] = $semanal;
        }
        return $lista;
        }catch(Exception $e){
            return array();
        }finally{
            $cn->closeCn();
            $stmt=null;
        }
    }

    public function listarPorAdmM($id_administrador){
        try{
        $cn=new Conexion;
        $stmt=$cn->Conectar()->prepare("SELECT * FROM horario_semanal WHERE id_administrador = :id_administrador");
        $stmt->bindParam(':id_administrador', $id_administrador, PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $lista = array();
        for ($i = 0; $i < count($array); $i++) {
            $semanal = new SemanalB;
            $semanal->setId_semanal($array[$i]['id_semanal']);
            $semanal->setDescripcion($array[$i]['descripcion']);
            $semanal->setFecha($array[$i]['fecha']);
            $semanal->setFecha_inicio($array[$i]['fecha_inicio']);
            $administradorM = new AdministradorM;
            $administrador = $administradorM->getAdministradorM($array[$i]['id_administrador']);
            $semanal->setAdministrador($administrador);
            $lista[$i] = $semanal;
        }
        return $lista;
        }catch(Exception $e){
            return array();
        }finally{
            $cn->closeCn();
            $stmt=null;
        }
    }

    public function getSemanalM($id_semanal){
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM horario_semanal WHERE horario_semanal.id_semanal = :id_semanal");
        $stmt->bindParam(':id_semanal', $id_semanal, PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $semanal = new SemanalB;
        for ($i = 0; $i < count($array); $i++) {
            $semanal->setId_semanal($array[$i]['id_semanal']);
            $semanal->setDescripcion($array[$i]['descripcion']);
            $semanal->setFecha($array[$i]['fecha']);
            $semanal->setFecha_inicio($array[$i]['fecha_inicio']);
            $administrador = AdministradorM::getAdministradorM($array[$i]['id_administrador']);
            $semanal->setAdministrador($administrador);
        }
         return $semanal;
        }catch(Exception $e){
            return new SemanalB;
        }finally{
            $cn->closeCn();
            $stmt=null;
        }
    }

}