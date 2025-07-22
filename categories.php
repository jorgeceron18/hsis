<?php
session_start();
require_once 'config.php';
require_once 'functions.php';

$input = [];
$data = [];

$errors = [];

if (isset($_POST['add_new_category'])) {
    if (empty($_POST['new_category_name'])) {
        $errors[] = "New Category name is missing";
    } else {
        echo "Validation passed!";
        $new_category_name = trim($_POST['new_category_name']);
        $clean_new_category_name = strtolower(filter_var($new_category_name, FILTER_SANITIZE_SPECIAL_CHARS));
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
?>

<form action="categories.php" method="POST">
    <label for="new_category_name">New Category Name:</label>
    <input type="text" name="new_category_name" id="new_category_name"> <br>
    <input type="submit" name="add_new_category" value="Add New Category"> <br>



</form>

<?php
require_once 'partials/footer.php';

?>