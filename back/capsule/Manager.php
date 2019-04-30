<?php

class Manager implements JsonSerializable
{
    private $idmanager;
    private $paternal;
    private $maternal;
    private $names;
    private $login;
    private $pass;

    public static function getManager($std)
    {
        $manager = new Manager();
        $manager->setIdManager(@$std->idmanager);
        $manager->setPaternal(@$std->paternal);
        $manager->setMaternal(@$std->maternal);
        $manager->setNames(@$std->names);
        $manager->setLogin(@$std->login);
        $manager->setPass(@$std->pass);
        return $manager;
    }

    public function __construct($idmanager = 0)
    {
        $this->idmanager = $idmanager;
        $this->paternal = '';
        $this->maternal = '';
        $this->names = '';
        $this->login='';
        $this->pass='';
    }

    public function getIdManager()
    {
        return $this->idmanager;
    }

    public function setIdManager($idmanager)
    {
        $this->idmanager = $idmanager;
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

    public function jsonSerialize()
    {
        return
            [
                'idmanager'   => $this->idmanager,
                'paternal' => $this->paternal,
                'maternal' => $this->maternal,
                'names' => $this->names,
                'login' => $this->login,
                'pass' => $this->pass
            ];
    }
}
