<?php
class ManagerM
{
    public static function createM(Manager $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.MANAGER.IDMANAGER) AS TOTAL FROM HAPPYLAND.MANAGER';
        $query .= ' WHERE ';
        $query .= " LOGIN = '" . $t->getLogin() . "'";

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
        $query .= "HAPPYLAND.MANAGER(";
        $query .= "PATERNAL, MATERNAL, NAMES, LOGIN, PASS ";
        $query .= ") VALUES(";
        $query .= ":PATERNAL, :MATERNAL, :NAMES, :LOGIN, :PASS ";
        $query .= ")";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($query);
                $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
                $stmt->bindParam(':LOGIN', $t->getLogin(), PDO::PARAM_STR);
                $stmt->bindParam(':PASS', crypt($t->getLogin(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->execute();
                $capsule->setMessage('El Administrador se Registro con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Administrador Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = ManagerM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"uno":'.$t->getPaternal().'}';
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function updateM(Manager $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.MANAGER.IDMANAGER) AS TOTAL FROM HAPPYLAND.MANAGER';
        $query .= ' WHERE ';
        $query .= " LOGIN = '" . $t->getLogin() . "' AND IDMANAGER != " . $t->getIdManager();
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
        $sql .= ".MANAGER SET ";
        $sql .= "PATERNAL = :PATERNAL, MATERNAL = :MATERNAL, NAMES = :NAMES, LOGIN = :LOGIN, PASS = :PASS ";
        $sql .= " WHERE ";
        $sql .= " IDMANAGER = :IDMANAGER";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':PATERNAL', $t->getPaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':MATERNAL', $t->getMaternal(), PDO::PARAM_STR);
                $stmt->bindParam(':NAMES', $t->getNames(), PDO::PARAM_STR);
                $stmt->bindParam(':LOGIN', $t->getLogin(), PDO::PARAM_STR);
                $stmt->bindParam(':PASS', crypt($t->getLogin(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->bindParam(':IDMANAGER', $t->getIdManager(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Administrador se Actualizo con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe otro Administrador Con el DNI Ingresado");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = ManagerM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"hola":' . $e . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function changePassM(Manager $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(HAPPYLAND.MANAGER.IDMANAGER) AS TOTAL FROM HAPPYLAND.MANAGER';
        $query .= ' WHERE ';
        $query .= " LOGIN = '" . $t->getLogin() . "' AND IDMANAGER != " . $t->getIdManager();
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
        $sql .= ".MANAGER SET ";
        $sql .= "PASS = :PASS";
        $sql .= " WHERE ";
        $sql .= " IDMANAGER = :IDMANAGER";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':PASS', crypt($t->getPass(), '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), PDO::PARAM_STR);
                $stmt->bindParam(':IDMANAGER', $t->getIdManager(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('La Contraseña se Modifico con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Error en el Cambio de Contraseña");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = ManagerM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"hola":' . $e . '}';
            #return $e;
        } finally {
            $stmt = null;
            $cn->closeCn();
        }
    }

    public static function deleteM(Manager $t)
    {
        $count = 0;
        $query  = 'SELECT COUNT(M.IDMANAGER) AS TOTAL FROM ';
        $query .= ' HAPPYLAND.MANAGER M ';

        $query .= ' FULL JOIN ';
        $query .= ' HAPPYLAND.TIMETABLE_WEEKLY  TW ';
        $query .= ' ON M.IDMANAGER = TW.IDMANAGER ';

        $query .= ' WHERE ';
        $query .= " TW.IDMANAGER = " . $t->getIdManager();
        try {
            $cn = new conexion;
            $stmt = $cn->conectar()->prepare($query);
            $stmt->execute();
            $array = $stmt->fetchAll();
            count($array) > 0 ? $count = $array[0]['total'] : $count = 0;
        } catch (Exception $e) {
            return '{"hola":' . $e . '}';
        } finally {
            $stmt = null;
        }

        $capsule = new Capsule();
        $sql  = "DELETE FROM ";
        $sql .= " HAPPYLAND.MANAGER ";
        $sql .= " WHERE ";
        $sql .= " IDMANAGER = :IDMANAGER";
        try {
            if ($count == 0) {
                $stmt = $cn->conectar()->prepare($sql);
                $stmt->bindParam(':IDMANAGER', $t->getIdManager(), PDO::PARAM_INT);
                $stmt->execute();
                $capsule->setMessage('El Administrador se Elimino con Exito!');
            } else {
                $capsule->setError(true);
                $capsule->setMessage("Existe una o más acciones asociadas a este Administrador.");
            }

            $parameters['filter'] = '%%';
            $parameters['paginate'] = ' LIMIT 10 OFFSET 0 ';
            $parameters['orderby'] = ' ORDER BY PATERNAL ';
            $read = ManagerM::readM($parameters);
            $capsule->setContent($read->getContent());
            $capsule->setCounter($read->getCounter());
            $capsule->setQueryExec($query);
            return $capsule->getResponse();
        } catch (Exception $e) {
            return '{"hola":' . $e . '}';
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
        $query .= 'SELECT COUNT(HAPPYLAND.Manager.IDManager) AS TOTAL FROM HAPPYLAND.Manager';
        $query .= ' WHERE ';
        $query .= " (LOWER(NAMES) LIKE :NAMES ";
        $query .= " OR LOWER(PATERNAL) LIKE :PATERNAL OR LOWER(MATERNAL) LIKE :MATERNAL) ";
        try {
            $cn = new Conexion;
            $stmt = $cn->conectar()->prepare($query);

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
        $query .= 'SELECT * FROM HAPPYLAND.Manager';
        $query .= ' WHERE ';
        $query .= " (LOWER(NAMES) LIKE :NAMES ";
        $query .= " OR LOWER(PATERNAL) LIKE :PATERNAL OR LOWER(MATERNAL) LIKE :MATERNAL) ";
        $query .= $parameters['orderby'];
        $query .= $parameters['paginate'];
        try {
            $stmt = $cn->conectar()->prepare($query);
            $stmt->bindParam(':NAMES', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':PATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $stmt->bindParam(':MATERNAL', $parameters['filter'], PDO::PARAM_STR);
            $capsule->setQueryList($stmt);
            $stmt->execute();
            $array = $stmt->fetchAll();
            $lista = array();
            for ($i = 0; $i < count($array); $i++) {
                $t = new Manager($array[$i]['idmanager']);
                $t->setPaternal($array[$i]['paternal']);
                $t->setMaternal($array[$i]['maternal']);
                $t->setNames($array[$i]['names']);
                $t->setLogin($array[$i]['login']);
                $t->setPass('');
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