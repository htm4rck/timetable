<?php
class Employee implements JsonSerializable
{
    private $idemployee;
    private $paternal;
    private $maternal;
    private $names;
    private $login;
    private $pass;
    private $weekly_hours;
    private $extra_hours;
    private $extra_minutes;
    private $gender;
    private $dni;
    private $mobile;

    public function __construct($idemployee = 0)
    {
        $this->idemployee = $idemployee;
    }
    public static function getEmployee($std)
    {
        $empleado = new Employee();
        $empleado->setIdemployee(@$std->idemployee);
        $empleado->setPaternal(@$std->paternal);
        $empleado->setMaternal(@$std->maternal);
        $empleado->setNames(@$std->names);
        $empleado->setLogin(@$std->login);
        $empleado->setPass(@$std->pass);
        $empleado->setWeekly_hours(@$std->weekly_hours);
        $empleado->setExtra_hours(@$std->extra_hours);
        $empleado->setExtra_minutes(@$std->extra_minutes);
        $empleado->setGender(@$std->gender);
        $empleado->setDni(@$std->dni);
        $empleado->setMobile(@$std->mobile);
        return $empleado;
    }
    public function getIdemployee()
    {
        return $this->idemployee;
    }

    public function setIdemployee($idemployee)
    {
        $this->idemployee = $idemployee;
    }

    public function getPaternal()
    {
        return $this->paternal;
    }

    public function setPaternal($paternal)
    {
        $this->paternal = $paternal;
    }

    public function getMaternal()
    {
        return $this->maternal;
    }

    public function setMaternal($maternal)
    {
        $this->maternal = $maternal;
    }

    public function getNames()
    {
        return $this->names;
    }

    public function setNames($names)
    {
        $this->names = $names;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getWeekly_hours()
    {
        return $this->weekly_hours;
    }

    public function setWeekly_hours($weekly_hours)
    {
        $this->weekly_hours = $weekly_hours;
    }

    public function getExtra_hours()
    {
        return $this->extra_hours;
    }

    public function setExtra_hours($extra_hours)
    {
        $this->extra_hours = $extra_hours;
    }

    public function getExtra_minutes()
    {
        return $this->extra_minutes;
    }

    public function setExtra_minutes($extra_minutes)
    {
        $this->extra_minutes = $extra_minutes;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function jsonSerialize()
    {
        return
            [
                'idemployee'   => $this->idemployee,
                'paternal' => $this->paternal,
                'maternal' => $this->maternal,
                'names' => $this->names,
                'login' => $this->login,
                'pass' => $this->pass,
                'weekly_hours' => $this->weekly_hours,
                'extra_hours' => $this->extra_hours,
                'extra_minutes' => $this->extra_minutes,
                'gender' => $this->gender,
                'dni' => $this->dni,
                'mobile' => $this->mobile

            ];
    }
}
