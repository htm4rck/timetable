<?php
class Capsule
{
    private $response;
    private $error;

    public function __construct()
    {
        $this->response = array();
        $this->error = false;
        $this->response['error'] = false;
        $this->response['message'] = 'New Message';
        $this->response['counter'] = 0;
        $this->response['content'] = array();
        $this->response['queryList'] = 'SQL';
        $this->response['queryExec'] = 'SQL';
        $this->response['aux'] = array();
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setError($error)
    {
        $this->response['error'] = $error;
        $this->error = $error;
    }

    public function setMessage($message)
    {
        $this->response['message'] = $message;
    }

    public function setCounter($counter)
    {
        $this->response['counter'] = $counter;
    }
    public function getCounter()
    {
        return $this->response['counter'];
    }

    public function getContent()
    {
        return $this->response['content'];
    }
    public function setContent($content)
    {
        $this->response['content'] = $content;
    }

    public function setAux($content)
    {
        $this->response['aux'] = $content;
    }
    public function setQueryList($query)
    {
        $this->response['queryList'] = $query;
    }

    public function setQueryExec($query)
    {
        $this->response['queryExec'] = $query;
    }
}
