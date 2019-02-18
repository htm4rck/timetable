<?php
class AdministradorM
{

    public function insertarM(AdministradorB $administrador)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("INSERT INTO administrador (id_administrador,login,pass,nombre,paterno,materno,alta,id_negocio) VALUES (null,:login,:pass,:nombre,:paterno,:materno,:alta,:id_negocio)");
        $stmt->bindParam(':login', $administrador->getlogin(), PDO::PARAM_STR);
        $stmt->bindParam(':pass', $administrador->getpass(), PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $administrador->getnombre(), PDO::PARAM_STR);
        $stmt->bindParam(':paterno', $administrador->getpaterno(), PDO::PARAM_STR);
        $stmt->bindParam(':materno', $administrador->getmaterno(), PDO::PARAM_STR);
        $stmt->bindParam(':alta', $administrador->getAlta(), PDO::PARAM_STR);
        $stmt->bindParam(':id_negocio', $administrador->getnegocio()->getid_negocio(), PDO::PARAM_INT);
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }

    public function editarM(AdministradorB $administrador)
    {
        try{
            echo $administrador->getNegocio()->getId_negocio();
        $cn = new Conexion;
        $stmt = $cn->Conectar()->prepare("UPDATE administrador SET login=:login,pass=:pass,nombre=:nombre,paterno=:paterno,materno=:materno,id_negocio=:id_negocio WHERE id_administrador=:id_administrador");
        $stmt->bindParam(':login', $administrador->getlogin(), PDO::PARAM_STR);
        $stmt->bindParam(':pass', $administrador->getpass(), PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $administrador->getnombre(), PDO::PARAM_STR);
        $stmt->bindParam(':paterno', $administrador->getpaterno(), PDO::PARAM_STR);
        $stmt->bindParam(':materno', $administrador->getmaterno(), PDO::PARAM_STR);
        $stmt->bindParam('id_negocio', $administrador->getNegocio()->getId_negocio(), PDO::PARAM_INT);
        $stmt->bindParam(':id_administrador', $administrador->getid_administrador(), PDO::PARAM_INT);
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }
    public function eliminarM(AdministradorB $administrador)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->Conectar()->prepare("DELETE FROM administrador WHERE id_administrador=:id_administrador");
        $stmt->bindParam(':id_administrador', $administrador->getid_administrador(), PDO::PARAM_INT);
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }

    public function listarM()
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM administrador");
        $stmt->execute();
        $array = $stmt->fetchAll();
        $lista = array();
        for ($i = 0; $i < count($array); $i++) {
            $administrador = new AdministradorB;
            $administrador->setid_administrador($array[$i]['id_administrador']);
            $administrador->setlogin($array[$i]['login']);
            $administrador->setpass($array[$i]['pass']);
            $administrador->setnombre($array[$i]['nombre']);
            $administrador->setpaterno($array[$i]['paterno']);
            $administrador->setmaterno($array[$i]['materno']);
            $administrador->setAlta($array[$i]['alta']);
            $negocioM = new NegocioM();
            $negocio = new NegocioB;
            $negocio = $negocioM->getNegocioM($array[$i]['id_negocio']);
            $administrador->setnegocio($negocio);
            $lista[$i] = $administrador;
        }
        return $lista;
        }catch(Exception $e){
            return array();
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
      
        
        
    }

    public function getAdministradorM($id_administrador)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM administrador WHERE administrador.id_administrador = :id_administrador");
        $stmt->bindParam(':id_administrador', $id_administrador, PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $administrador = new AdministradorB;
        for ($i = 0; $i < count($array); $i++) {
            $administrador->setid_administrador($array[$i]['id_administrador']);
            $administrador->setlogin($array[$i]['login']);
            $administrador->setpass($array[$i]['pass']);
            $administrador->setnombre($array[$i]['nombre']);
            $administrador->setpaterno($array[$i]['paterno']);
            $administrador->setmaterno($array[$i]['materno']);
            $negocioM = new NegocioM();
            $negocio = $negocioM->getNegocioM($array[$i]['id_negocio']);
            $administrador->setnegocio($negocio);
        }
        return $administrador;
        }catch(Exception $e){
            return array();
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
       
        
    }

    ############################### LOGEO ADMINISTRADOR ###############################
    ###################################################################################
    public function logeoM(AdministradorB $administrador)
    {
        try{
        $cn = new Conexion();
        $stmt = $cn->conectar()->prepare("SELECT * FROM administrador WHERE LOGIN = :LOGIN");
        $stmt->bindParam(":LOGIN", $administrador->getlogin(), PDO::PARAM_STR);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $administrador = new AdministradorB;
        for ($i = 0; $i < count($array); $i++) {
            $administrador->setid_administrador($array[$i]['id_administrador']);
            $administrador->setlogin($array[$i]['login']);
            $administrador->setpass($array[$i]['pass']);
            $administrador->setnombre($array[$i]['nombre']);
            $administrador->setpaterno($array[$i]['paterno']);
            $administrador->setmaterno($array[$i]['materno']);
            $negocioM = new NegocioM();
            $negocio = $negocioM->getNegocioM($array[$i]['id_negocio']);
            $administrador->setnegocio($negocio);
        }
        return $administrador;
    }catch(Exception $e){
        return array();
    }finally{
        $stmt=null;
        $cn->closeCn();
    }  

    }

}