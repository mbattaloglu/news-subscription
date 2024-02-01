<?php

class Credentials
{
    private string $senderEmail = "YOUR-CREDENTIALS";
    private string $senderPassword = "YOUR-CREDENTIALS";
    private string $senderName = "YOUR-CREDENTIALS";

    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    public function getSenderPassword()
    {
        return $this->senderPassword;
    }

    public function getSenderName()
    {
        return $this->senderName;
    }
}