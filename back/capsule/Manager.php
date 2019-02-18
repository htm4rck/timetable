<?php

class Manager{
    private $idmanager;
    private $paternal;
    private $maternal;
    private $names;
    private $login;
    private $pass;

    public function __construct($idmanager=0)
    {
        $this->idmanager=$idmanager;
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
}