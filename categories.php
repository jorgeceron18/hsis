<?php

require_once 'bootstrap.php';




$errors = [];
$success_message = '';

try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY category_name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {


    die("Error: Could not fetch categories");
}

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_POST['add_new_category'])) {
    $validation_result =  validate($_POST['category_name'], "Category");
    if (is_array($validation_result)) {
        $errors = $validation_result;
    } else {
        $clean_category_name = $validation_result;
        if (value_exist($pdo, 'categories', 'category_name', $clean_category_name)) {
            $errors[] = "This Category already exists";
        } else {
            try {
                $sql = "INSERT INTO categories (category_name) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$clean_category_name]);
                $_SESSION['success_message'] = "The Category '{$clean_category_name}' has been added successfully!";
                header("Location: categories.php");
                exit;
            } catch (PDOException $e) {

                die("Database error: Could not insert category.");
            }
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
    echo htmlspecialchars($success_message);
    echo "</div>";
}
?>

<form action="categories.php" method="POST">
    <label for="category_name">New Category Name:</label>
    <input type="text" name="category_name" id="category_name"> <br>
    <input type="submit" name="add_new_category" value="Add New Category"> <br>



</form>

<?php if (!empty($categories)): ?>

    <h2>Existing Categories: </h2>
    <table>
        <thead>
            <tr>
                <th>Category Name:</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td> <?php echo htmlspecialchars($category['category_name']); ?></td>
                </tr>
            <?php endforeach; ?>


        </tbody>

    </table>


<?php endif; ?>




<?php
require_once 'partials/footer.php';

?>