<?php

namespace App\Helpers;

class Validator {
    private array $errors = [];

    public function isValidEmail(string $email): bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"][] = "Email must be a valid email address";
            return false;
        }

        return true;
    }
    public function getErrors(): array {
        return $this->errors;
    }
}
