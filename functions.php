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

function value_exist($pdo, $table_name, $column_name, $value)
{
    $count = 0;
    try {
        $sql = "SELECT COUNT(*) FROM {$table_name} WHERE {$column_name} = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$value]);
        $count = $stmt->fetchColumn();
    } catch (PDOException $e) {
        die("Database query failed in value_exist function: " . $e->getMessage());
    }

    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}
