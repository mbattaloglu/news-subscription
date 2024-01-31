<?php

class Credentials
{
    private string $senderEmail = "your-credentials";
    private string $senderPassword = "your-credentials";

    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    public function getSenderPassword()
    {
        return $this->senderPassword;
    }
}