<?php
class TimetableWeeklyM
{
    public static function createM(TimetableWeekly $t)
    {
        $count = 0;
        /*$query  = 'SELECT COUNT(HAPPYLAND.TIMETABLE_EMPLOYE.IDTIMETABLE_EMPLOYE) AS TOTAL FROM HAPPYLAND.TIMETABLE_EMPLOYE';
        $query .= ' WHERE ';
        $query .= " DNI = '" . $t->getLogin() . "'";

        try {
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }*/

        $capsule = new Capsule();
        $query = "INSERT INTO ";
        $query .= "HAPPYLAND";
        $query .= ".TIMETABLE_WEEKLY(";
        $query .= " DESCRIPCION, DATE, ESTATE, IDMANAGER ";
        $query .= ") VALUES(";
        $query .= " :DESCRIPCION, :DATE, :ESTATE, :IDMANAGER ";
        $query .= ")";
        try {
            $cn = new conexion;
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($query);
                $stmt->bindParam(':DESCRIPCION', $t->getDay(), PDO::PARAM_STR);
                $stmt->bindParam(':DATE', $t->getStart_hour(), PDO::PARAM_STR);
                $stmt->bindParam(':ESTATE', $t->getStart_minute(), PDO::PARAM_STR);
                $stmt->bindParam(':IDMANAGER', $t->getNumber_hours(), PDO::PARAM_STR);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Registro con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario Semanal Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = TimetableEmployeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function updateM(TimetableEmployee $t)
    {
        $count = 0;
        /*$query  = 'SELECT COUNT(HAPPYLAND.TIMETABLE_WEEKLY.IDTIMETABLE_WEEKLY) AS TOTAL FROM HAPPYLAND.TIMETABLE_WEEKLY';
        $query .= ' WHERE ';
        $query .= " LOGIN = '" . $t->getLogin() . "' AND IDTIMETABLE_WEEKLY != " . $t->getIDTIMETABLE_EMPLOYE();
        try {
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }*/

        $capsule = new Capsule();
        $sql = "UPDATE ";
        $sql .= " HAPPYLAND.TIMETABLE_WEEKLY SET ";
        $sql .= " DAY = :DAY, START_HOUR = :START_HOUR, START_MINUTE = :START_MINUTE, NUMBER_HOURS = :NUMBER_HOURS, NUMBER_MINUTES = :NUMBER_MINUTES, ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_WEEKLY = :IDTIMETABLE_WEEKLY";
        try {
            if ($count == 0) {
                $cn = new conexion;
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':DESCRIPCION', $t->getDay(), PDO::PARAM_STR);
                $stmt->bindParam(':DATE', $t->getStart_hour(), PDO::PARAM_STR);
                $stmt->bindParam(':ESTATE', $t->getStart_minute(), PDO::PARAM_STR);
                $stmt->bindParam(':IDMANAGER', $t->getNumber_hours(), PDO::PARAM_STR);
                $stmt->bindParam(':IDTIMETABLE_WEEKLY', $t->getIdtimetable_WEEKLY(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Actualizo con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario Semanal Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = TimetableEmployeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($sql);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $count . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function deleteM(TimetableEmployee $t)
    {
        $count = 0;
        /*$query  = 'SELECT COUNT(E.IDTIMETABLE_EMPLOYE) AS TOTAL FROM ';
        $query .= ' HAPPYLAND.TIMETABLE_EMPLOYE E ';

        $query .= ' FULL JOIN ';
        $query .= ' HAPPYLAND.TIMETABLE_WEEKLY  TW';
        $query .= ' ON E.IDTIMETABLE_EMPLOYE = TE.IDTIMETABLE_EMPLOYE';;

        $query .= ' WHERE ';
        $query .= " TW.IDTIMETABLE_EMPLOYE = " . $t->getIDTIMETABLE_EMPLOYE();
        try {
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }*/
        
        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.TIMETABLE_EMPLOYE ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_EMPLOYE = :IDTIMETABLE_EMPLOYE";
        try {
            if ($count == 0) {
                $cn = new conexion;
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':IDTIMETABLE_WEEKLY', $t->getIdtimetable_WEEKLY(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Elimino con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe una o más acciones asociadas a este Horario Semanal.");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = TimetableEmployeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $e . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function readM($parameters)
    {
        $capsule = new Capsule();
        $count = 0;
        $query = '';
        $query .= 'SELECT COUNT(HAPPYLAND.TIMETABLE_EMPLOYE.IDTIMETABLE_WEEKLY) AS TOTAL FROM HAPPYLAND.TIMETABLE_EMPLOYE';
        
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $count = $array[$i]['total'];
            }
            $capsule->setCounter($count);
        } catch (Exception $e) {
            echo $e;
        } finally {
            $stmt = null;
        }

        $query = '';
        $query .= 'SELECT * FROM HAPPYLAND.TIMETABLE_EMPLOYE';
        $query .= $parameters['orderby'];
        $query .= $parameters['paginate'];
        try {
            $stmt = $cn->conectar()->prepare($query);
            $capsule->setQueryList($stmt);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWeekly($array[$i]['idtimetable weekly']);
                $t->setDescription($array[$i]['description']);
                $t->setDate($array[$i]['date']);
                $t->setEstate($array[$i]['estate']);
                $t->setIdmanager($array[$i]['idmanager']);
                $lista[$i] = $t;
            }
            $capsule->setMessage('ok');
            $capsule->setContent($lista);
            $capsule->setAux($parameters);
        } catch (Exception $e) {
            $capsule->setError(true);
            $capsule->setMessage($e);
            $capsule->setQueryList($stmt);
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
        return $capsule;
    }

}
