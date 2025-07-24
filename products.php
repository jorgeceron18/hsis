<?php

require_once 'bootstrap.php';

?>

<?php
require_once 'partials/header.php';

?>

<form action="products.php" method="POST">
    <label for="name">New Product Name:</label>
    <input type="text" name="name" id="name"> <br>
    <label for="description"> Description: </label>
    <textarea name="description" id="description"></textarea><br>
    <label for="price">Price:</label>
    <input type="number" name="price" id="price"><br>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity"><br>

    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id"> </select> <br>
    <label for="brand_id">Brand:</label>
    <select name="brand_id" id="brand_id"> </select> <br>

    <input type="submit" name="add_new_product" value="Add New Product"> <br>

</form>

<?php
require_once 'partials/footer.php';

?>