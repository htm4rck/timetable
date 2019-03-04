<?php
class Capsule
{
    private $response;

    public function __construct()
    {
        $this->response = array();
        $this->response['error'] = false;
        $this->response['message'] = 'New Message';
        $this->response['counter'] = 0;
        $this->response['content'] = array();
        $this->response['query']='SQL';
        $this->response['aux']=array();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setError($error)
    {
        $this->response['error'] = $error;
    }

    public function setMessage($message)
    {
        $this->response['message'] = $message;
    }

    public function setCounter($counter)
    {
        $this->response['counter'] = $counter;
    }

    public function setContent($content)
    {
        $this->response['content'] = $content;
    }

    public function setAux($content)
    {
        $this->response['aux'] = $content;
    }
    public function setQuery($query)
    {
        $this->response['query'] = $query;
    }
}
