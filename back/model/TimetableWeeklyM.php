<?php
class TimetableWeeklyM
{
    public static function createM(TimetableWeekly $t)
    {
        $count = 0;
        $queryEstate = "UPDATE HAPPYLAND.TIMETABLE_WEEKLY SET ESTATE = 'A' WHERE ESTATE = 'V'";
        $capsule = new Capsule();
        $query = "INSERT INTO ";
        $query .= "HAPPYLAND";
        $query .= ".TIMETABLE_WEEKLY(";
        $query .= " DESCRIPTION, DATE, ESTATE, IDMANAGER ";
        $query .= ") VALUES(";
        $query .= " :DESCRIPTION, :DATE, :ESTATE, :IDMANAGER ";
        $query .= ")";
        try {
            $cn = new conexion;
            if ($count == 0) {
                if ($t->getEstate() == 'V') {
                    $stmt = $cn->conectar()->prepare($queryEstate);
                    $stmt->execute();
                }

                $stmt = $cn->conectar()->prepare($query);
                $stmt->bindParam(':DESCRIPTION', $t->getDescription(), PDO::PARAM_STR);
                $stmt->bindParam(':DATE', $t->getDate(), PDO::PARAM_STR);
                $stmt->bindParam(':ESTATE', $t->getEstate(), PDO::PARAM_STR);
                $stmt->bindParam(':IDMANAGER', $t->getIdmanager(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Registro con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario Semanal Con el DNI Ingresado");
            }

            #$parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWeeklyM::readM($parameters);
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

    public static function updateM(TimetableWeekly $t)
    {
        $count = 0;

        $capsule = new Capsule();
        $queryEstate = "UPDATE HAPPYLAND.TIMETABLE_WEEKLY SET ESTATE = 'A' WHERE ESTATE = 'V'";
        $sql = "UPDATE ";
        $sql .= " HAPPYLAND.TIMETABLE_WEEKLY SET ";
        $sql .= " DESCRIPTION = :DESCRIPTION, ESTATE = :ESTATE ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_WEEKLY = :IDTIMETABLE_WEEKLY";
        try {
            if ($count == 0) {
                $cn = new conexion;
                if ($t->getEstate() == 'V') {
                    $stmt = $cn->conectar()->prepare($queryEstate);
                    $stmt->execute();
                }
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':DESCRIPTION', $t->getDescription(), PDO::PARAM_STR);
                //$stmt->bindParam(':DATE', $t->getDate(), PDO::PARAM_STR);
                $stmt->bindParam(':ESTATE', $t->getEstate(), PDO::PARAM_STR);
                $stmt->bindParam(':IDTIMETABLE_WEEKLY', $t->getIdtimetable_WEEKLY(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Actualizo con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario Semanal Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWeeklyM::readM($parameters);
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

    public static function deleteM(TimetableWeekly $t)
    {
        $count = 0;

        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.TIMETABLE_WEEKLY ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_WEEKLY = :IDTIMETABLE_WEEKLY";
        try {
            if ($count == 0) {
                $cn = new conexion;
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':IDTIMETABLE_WEEKLY', $t->getIdtimetable_weekly(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario Semanal se Elimino con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe una o más acciones asociadas a este Horario Semanal.");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWeeklyM::readM($parameters);
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
        $query .= 'SELECT COUNT(HAPPYLAND.TIMETABLE_WEEKLY.IDTIMETABLE_WEEKLY) AS TOTAL FROM HAPPYLAND.TIMETABLE_WEEKLY';
        $query .= ' WHERE ';
        $query .= " (LOWER(DESCRIPTION) LIKE :DESCRIPTION) ";
        $query .= $parameters['estate'];
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->bindParam(':DESCRIPTION', $parameters['filter'], PDO::PARAM_STR);
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
        $query .= 'SELECT * FROM HAPPYLAND.TIMETABLE_WEEKLY';
        $query .= ' WHERE ';
        $query .= " (LOWER(DESCRIPTION) LIKE :DESCRIPTION) ";
        $query .= $parameters['estate'];
        $query .= $parameters['orderby'];
        $query .= $parameters['paginate'];
        try {
            $stmt = $cn->conectar()->prepare($query);
            $capsule->setQueryList($stmt);
            $stmt->bindParam(':DESCRIPTION', $parameters['filter'], PDO::PARAM_STR);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWeekly($array[$i]['idtimetable_weekly']);
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
