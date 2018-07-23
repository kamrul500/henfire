<?php
namespace app\models;

class Reguser extends \dektrium\user\models\User
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'is_freelancer';
        $scenarios['update'][]   = 'is_freelancer';
        $scenarios['register'][] = 'is_freelancer';
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        //$rules['fieldRequired'] = ['field', 'required'];
        //$rules['fieldLength']   = ['field', 'string', 'max' => 10];

        return $rules;
    }
}
