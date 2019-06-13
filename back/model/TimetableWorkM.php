<?php
class TimetableWorkM
{
    public static function createM(TimetableWork $t)
    {
        $count = 0;
        $capsule = new Capsule();
        $query = "INSERT INTO ";
        $query .= "HAPPYLAND";
        $query .= ".TIMETABLE_WORK(";
        $query .= "DAY, START_HOUR, START_MINUTE, NUMBER_HOURS, NUMBER_MINUTES, IDEMPLOYEE, IDTIMETABLE_WEEKLY ";
        $query .= ") VALUES(";
        $query .= ":DAY, :START_HOUR, :START_MINUTE, :NUMBER_HOURS, :NUMBER_MINUTES, :IDEMPLOYEE, :IDTIMETABLE_WEEKLY ";
        $query .= ")";
        try {
            $cn = new conexion;
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($query);
                $stmt->bindParam(':DAY', $t->getDay(), PDO::PARAM_STR);
                $stmt->bindParam(':START_HOUR', $t->getStart_hour(), PDO::PARAM_STR);
                $stmt->bindParam(':START_MINUTE', $t->getStart_minute(), PDO::PARAM_STR);
                $stmt->bindParam(':NUMBER_HOURS', $t->getNumber_hours(), PDO::PARAM_STR);
                $stmt->bindParam(':NUMBER_MINUTES', $t->getNumber_minutes(), PDO::PARAM_STR);
                $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_STR);
                $stmt->bindParam(':IDTIMETABLE_WEEKLY', $t->getIdtimetable_weekly(), PDO::PARAM_STR);
                $stmt->execute();
                $capsule->setMessage('El Horario de Trabajo se Registro con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario de Trabajo Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWorkM::readM($parameters);
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

    public static function updateM(TimetableWork $t)
    {
        $count = 0;
        $capsule = new Capsule();
        $sql = "UPDATE ";
        $sql .= " HAPPYLAND.TIMETABLE_WORK SET ";
        $sql .= " DAY = :DAY, START_HOUR = :START_HOUR, START_MINUTE = :START_MINUTE, NUMBER_HOURS = :NUMBER_HOURS, NUMBER_MINUTES = :NUMBER_MINUTES ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_WORK = :IDTIMETABLE_WORK";
        try {
            if ($count == 0) {
                $cn = new conexion;
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':DAY', $t->getDay(), PDO::PARAM_STR);
                $stmt->bindParam(':START_HOUR', $t->getStart_hour(), PDO::PARAM_STR);
                $stmt->bindParam(':START_MINUTE', $t->getStart_minute(), PDO::PARAM_STR);
                $stmt->bindParam(':NUMBER_HOURS', $t->getNumber_hours(), PDO::PARAM_STR);
                $stmt->bindParam(':NUMBER_MINUTES', $t->getNumber_minutes(), PDO::PARAM_STR);
                $stmt->bindParam(':IDTIMETABLE_WORK', $t->getIdtimetable_work(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario de Trabajo se Actualizo con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Horario de Trabajo Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWorkM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($sql);
            return $capsule->getResponse();
        } catch (Exception $e) {
            #return '{"error":' . $e . '}';
            return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function deleteM(TimetableWork $t)
    {
        $count = 0;
        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.TIMETABLE_WORK ";
        $sql .= " WHERE ";
        $sql .= " IDTIMETABLE_WORK = :IDTIMETABLE_WORK";
        try {
            if ($count == 0) {
                $cn = new conexion;
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':IDTIMETABLE_WORK', $t->getIdtimetable_work(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Horario de Trabajo se Elimino con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe una o más acciones asociadas a este Horario de Trabajo.");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ';
            $read = TimetableWorkM::readM($parameters);
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
        $query .= 'SELECT COUNT(IDTIMETABLE_WORK) AS TOTAL FROM HAPPYLAND.TIMETABLE_WORK';
        $query .= ' WHERE IDTIMETABLE_WEEKLY = ';
        $query .= $parameters['idtimetable_weekly'];

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
        $query .= 'SELECT * FROM HAPPYLAND.TIMETABLE_WORK';
        $query .= ' WHERE IDTIMETABLE_WEEKLY = ';
        $query .= $parameters['idtimetable_weekly'];
        $query .= $parameters['orderby'];
        $query .= $parameters['paginate'];
        try {
            $stmt = $cn->conectar()->prepare($query);
            $capsule->setQueryList($stmt);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new TimetableWork($array[$i]['idtimetable_work']);
                $t->setDay($array[$i]['day']);
                $t->setStart_hour($array[$i]['start_hour']);
                $t->setStart_minute($array[$i]['start_minute']);
                $t->setNumber_hours($array[$i]['number_hours']);
                $t->setNumber_minutes($array[$i]['number_minutes']);
                $t->setNumber_minutes($array[$i]['number_minutes']);
                $t->setIdemployee($array[$i]['idemployee']);
                $t->setIdtimetable_weekly($array[$i]['idtimetable_weekly']);
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
