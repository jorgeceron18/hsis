<?php

require_once 'bootstrap.php';




$errors = [];
$success_message = '';

try {
    $stmt = $pdo->query("SELECT * FROM brands ORDER BY brand_name ASC");
    $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {


    die("Error: Could not fetch brands");
}



if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if (isset($_POST['add_new_brand'])) {
    $validation_result = validate($_POST['brand_name'], "Brand");
    if (is_array($validation_result)) {
        $errors = $validation_result;
    } else {
        $clean_brand_name = $validation_result;
        if (value_exist($pdo, "brands", "brand_name", $clean_brand_name)) {
            $errors[] = "This Brand already exists";
        } else {
            try {
                $sql = "INSERT INTO brands (brand_name) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$clean_brand_name]);
                $_SESSION['success_message'] = "The Brand '{$clean_brand_name}' has been added successfully!";
                header("Location: brands.php");
                exit;
            } catch (PDOException $e) {
                die("Database error: Could not insert brand.");
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

<form action="brands.php" method="POST">
    <label for="brand_name">New Brand Name:</label>
    <input type="text" name="brand_name" id="brand_name"> <br>
    <input type="submit" name="add_new_brand" value="Add New Brand"> <br>



</form>


<?php if (!empty($brands)): ?>

    <h2>Existing Brands: </h2>
    <table>
        <thead>
            <tr>
                <th>Brand Name:</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand): ?>
                <tr>
                    <td> <?php echo htmlspecialchars($brand['brand_name']); ?></td>
                </tr>
            <?php endforeach; ?>


        </tbody>

    </table>


<?php endif; ?>

<?php
require_once 'partials/footer.php';

?>