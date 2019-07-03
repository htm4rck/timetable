<?php
class EmployeeM
{

    public static function createM(Employee $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.EMPLOYEE.IDEMPLOYEE) AS TOTAL FROM HAPPYLAND.EMPLOYEE';
        $query .= ' WHERE ';
        $query .= " DNI = '" . $t->getDni() . "'";

        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }

        $capsule = new Capsule();
        $query = "INSERT INTO ";
        $query .= "HAPPYLAND";
        $query .= ".EMPLOYEE(";
        $query .= "PATERNAL, MATERNAL, NAMES, LOGIN, PASS,";
        $query .= "WEEKLY_HOURS, EXTRA_HOURS, EXTRA_MINUTES, GENDER, DNI,";
        $query .= "MOBILE";
        $query .= ") VALUES(";
        $query .= ":PATERNAL, :MATERNAL, :NAMES, :LOGIN, :PASS,";
        $query .= ":WEEKLY_HOURS, :EXTRA_HOURS, :EXTRA_MINUTES, :GENDER, :DNI, ";
        $query .= ":MOBILE";
        $query .= ")";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($query);
                $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
                $stmt->bindParam(':LOGIN', $t->getDni(), PDO::PARAM_STR);
                $stmt->bindParam(':PASS', crypt($t->getDni(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->bindParam(':WEEKLY_HOURS', $t->getWeekly_hours(), PDO::PARAM_INT);
                $stmt->bindParam(':EXTRA_HOURS', $t->getExtra_hours(), PDO::PARAM_INT);
                $stmt->bindParam(':EXTRA_MINUTES', $t->getExtra_minutes(), PDO::PARAM_INT);
                $stmt->bindParam(':GENDER', $t->getGender(), PDO::PARAM_STR);
                $stmt->bindParam(':DNI', $t->getDni(), PDO::PARAM_STR);
                $stmt->bindParam(':MOBILE', $t->getMobile(), PDO::PARAM_STR);
                $stmt->execute();
                $capsule->setMessage('El Empleado se Registro con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Empleado Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
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

    public static function updateM(Employee $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.EMPLOYEE.IDEMPLOYEE) AS TOTAL FROM HAPPYLAND.EMPLOYEE';
        $query .= ' WHERE ';
        $query .= " DNI = '" . $t->getDni() . "' AND IDEMPLOYEE != " . $t->getIdemployee();
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }

        $capsule = new Capsule();
        $sql = "UPDATE ";
        $sql .= "HAPPYLAND";
        $sql .= ".EMPLOYEE SET ";
        $sql .= "PATERNAL = :PATERNAL, MATERNAL = :MATERNAL, NAMES = :NAMES, LOGIN = :LOGIN, PASS = :PASS, ";
        $sql .= "WEEKLY_HOURS = :WEEKLY_HOURS, EXTRA_HOURS = :EXTRA_HOURS, EXTRA_MINUTES = :EXTRA_MINUTES, GENDER = :GENDER, DNI = :DNI, ";
        $sql .= "MOBILE = :MOBILE";
        $sql .= " WHERE ";
        $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
                $stmt->bindParam(':LOGIN', $t->getDni(), PDO::PARAM_STR);
                $stmt->bindParam(':PASS', crypt($t->getDni(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->bindParam(':WEEKLY_HOURS', $t->getWeekly_hours(), PDO::PARAM_INT);
                $stmt->bindParam(':EXTRA_HOURS', $t->getExtra_hours(), PDO::PARAM_INT);
                $stmt->bindParam(':EXTRA_MINUTES', $t->getExtra_minutes(), PDO::PARAM_INT);
                $stmt->bindParam(':GENDER', $t->getGender(), PDO::PARAM_STR);
                $stmt->bindParam(':DNI', $t->getDni(), PDO::PARAM_STR);
                $stmt->bindParam(':MOBILE', $t->getMobile(), PDO::PARAM_STR);
                $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Empleado se Actualizo con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Empleado Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $count . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function changePassM(Employee $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.EMPLOYEE.IDEMPLOYEE) AS TOTAL FROM HAPPYLAND.EMPLOYEE';
        $query .= ' WHERE ';
        $query .= " DNI = '" . $t->getDni() . "' AND IDEMPLOYEE != " . $t->getIdemployee();
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }

        $capsule = new Capsule();
        $sql = "UPDATE ";
        $sql .= "HAPPYLAND";
        $sql .= ".EMPLOYEE SET ";
        $sql .= "PASS = :PASS";
        $sql .= " WHERE ";
        $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':PASS', crypt($t->getPass(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('La Contraseña se Modifico con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Error en el Cambio de Contraseña");
            }

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $e . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function deleteM(Employee $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(E.IDEMPLOYEE) AS TOTAL FROM ';
        $query .= ' HAPPYLAND.EMPLOYEE E ';

        $query .= ' FULL JOIN ';
        $query .= ' HAPPYLAND.TIMETABLE_EMPLOYEE  TE';
        $query .= ' ON E.IDEMPLOYEE = TE.IDEMPLOYEE';

        $query .= ' FULL JOIN ';
        $query .= ' HAPPYLAND.TIMETABLE_WORK  TW';
        $query .= ' ON E.IDEMPLOYEE = TW.IDEMPLOYEE';

        $query .= ' WHERE ';
        $query .= " TE.IDEMPLOYEE = " . $t->getIdemployee();
        $query .= " OR TW.IDEMPLOYEE = " . $t->getIdemployee();
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return $e;
        } finally {
            $stmt = null;
        }

        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.EMPLOYEE ";
        $sql .= " WHERE ";
        $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Empleado se Elimino con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe una o más acciones asociadas a este Empleado.");
            }

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $e . '}';
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function delTmtbM(Employee $t)
    {

        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.TIMETABLE_EMPLOYEE ";
        $sql .= " WHERE ";
        $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($sql);
            $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
            $stmt->execute();
            $capsule->setMessage('Se eliminaron todos los Horarios personales de '.$t->getPaternal().' '.$t->getMaternal().' '.$t->getNames().' con Exito!');

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($sql);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $e . '}';
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function delWorkM(Employee $t)
    {

        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.TIMETABLE_WORK ";
        $sql .= " WHERE ";
        $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($sql);
            $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
            $stmt->execute();
            $capsule->setMessage('Se eliminaron todos los Horarios de Trabajo de '.$t->getPaternal().' '.$t->getMaternal().' '.$t->getNames().' con Exito!');

            $parameters['filter'] = '%%';
            $parameters['gender'] = '';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = EmployeeM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($sql);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"error":' . $e . '}';
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
        $query .= 'SELECT COUNT(HAPPYLAND.EMPLOYEE.IDEMPLOYEE) AS TOTAL FROM HAPPYLAND.EMPLOYEE';
        $query .= ' WHERE ';
        $query .= " (LOWER(DNI) LIKE :DNI OR LOWER(NAMES) LIKE :NAMES ";
        $query .= " OR LOWER(PATERNAL) LIKE :PATERNAL OR LOWER(MATERNAL) LIKE :MATERNAL) ";
        $query .= $parameters['gender'];
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare($query);

            $stmt->bindParam(':DNI', $parameters["filter"]);
            $stmt->bindParam(':NAMES', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':PATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $parameters['filter'], PDO::PARAM_STR);
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
        $query .= 'SELECT * FROM HAPPYLAND.EMPLOYEE';
        $query .= ' WHERE ';
        $query .= " (LOWER(DNI) LIKE :DNI OR LOWER(NAMES) LIKE :NAMES ";
        $query .= " OR LOWER(PATERNAL) LIKE :PATERNAL OR LOWER(MATERNAL) LIKE :MATERNAL) ";
        $query .= $parameters['gender'];
        $query .= $parameters['orderby'];
        $query .= $parameters['paginate'];
        try {
            $stmt = $cn->conectar()->prepare($query);
            $stmt->bindParam(':DNI', $parameters["filter"]);
            $stmt->bindParam(':NAMES', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':PATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $capsule->setQueryList($stmt);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new Employee($array[$i]['idemployee']);
                $t->setPaternal($array[$i]['paternal']);
                $t->setMaternal($array[$i]['maternal']);
                $t->setNames($array[$i]['names']);
                $t->setLogin($array[$i]['login']);
                $t->setPass('');
                $t->setWeekly_hours($array[$i]['weekly_hours']);
                $t->setExtra_hours($array[$i]['extra_hours']);
                $t->setExtra_minutes($array[$i]['extra_minutes']);
                $t->setGender($array[$i]['gender']);
                $t->setDni($array[$i]['dni']);
                $t->setMobile($array[$i]['mobile']);
                $lista[$i] = $t;
            }
            $capsule->setMessage('ok');
            $capsule->setContent($lista);
            $capsule->setAux($parameters);
        } catch (Exception $e) {
            $capsule->setError(true);
            $capsule->setMessage($e);
            $capsule->setQueryList($stmt);
            $capsule->setAux($parameters['gender']);
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
        return $capsule;
    }

    public static function getEmployee($id)
    {
        try {
            $cn = new Conexion;
            $stmt = $cn->Conectar()->prepare("SELECT * FROM HAPPYLAND.EMPLOYEE WHERE IDEMPLOYEE = :IDEMPLOYEE");
            $stmt->bindParam(':IDEMPLOYEE', $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetchAll();
            for ($i = 0; $i < count($array); $i++) {
                $t = new Employee($array[$i]['IDEMPLOYEE']);
                $t->setPaternal($array[$i]['PATERNAL']);
                $t->setMaternal($array[$i]['MATERNAL']);
                $t->setNames($array[$i]['NAMES']);
                $t->setLogin($array[$i]['LOGIN']);
                $t->setPass($array[$i]['PASS']);
                $t->setWeekly_hours($array[$i]['WEEKLY_HOURS']);
                $t->setExtra_hours($array[$i]['EXTRA_HOURS']);
                $t->setExtra_minutes($array[$i]['EXTRA_MINUTES']);
            }
            return $t;
        } catch (Exception $e) {
            return new Employee();
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }
}
