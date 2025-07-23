<?php
function validate_category_name($category)
{
    $errors = [];
    $new_category_name = trim($category);
    if (empty($new_category_name)) {
        $errors[] = "Category name cannot be empty or just spaces.";
    }

    if (strlen($new_category_name) < 3) {
        $errors[] = "Category name must be at least 3 characters.";
    }

    if (strlen($new_category_name) > 50) {
        $errors[] = "Category name must be maximum 50 characters.";
    }

    if (!preg_match("/^[\p{L}\p{N}\s]+$/u", $new_category_name)) {
        $errors[] = "Category name can only contain letters, numbers, and spaces.";
    }

    if (!empty($errors)) {
        return $errors;
    } else {
        return $clean_new_category_name = preg_replace('/\s+/', ' ', $new_category_name);
    }
}
