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
    $password = $_POST['password'] ?? '';

    // Check for required fields
    if (empty($username) || empty($password)) {
        $_SESSION['validation'] = "Username and password are required.";
        header('Location: customer-sign-in.php');
        exit;
    }

    try {
        // Check if the customer exists
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);


            // Set the customer in the session
            $_SESSION['customer'] = $customer;
           header('Location: view-products.php');
            exit;
        } else {
            $_SESSION['validation'] = "Invalid username or password. Please try again.";
            header('Location: customer-sign-in.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['validation'] = "Error: " . $e->getMessage();
        header('Location: customer-sign-in.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Sign in</title>
</head>
<body>
    <main>
        <?php include 'navigation.php'; ?>

        <h1>Sign in</h1>

        <fieldset>
            <legend>Account Details</legend>

            <?php
            if (isset($_SESSION['validation'])) {
                echo '<p>' . htmlspecialchars($_SESSION['validation']) . '</p>';
                unset($_SESSION['validation']); 
            }
            ?>

            <p class="shop">Please sign in to continue</p>

            <form action="customer-sign-in.php" method="POST">
                <label>Username:</label><input type="text" name="username" />
                <label>Password:</label><input type="password" name="password"/>

                <button type="submit">Login</button>
            </form>
        </fieldset>

        <p class="shop">If you don't have an account then you can
            <a class="nav" href="add-customer.php">create one!</a>
        </p>
        <a class="nav" href="index.php">Home</a>
    </main>
</body>
</html>
