<?php

require_once 'bootstrap.php';




$errors = [];
$success_message = '';

if (isset($_POST['add_new_category'])) {
    $validation_result =  validate_category_name($_POST['new_category_name']);
    if (is_array($validation_result)) {
        $errors = $validation_result;
    } else {
        $clean_category_name = $validation_result;
        try {
            $sql = "INSERT INTO categories (category_name) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$clean_category_name]);
            $success_message = "Category added successfully!";
        } catch (PDOException $e) {

            die("Database error: Could not insert category.");
        }
    }
}

?>




<?php
require_once 'partials/header.php';

if (!empty($errors)) {
    echo "<div class='error-box'>";
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    echo "</div>";
}

if (!empty($success_message)) {
    echo "<div class= 'success-box'>";
    echo $success_message;
    echo "</div>";
}
?>

<form action="categories.php" method="POST">
    <label for="new_category_name">New Category Name:</label>
    <input type="text" name="new_category_name" id="new_category_name"> <br>
    <input type="submit" name="add_new_category" value="Add New Category"> <br>



</form>

<?php
require_once 'partials/footer.php';

?>