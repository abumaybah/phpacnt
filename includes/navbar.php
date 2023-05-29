<header class="header">
    <?php if (isset($_SESSION['auth'])) {
    ?>
        <p class="header__logo">Welcome <?= $_SESSION['auth_user']['name'] ?></p>
    <?php
    } else {
    ?>
        <p class="header__logo">ACNT</p>
    <?php
    } ?>

    <nav class="header__nav">
        <ul class="header__list">
            <?php if (isset($_SESSION['auth'])) {
            ?>
                <?php
                if ($_SESSION['user_type'] === 'A') {
                ?>
                    <li class="header__item"><a href="admin/index.php" class="header__link">Admin Panel</a></li>
                <?php
                }
                ?>
                <li class="header__item"><a href="index.php" class="header__link">Main</a></li>
                <li class="header__item"><a href="logout.php" class="header__link">Logout</a></li>
                <li class="header__item"><a href="products.php" class="header__link">Products</a></li>
            <?php
            } else {
            ?>
                <li class="header__item"><a href="register.php" class="header__link">Register</a></li>
                <li class="header__item"><a href="login.php" class="header__link">Login</a></li>
            <?php
            } ?>


        </ul>
    </nav>
</header>