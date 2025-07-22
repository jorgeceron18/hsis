<?php
require_once 'partials/header.php';


?>

<form action="categories.php" method="POST">
    <label for="category_name">Category Name</label>
    <input type="text" name="category_name" id="category_name"> <br>
    <input type="submit" name="add_category" value="Add Category"> <br>



</form>

<?php
require_once 'partials/footer.php';

?>