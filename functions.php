<?php


function validate($name, $type)
{
    $errors = [];
    $new_name = trim($name);
    if (empty($new_name)) {
        $errors[] = "The {$type} name cannot be empty or just spaces.";
    }

    if (strlen($new_name) < 3) {
        $errors[] = "The {$type} name must be at least 3 characters.";
    }

    if (strlen($new_name) > 50) {
        $errors[] = "The {$type} name must not exceed 50 characters.";
    }

    if (!preg_match("/^[\p{L}\p{N}\s]+$/u", $new_name)) {
        $errors[] = "The {$type} name can only contain letters, numbers, and spaces.";
    }

    if (!empty($errors)) {
        return $errors;
    } else {
        return  preg_replace('/\s+/', ' ', $new_name);
    }
}
