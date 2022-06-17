<?php

namespace Helpers;

class Filter{

    
    public static function filter(array $data, array $fields, array $messages = []): array
    {
        $sanitization_rules = [];
        $validation_rules  = [];

        foreach ($fields as $field => $rules) {
            if (strpos($rules, '|')) {
                [$sanitization_rules[$field], $validation_rules[$field]] =  explode('|', $rules, 2);
            } else {
                $sanitization_rules[$field] = $rules;
            }
        }

        $inputs = Sanitization::sanitize($data, $sanitization_rules);
        $errors = Validation::validate($inputs, $validation_rules, $messages);

        return [$inputs, $errors];
    }

}