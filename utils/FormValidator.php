<?php
class FormValidator
{
    private $isAnyError = false;
    private $errors = [];

    public function addInput(string $inputName, callable $validateValue, $required = true)
    {
        $this->errors[$inputName] = "";
        if (isset($_POST[$inputName])) {
            $value = $_POST[$inputName];
            $inputErrors = [];
            if ($required && empty($value)) {
                $inputErrors[] = "To pole jest wymagane";
            } else {
                $validateValue($value, $inputErrors);
            }
            if (sizeof($inputErrors) > 0) {
                $this->isAnyError = true;
                $this->errors[$inputName] = implode(", ", $inputErrors);
            }
        }
    }

    public function renderError($inputName)
    {
        if (array_key_exists($inputName, $this->errors) && $this->errors[$inputName]) {
            echo '<div class="invalid-feedback">' . $this->errors[$inputName] . "</div>";
        }
    }

    public function renderInputClasses($inputName = "")
    {
        $classes = "form-control";
        if (array_key_exists($inputName, $this->errors) && $this->errors[$inputName]) {
            $classes .= " is-invalid";
        }
        echo $classes;
    }

    public function success()
    {
        return !$this->isAnyErrors;
    }

    public static function checkLength($string, $min = 5, $max = 20)
    {
        return strlen($string) >= $min && strlen($string) <= $max;
    }
}
