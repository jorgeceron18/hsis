<?php

require_once 'bootstrap.php';




$errors = [];
$success_message = '';

if (isset($_POST['add_new_brand'])) {
    $validation_result = validate($_POST['new_brand_name'], "Brand");
    if (is_array($validation_result)) {
        $errors = $validation_result;
    } else {
        $clean_brand_name = $validation_result;
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

<form action="brands.php" method="POST">
    <label for="new_brand_name">New Brand Name:</label>
    <input type="text" name="new_brand_name" id="new_brand_name"> <br>
    <input type="submit" name="add_new_brand" value="Add New Brand"> <br>



</form>

<?php
require_once 'partials/footer.php';

?>