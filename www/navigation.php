<nav>
    <a class="nav" href="index.php">Home</a>
    <a href="view-products.php">Browse Products</a>
    <?php if (isset($_SESSION['customer'])): ?>
        <p id="customer">Welcome Valued Customer</p>
        <form action="customer-sign-out.php" method="get" id="signoutForm">
            <button type="submit" id="signout">Sign Out</button>
        </form>
        <button type="submit" id="cart">View Cart</button>
    <?php else: ?>
        <a href="add-customer.php">Create a new Account</a>
        <a href="customer-sign-in.php">Sign in</a>
    <?php endif; ?>
</nav>