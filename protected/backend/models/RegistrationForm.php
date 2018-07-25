<?php

namespace app\models;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $is_freelancer;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['fieldRequired'] = ['is_freelancer', 'required'];
        $rules['fieldLength']   = ['is_freelancer', 'integer', 'max' => 1];
        return $rules;
    }
}
