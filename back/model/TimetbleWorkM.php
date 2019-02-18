<?php
class TimetableWorkM
{
    public function insertarM(TimetableWork $t)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->Conectar()->prepare("INSERT INTO HAPPYLAND.TIMETABLE_WORK
            (ID_TRABAJO,DIA,HORA_INICIO,MIN_INICIO,CANTIDAD_HORAS,CANTIDAD_MIN,ID_PERSONAL,ID_SEMANAL)
            VALUES (NULL,:DIA,:HORA_INICIO,:MIN_INICIO,:CANTIDAD_HORAS,:CANTIDAD_MIN,:ID_PERSONAL,:ID_SEMANAL)");
            $stmt->bindParam(':DIA', $t->getdias(), PDO::PARAM_INT);
            $stmt->bindParam(':HORA_INICIO', $t->gethora_inicio(), PDO::PARAM_INT);
            $stmt->bindParam(':MIN_INICIO', $t->getmin_inicio(), PDO::PARAM_INT);
            $stmt->bindParam(':CANTIDAD_HORAS', $t->getcantidad_horas(), PDO::PARAM_INT);
            $stmt->bindParam(':CANTIDAD_MIN', $t->getcantidad_min(), PDO::PARAM_INT);
            $stmt->bindParam(':ID_PERSONAL', $t->getpersonal()->getid_personal(), PDO::PARAM_INT);
            $stmt->bindParam(':ID_SEMANAL', $t->getSemanal()->getId_semanal(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
        finally {
            $cn->closeCn();
            $stmt = null;

        }
    }

    public function editarM(TimetableWork $t)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->Conectar()->prepare("UPDATE HAPPYLAND.TIMETABLE_WORK SET DIA=:DIA,HORA_INICIO=:HORA_INICIO,MIN_INICIO=:MIN_INICIO,CANTIDAD_HORAS=:CANTIDAD_HORAS,CANTIDAD_MIN=:CANTIDAD_MIN,ID_PERSONAL,ID_SEMANAL=:ID_PERSONAL WHERE ID_TRABAJO=:ID_TRABAJO");
            $stmt->bindParam(':DIA', $t->getdias(), PDO::PARAM_INT);
            $stmt->bindParam(':HORA_INICIO', $t->gethora_inicio(), PDO::PARAM_INT);
            $stmt->bindParam(':MIN_INICIO', $t->getmin_inicio(), PDO::PARAM_INT);
            $stmt->bindParam(':CANTIDAD_HORAS', $t->getcantidad_horas(), PDO::PARAM_INT);
            $stmt->bindParam(':CANTIDAD_MIN', $t->getcantidad_min(), PDO::PARAM_INT);
            $stmt->bindParam(':ID_PERSONAL', $t->getpersonal()->getid_personal(), PDO::PARAM_INT);
            $stmt->bindParam(':ID_SEMANAL', $t->getSemanal()->getid_semanal(), PDO::PARAM_INT);
            $stmt->bindParam(':ID_TRABAJO', $t->getid_trabajo(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
        finally {
            $cn->closeCn();
            $stmt = null;
        }
    }

    public function eliminarM(TimetableWork $t)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->Conectar()->prepare("DELETE FROM HAPPYLAND.TIMETABLE_WORK WHERE ID_TRABAJO=:ID_TRABAJO");
            $stmt->bindParam(':ID_TRABAJO', $t->getid_trabajo(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
        finally {
            $cn->closeCn();
            $stmt = null;

        }
    }

    public function listarIdSemanalM($id_semanal)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare("SELECT * FROM HAPPYLAND.TIMETABLE_WORK WHERE ID_SEMANAL = :ID_SEMANAL");
            $stmt->bindParam(":ID_SEMANAL",$id_semanal,PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWork;
                $t->setid_trabajo($array[$i]['id_trabajo']);
                $t->setdias($array[$i]['dias']);
                $t->sethora_inicio($array[$i]['hora_inicio']);
                $t->setmin_inicio($array[$i]['min_inicio']);
                $t->setcantidad_horas($array[$i]['cantidad_horas']);
                $t->setcantidad_min($array[$i]['cantidad_min']);
                $personalM = new PersonalM;
                $semanalM = new semanalM;
                $personal = $personalM->getPersonal($array[$i]['id_personal']);
                $semanal = $semanalM->getSemanalM($array[$i]['id_semanal']);
                $t->setpersonal($personal);
                $t->setSemanal($semanal);
                $lista[$i] = $t;
            }
            return $lista;
        } catch (Exception $e) {
            return array();
        }
        finally {
            $cn->closeCn();
            $stmt = null;

        }
    }

    public function listarIdSemanalyDiaM($id_semanal,$dia)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare("SELECT * FROM HAPPYLAND.TIMETABLE_WORK WHERE ID_SEMANAL = :ID_SEMANAL AND DIA =:DIA");
            $stmt->bindParam(":ID_SEMANAL",$id_semanal,PDO::PARAM_INT);
            $stmt->bindParam(":DIA",$dia,PDO::PARAM_STR);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWork;
                $t->setid_trabajo($array[$i]['id_trabajo']);
                $t->setdias($array[$i]['dia']);
                $t->sethora_inicio($array[$i]['hora_inicio']);
                $t->setmin_inicio($array[$i]['min_inicio']);
                $t->setcantidad_horas($array[$i]['cantidad_horas']);
                $t->setcantidad_min($array[$i]['cantidad_min']);
                $personalM = new PersonalM;
                $semanalM = new semanalM;
                $personal = $personalM->getPersonal($array[$i]['id_personal']);
                $semanal = $semanalM->getSemanalM($array[$i]['id_semanal']);
                $t->setpersonal($personal);
                $t->setSemanal($semanal);
                $lista[$i] = $t;
            }
            return $lista;
        } catch (Exception $e) {
            return array();
        }
        finally {
            $cn->closeCn();
            $stmt = null;

        }
    }

    public function listarM()
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare("SELECT * FROM HAPPYLAND.TIMETABLE_WORK");
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWork;
                $t->setid_trabajo($array[$i]['id_trabajo']);
                $t->setdias($array[$i]['dias']);
                $t->sethora_inicio($array[$i]['hora_inicio']);
                $t->setmin_inicio($array[$i]['min_inicio']);
                $t->setcantidad_horas($array[$i]['cantidad_horas']);
                $t->setcantidad_min($array[$i]['cantidad_min']);
                $personalM = new PersonalM;
                $semanalM = new semanalM;
                $personal = $personalM->getPersonal($array[$i]['id_personal']);
                $semanal = $semanalM->getSemanal($array[$i]['id_semanal']);
                $t->setpersonal($personal);
                $t->setSemanal($semanal);
                $lista[$i] = $t;
            }
            return $lista;
        } catch (Exception $e) {
            return array();
        }
        finally {
            $cn->closeCn();
            $stmt = null;

        }
    }

    public function getTrabajo($id_trabajo)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare("SELECT * FROM HAPPYLAND.TIMETABLE_WORK WHERE HAPPYLAND.TIMETABLE_WORK.id_trabajo=:id_trabajo");
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWork;
                $t->setid_trabajo($array[$i]['id_trabajo']);
                $t->setdias($array[$i]['dias']);
                $t->sethora_inicio($array[$i]['hora_inicio']);
                $t->setmin_inicio($array[$i]['min_inicio']);
                $t->setcantidad_horas($array[$i]['cantidad_horas']);
                $t->setcantidad_min($array[$i]['cantidad_min']);
                $personalM = new PersonalM;
                $semanalM = new SemanalM;
                $personal = $personalM->getPersonal($array[$i]['id_personal']);
                $semanal = $semanalM->getSemanal($array[$i]['id_semanal']);
                $t->setpersonal($personal);
                $t->setSemanal($semanal);
                $lista[$i] = $personal;
            }
            return $t;
        } catch (Exception $e) {
            return array();
        }
        finally {
            $cn->closeCn();
            $stmt = null;
        }
    }
}