<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="cut.ly,url-shortener,link-shortening,short-url-generator,custom-short-links">
    <meta name="description" content="Cut.it - Your go-to destination for effortless URL shortening! Streamline your links with our user-friendly platform, creating concise and memorable URLs in seconds.">
    <title><?= $title ?? "Cut.it" ?></title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php if (isset($_SESSION['error'])) : ?>
            <section class="error-section">
                <p><?= $_SESSION['error'] ?></p>
            </section>
        <?php endif; ?>
        <div class="header">
            <a href="/" class="logo"><img src="/cut-it-logo.png" height="25px" /></a>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) : ?>
                        <li><a href="/_profile">Profile</a></li>
                        <li><a href="/_logout">Logout</a></li>
                    <?php else : ?>
                        <li><a href="/_login">Login</a></li>
                        <li><a href="/_signup">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <?= $body ?>
    <footer>
        <p>&copy; 2023 Your URL Shortener. All rights reserved.</p>
        <ul>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </footer>
</body>

</html>
<?php
unset($_SESSION['error']);
?>