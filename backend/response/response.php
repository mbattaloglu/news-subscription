<?php

class Response
{
    private string $message;
    private bool $success;
    private string $error;

    public function __construct(string $message, bool $success, string|Exception $error)
    {
        $this->message = $message;
        $this->success = $success;
        if ($error instanceof Exception) {
            $this->error = $error->getMessage();
        } else {
            $this->error = $error;
        }
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    public function setError(string|Exception $error)
    {
        if ($error instanceof Exception) {
            $this->error = $error->getMessage();
        } else {
            $this->error = $error;
        }
    }

    public function genereateResponseJSON()
    {
        return
            json_encode(
                array(
                    "message" => $this->message,
                    "success" => $this->success,
                    "error" => $this->error
                )
            );
    }
}