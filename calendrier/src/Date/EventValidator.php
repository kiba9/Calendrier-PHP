<?php


namespace App\Date;


use App\App\Validator;

class EventValidator extends Validator
{
    /**verifie la coherance des données passées en parametre
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data)
    {
        parent::validates($data);
        $this->validate('name', 'minLength', 3);
        $this->validate('date', 'date');
        $this->validate('start', 'beforeTime', 'end');

        return $this->errors;

    }

}