<?php
class PropioM
{
    public function insertarM(PropioB $propio)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->Conectar()->prepare("INSERT INTO horario_propio (ID_PROPIO,DIA,HORA_INICIO,MIN_INICIO,CANTIDAD_HORA,CANTIDAD_MIN,ID_PERSONAL) VALUES (NULL,:DIA,:HORA_INICIO,:MIN_INICIO,:CANTIDAD_HORA,:CANTIDAD_MIN,:ID_PERSONAL)");
        $stmt->bindParam(':DIA', $propio->getdia(), PDO::PARAM_STR);
        $stmt->bindParam(':HORA_INICIO', $propio->gethora_inicio(), PDO::PARAM_INT);
        $stmt->bindParam(':MIN_INICIO', $propio->getmin_inicio(), PDO::PARAM_INT);
        $stmt->bindParam(':CANTIDAD_HORA', $propio->getcantidad_hora(), PDO::PARAM_INT);
        $stmt->bindParam(':CANTIDAD_MIN', $propio->getcantidad_min(), PDO::PARAM_INT);
        $stmt->bindParam(':ID_PERSONAL', $propio->getpersonal()->getid_personal(), PDO::PARAM_INT);
        return $stmt->execute();
    }catch(Exception $e){
        echo $e;
    }finally{
        $stmt=null;
        $cn->closeCn();
    }
    }

    public function editarM(PropioB $propio)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->Conectar()->prepare("UPDATE horario_propio SET DIA=:DIA,HORA_INICIO=:HORA_INICIO,MIN_INICIO=:MIN_INICIO,CANTIDAD_HORA=:CANTIDAD_HORA,CANTIDAD_MIN=:CANTIDAD_MIN,ID_PERSONAL=:ID_PERSONAL WHERE ID_PROPIO=:ID_PROPIO");
        $stmt->bindParam(':DIA', $propio->getdia(), PDO::PARAM_STR);
        $stmt->bindParam(':HORA_INICIO', $propio->gethora_inicio(), PDO::PARAM_INT);
        $stmt->bindParam(':MIN_INICIO', $propio->getmin_inicio(), PDO::PARAM_INT);
        $stmt->bindParam(':CANTIDAD_HORA', $propio->getcantidad_hora(), PDO::PARAM_INT);
        $stmt->bindParam(':CANTIDAD_MIN', $propio->getcantidad_min(), PDO::PARAM_INT);
        $stmt->bindParam(':ID_PERSONAL', $propio->getpersonal()->getid_personal(), PDO::PARAM_INT);
        $stmt->bindParam(':ID_PROPIO', $propio->getid_propio(), PDO::PARAM_INT);
        $cn->closeCn();
        return $stmt->execute();
        }catch(Exception $e){
            echo $e;
        }finally{
            $stmt=null;
            $cn->closeCn();
        }

    }

    public function eliminarM($idpropio)
    {
        
        try{
        $cn = new Conexion;
        $stmt = $cn->Conectar()->prepare("DELETE FROM horario_propio WHERE ID_PROPIO=:ID_PROPIO");
        $stmt->bindParam(':ID_PROPIO', $idpropio, PDO::PARAM_INT);
        $stmt->execute();
        return true;
        }catch(Exception $e){
            return false;

        }finally{
            $cn->closeCn();
            $stmt=null;
        }
    }

    public function listarM()
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM horario_propio");
        $stmt->execute();
        $array = $stmt->fetchAll();
        $lista = array();
        for ($i = 0; $i < count($array); $i++) {
            $propio = new PropioB;
            $propio->setid_propio($array[$i]['id_propio']);
            $propio->setdia($array[$i]['dia']);
            $propio->sethora_inicio($array[$i]['hora_inicio']);
            $propio->setmin_inicio($array[$i]['min_inicio']);
            $propio->setcantidad_hora($array[$i]['cantidad_hora']);
            $propio->setcantidad_min($array[$i]['cantidad_min']);
            $personalM = new PersonalM;
            $personal = $personalM->getPersonal($array[$i]['id_personal']);
            $propio->setpersonal($personal);
            $lista[$i] = $propio;
        }
        return $lista;
        }catch(Exception $e){
        return array();
        }finally{
        $stmt=null;
        $cn->closeCn();
        }
    }
    public function listarPorIdM($id_personal)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM horario_propio WHERE id_personal=:id_personal");
        $stmt->bindParam(":id_personal",$id_personal,PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $lista = array();
        for ($i = 0; $i < count($array); $i++) {
            $propio = new PropioB;
            $propio->setid_propio($array[$i]['id_propio']);
            $propio->setdia($array[$i]['dia']);
            $propio->sethora_inicio($array[$i]['hora_inicio']);
            $propio->setmin_inicio($array[$i]['min_inicio']);
            $propio->setcantidad_hora($array[$i]['cantidad_hora']);
            $propio->setcantidad_min($array[$i]['cantidad_min']);
            $personalM = new PersonalM;
            $personal = $personalM->getPersonal($array[$i]['id_personal']);
            $propio->setpersonal($personal);
            $lista[$i] = $propio;
        }
        return $lista;
        }catch(Exception $e){
        return array();
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
    }

    public function listaPordia($dia, $id_administrador)
    {
        try{

            $cn=new Conexion;
            $stmt=$cn->Conectar()->prepare("SELECT 
                                            HP.id_propio, HP.dia, HP.hora_inicio, HP.min_inicio, HP.cantidad_hora, HP.cantidad_min, P.id_personal
                                            FROM
                                            horario_propio HP 
                                            INNER JOIN personal P ON HP.id_personal = P.id_personal
                                            INNER JOIN administrador A ON  P.id_administrador = A.id_administrador
                                            WHERE dia=:dia AND A.id_administrador=:id_administrador
                                            ORDER BY cantidad_hora desc");
            $stmt->bindParam(":dia", $dia, PDO::PARAM_STR);
            $stmt->bindParam(":id_administrador", $id_administrador, PDO::PARAM_INT);
            $stmt->execute();
            $array=$stmt->fetchAll();
            $lista=array();

            for($i=0;$i<count($array);$i++){
                $propio = new PropioB;
                $propio->setid_propio($array[$i]['id_propio']);
                $propio->setdia($array[$i]['dia']);
                $propio->sethora_inicio($array[$i]['hora_inicio']);
                $propio->setmin_inicio($array[$i]['min_inicio']);
                $propio->setcantidad_hora($array[$i]['cantidad_hora']);
                $propio->setcantidad_min($array[$i]['cantidad_min']);
                $personalM = new PersonalM;
                $personal = $personalM->getPersonal($array[$i]['id_personal']);
                $propio->setpersonal($personal);
                $lista[$i] = $propio;
            }
            return $lista;
            }catch(Exception $e){
                echo $e;
                return $lista;
            }finally{
                $stmt=null;
                $cn->closeCn();
            }

    }


    public function getPropio(int $id_propio)
    {
        try{
        $cn = new Conexion;
        $stmt = $cn->conectar()->prepare("SELECT * FROM propio WHERE propio.id_propio=:id_propio");
        $stmt->bindParam(':id_propio', $id_propio, PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        for ($i = 0; $i < count($array); $i++) {
            $propio = new PropioB;
            $propio->setid_propio($array[$i]['id_propio']);
            $propio->setdia($array[$i]['dia']);
            $propio->sethora_inicio($array[$i]['hora_inicio']);
            $propio->setmin_inicio($array[$i]['min_inicio']);
            $propio->setcantidad_hora($array[$i]['cantidad_hora']);
            $propio->setcantidad_min($array[$i]['cantidad_min']);
            $personalM = new PersonalM;
            $personal = $personalM->getPersonal($array[$i]['id_personal']);
            $propio->setpersonal($personal);
        }
        return $propio;
        }catch(Exception $e){
            $stmt=null;
            $cn->closeCn();
        }finally{
            $stmt=null;
            $cn->closeCn();
        }
        
    }
}
