<?php
namespace App\Validator;

class CustomValidator extends \Illuminate\Validation\Validator
{
    /* 半角英字 */
    public function validateAlphaCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }
    
    /* 半角英数字 */
    public function validateAlphaNumCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d]+$/', $value);
    }
    /* 半角英数字 + 「_」 + 「-」 */
    public function validateAlphaDashCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d_-]+$/', $value);
    }
}
