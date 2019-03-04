<?php
class EmployeeM
{

    public static function insertM(Employee $t)
    {
        try {
            $cn = new conexion;
            $sql = "INSERT INTO ";
            $sql .= "HAPPYLAND";
            $sql .= ".EMPLOYEE(";
            $sql .= "PATERNAL, MATERNAL, NAMES, LOGIN, PASS,";
            $sql .= "WEEKLY_HOURS, EXTRA_HOURS, EXTRA_MINUTES, GENDER, DNI,";
            $sql .= "MOBILE";
            $sql .= ") VALUES(";
            $sql .= ":PATERNAL, :MATERNAL, :NAMES, :LOGIN, :PASS,";
            $sql .= ":WEEKLY_HOURS, :EXTRA_HOURS, :EXTRA_MINUTES, :GENDER, :DNI";
            $sql .= ":MOBILE";
            $sql .= ")";
            $stmt = $cn->conectar()->prepare($sql);
            $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
            $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
            $stmt->bindParam(':LOGIN', $t->getLogin(), PDO::PARAM_STR);
            $stmt->bindParam(':PASS', $t->getPass(), PDO::PARAM_STR);
            $stmt->bindParam(':WEEKLY_HOURS', $t->getWeekly_hours(), PDO::PARAM_INT);
            $stmt->bindParam(':EXTRA_HOURS', $t->getExtra_hours(), PDO::PARAM_INT);
            $stmt->bindParam(':EXTRA_MINUTES', $t->getExtra_minutes(), PDO::PARAM_INT);
            $stmt->bindParam(':GENDER', $t->getGender(), PDO::PARAM_STR);
            $stmt->bindParam(':DNI', $t->getDni(), PDO::PARAM_STR);
            $stmt->bindParam(':MOBILE', $t->getMobile(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function updateM(Employee $t)
    {
        try {
            $cn = new Conexion;
            $sql = "UPDATE ";
            $sql .= "HAPPYLAND";
            $sql .= ".EMPLOYEE SET ";
            $sql .= "PATERNAL = :PATERNAL, MATERNAL = :MATERNAL, NAMES = :NAMES, LOGIN = :LOGIN, PASS = :PASS,";
            $sql .= "WEEKLY_HOURS = :WEEKLY_HOURS, EXTRA_HOURS = :EXTRA_HOURS, EXTRA_MINUTES = :EXTRA_MINUTES, GENDER = :GENDER, DNI= :DNI";
            $sql .= "MOBILE = :MOBILE";
            $sql .= " WHERE ";
            $sql .= " IDEMPLOYEE = :IDEMPLOYEE";
            $stmt = $cn->conectar()->prepare($sql);
            $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
            $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
            $stmt->bindParam(':LOGIN', $t->getLogin(), PDO::PARAM_STR);
            $stmt->bindParam(':PASS', $t->getPass(), PDO::PARAM_STR);
            $stmt->bindParam(':WEEKLY_HOURS', $t->getWeekly_hours(), PDO::PARAM_INT);
            $stmt->bindParam(':EXTRA_HOURS', $t->getExtra_hours(), PDO::PARAM_INT);
            $stmt->bindParam(':EXTRA_MINUTES', $t->getExtra_minutes(), PDO::PARAM_INT);
            $stmt->bindParam(':GENDER', $t->getGender(), PDO::PARAM_STR);
            $stmt->bindParam(':DNI', $t->getDni(), PDO::PARAM_STR);
            $stmt->bindParam(':MOBILE', $t->getMobile(), PDO::PARAM_STR);
            $stmt->bindParam(':IDEMPLOYEE', $t->getIdemployee(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function eliminarM($idemployee)
    {
        try {
            $cn = new Conexion;
            $sql = "DELETE FROM ";
            $sql .= "HAPPYLAND.";
            $sql .= "EMPLOYEE ";
            $sql .= " WHERE";
            $sql .= "IDEMPLOYEE = :IDEMPLOYEE";
            $stmt = $cn->conectar()->prepare("DELETE FROM personal WHERE :");
            $stmt->bindParam(':IDEMPLOYEE', $idemployee, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function listarM($parameters)
    {
        $capsule = new Capsule();
        $query='';
        $query.='SELECT * FROM HAPPYLAND.EMPLOYEE';
        $query.=' WHERE ';
        $query.=" (LOWER(DNI) LIKE :DNI OR LOWER(NAMES) LIKE :NAMES ";
        $query.=" OR LOWER(PATERNAL) LIKE :PATERNAL OR LOWER(MATERNAL) LIKE :MATERNAL) ";
        $query.=$parameters['gender'];
        $query.=$parameters['orderby'];
        $query.=$parameters['paginate'];
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->bindParam(':DNI', $parameters["filter"]);
            $stmt->bindParam(':NAMES', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':PATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $capsule->setQuery($stmt);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new Employee($array[$i]['idemployee']);
                $t->setPaternal($array[$i]['paternal']);
                $t->setMaternal($array[$i]['maternal']);
                $t->setNames($array[$i]['names']);
                $t->setLogin($array[$i]['login']);
                $t->setPass($array[$i]['pass']);
                $t->setWeekly_hours($array[$i]['weekly_hours']);
                $t->setExtra_hours($array[$i]['extra_hours']);
                $t->setExtra_minutes($array[$i]['extra_minutes']);
                $t->setGender($array[$i]['gender']);
                $t->setDni($array[$i]['dni']);
                $t->setMobile($array[$i]['mobile']);
                $lista[$i] = $t;
            }
            $capsule->setMessage('Solicitud Completada');
            $capsule->setCounter(count($lista));
            $capsule->setContent($lista);
            $capsule->setAux($parameters);
            
        } catch (Exception $e) {
            $capsule->setError(true);
            $capsule->setMessage($e);
            $capsule->setQuery($stmt);
            $capsule->setAux($parameters['gender']);
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
        return $capsule->getResponse();
    }

    public static function getPersonal($id)
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
