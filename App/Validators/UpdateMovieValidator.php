<?php

namespace App\Validators;

class UpdateMovieValidator
{
    protected array $errors = [
        'title_error' => 'The title should be more 2 symbols',
        'description_error' => 'The description should be more 10 symbols',
        'date_error' => 'The date is invalid',
        'image_error' => 'The image format is invalid. Accepted formats: jpg, jpeg, png'
    ];

    protected array $rules = [
        'title' => '/[A-Za-zА-Яа-я\d]{2,}/',
        'description' => '/[A-Za-zА-Яа-я\d\s.]{10,}/',
        'date' => '/(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])/',
        'image' => '/\.(jpg|png|jpeg)/'
    ];

    public function validate($fields):bool
    {
        foreach ($fields as $key => $field) {

            if ($key === 'image' && empty($field)) {
                continue;
            }

            if (preg_match($this->rules[$key], $field)) {
                unset($this->errors["{$key}_error"]);
            }

            if ($key === 'title' && mb_strlen($field) > 50) {
                $this->errors["{$key}_error"] = 'The title should be max 50 symbols';
            }

            if ($key === 'description' && mb_strlen($field) > 400) {
                $this->errors["{$key}_error"] = 'The description should be max 400 symbols';
            }

            if ($key === 'image' && empty($field)) {
                continue;
            }

        }

        return empty($this->errors);
    }

    public function getError(): array
    {
        return $this->errors;
    }
}