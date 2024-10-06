<?php
session_start();
$db_host   = '192.168.56.12';
$db_name   = 'mydatabase';
$db_user   = 'admin';
$db_passwd = 'admin_pw';

try {
 
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_passwd);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $username = $_POST['username'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $password = $_POST['password'] ?? '';
    $emailAddress = $_POST['emailAddress'] ?? '';
    $shippingAddress = $_POST['shippingAddress'] ?? '';

    // Check for required fields
    if (empty($username) || empty($password) || empty($emailAddress) || empty($shippingAddress)) {
        $_SESSION['validation'] = "Please fill all required fields.";
        header('Location: add-customer.php');
        exit;
    }

    try {
        // Prepare an SQL statement for inserting a new customer
        $stmt = $pdo->prepare("INSERT INTO customer (username, firstName, surname, shippingAddress, emailAddress, password) VALUES (:username, :firstName, :surname, :shippingAddress, :emailAddress, :password)");

    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':shippingAddress', $shippingAddress);
        $stmt->bindParam(':emailAddress', $emailAddress);
        $stmt->bindParam(':password', $password);

        
        $stmt->execute();

        // Redirect to index page on success
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['validation'] = "Error: " . $e->getMessage();
        header('Location: add-customer.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Create an Account</title>
</head>
<body>
    <main>
        <?php include 'navigation.php'; ?>

        <h1>Create an Account</h1>

        <fieldset>
            <legend>Customer Details</legend>

            <?php
            if (isset($_SESSION['validation'])) {
                echo '<p>' . htmlspecialchars($_SESSION['validation']) . '</p>';
                unset($_SESSION['validation']); 
            }
            ?>

            <!--htmlspecialchars to prevent any sql injections from devious users  -->
            <form action="add-customer.php" method="POST">
                <label>Username:</label><input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"/>
                <label>First Name:</label><input type="text" name="firstName" value="<?php echo htmlspecialchars($_POST['firstName'] ?? ''); ?>"/>
                <label>Surname:</label><input type="text" name="surname" value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>"/>
                <label>Email:</label><input type="email" name="emailAddress" value="<?php echo htmlspecialchars($_POST['emailAddress'] ?? ''); ?>"/>
                <label>Shipping Address:</label><textarea name="shippingAddress"><?php echo htmlspecialchars($_POST['shippingAddress'] ?? ''); ?></textarea>
                <label>Password:</label><input type="password" name="password"/>
                <button type="submit">Create Account</button>
            </form>
        </fieldset>

        <a class="nav" href="index.php">Home</a>
    </main>
</body>
</html>
