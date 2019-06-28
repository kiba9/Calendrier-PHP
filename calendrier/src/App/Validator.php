<?php


namespace App\App;


class Validator
{
    private $data;
    protected $errors = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data)
    {
        $this->errors = [];
        $this->data = $data;
        return $this->errors;
    }


    /**
     * veriife si le champ est rempli et verifie ci ce champs est valide
     * @param string $field
     * @param string $method
     * @param mixed ...$parameters
     */
    public function validate(string $field, string $method, ...$parameters):bool
    {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champs $field n'est pas rempli";
            return false;
        } else {
            return call_user_func([$this, $method], $field, ...$parameters);
        }
    }


    /**
     * verifie la longeur d'un champs en fonction du nombre de caractere minimun attendu
     * @param string $field
     * @param int $length
     */
    public function minLength(string $field, int $length): bool
    {
        if (mb_strlen($field) < $length) {
            $this->errors[$field] = "Le champs doit avoir plus de $length caracteres";
            return false;
        }
        return true;
    }

    /**
     * verifie un champs date est au bon format
     * @param string $field
     */
    public function date(string $field): bool
    {
        if (\DateTimeImmutable::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "la date ne semble pas valide";
            return false;
        }
        return true;
    }

    /**
     * verifie un time date est au bon format
     * @param string $field
     */
    public function time(string $field): bool
    {
        if (\DateTimeImmutable::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "le temps ne semble pas valide";
            return false;
        }
        return true;
    }

    /**
     * verifie la validité entre l'heure de debut et fin
     * @param string $startField
     * @param string $endField
     * @return bool
     */
    public function beforeTime(string $startField, string $endField)
    {
        if ($this->time($startField) && $this->time($endField)) {
            $start = \DateTimeImmutable::createFromFormat('H:i', $this->data[$startField]);
            $end = \DateTimeImmutable::createFromFormat('H:i', $this->data[$endField]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors[$startField] = "la date de debut doit etre inferieur a la date de fin";
                return false;
            }
            return true;
        }
        return false;
    }

}