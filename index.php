<?php
$conn = new PDO(
    'mysql:host=localhost;dbname=hackerspoulette;charset=utf8',
    'root',
    ''
);
$arrayForm = array();
$errorMsg = array(
    'errorName' => 'Your name can only contain letters',
    'errorName2' => 'Ytes',
    'errorFirstname' => 'Your firstname can only contain letters',
    'errorEmail' => 'The format of the e-mail address is incorrect.',
);

function checkForm($errorMsg)
{
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $comment = $_POST['comment'];

    if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/", $name)) {
        echo '<p class="error_name">' . $errorMsg['errorName'] . '</p>';
    }
    if (strlen($name <= 2) || strlen($name >= 255)) {
        echo '<p class="error_name">' . $errorMsg['errorName'] . '</p>';
    }
    if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/", $firstname)) {
        echo '<p class="firstname">' . $errorMsg['errorName'] . '</p>';
    }
    if (strlen($firstname <= 2) || strlen($firstname >= 255)) {
        echo '<p class="firstname">' . $errorMsg['errorName'] . '</p>';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<p class="error_email">' . $errorMsg['errorEmail'] . '</p>';
    }
    if (strlen($comment) <= 250 || strlen($comment) >= 1000) {
        echo '<p class="error_email">' . $errorMsg['errorEmail'] . '</p>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackers-poulette</title>
</head>

<body>
    <header>
        <a href="#">Hackers Poulette</a>
        <h1>Contact us</h1>
        <h2>Our friendly team would love to hear from you !</h2>
    </header>
    <main>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="comment">Message:</label>
            <textarea id="comment" name="comment" required></textarea>

            <input type="submit" value="Send message">
        </form>
        <div class="error">
            <?php
            if (!isset($_POST['submit'])) {
                checkForm($errorMsg);
            }
            ?>
        </div>
    </main>
</body>

</html>