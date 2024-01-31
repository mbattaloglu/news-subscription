<?php

class Validator
{
    static function validateName(string $name)
    {
        if (!$name || trim($name) == '') {
            throw new Exception("Please provide a name.");
        }

        // Test the name
        if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
            throw new Exception("Name have invalid characters.");
        }

        return true;
    }

    static function validateEmail(string $email)
    {
        // If no email provided or only whitespace(s) provided
        if (!$email || trim($email) == '') {
            throw new Exception("Please provide an email.");
        }

        // Test for non-latin characters
        if (preg_match("/[^A-Za-z0-9@.%+-]/", $email)) {
            throw new Exception("Email contains invalid characters.");
        }

        // Test the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is not valid.");
        }

        return true;
    }
}