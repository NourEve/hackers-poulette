<?php
$conn = new PDO(
    'mysql:host=localhost;dbname=hackerspoulette;charset=utf8',
    'root',
    ''
);
$errorMsg = array(
    'errorName' => 'Your name can only contain letters',
    'errorName2' => 'Your name must contain between 2 and 250 characters',
    'errorFirstname' => 'Your First name can only contain letters',
    'errorFisrtname2' => 'Your First name must contain between 2 and 250 characters',
    'errorEmail' => 'The format of the e-mail address is incorrect.',
    'errorComment' => 'Your name must contain between 2 and 250 characters'
);
$arraySave = array();

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
            <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
            <br>
            <?php
            if (isset($_POST['name'])) {
                if (empty($_POST['name'])) {
                    echo '<p>Name is required</p>';
                } else {
                    $name = $_POST['name'];
                    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/', $name)) {
                        echo '<p>' . $errorMsg['errorName'] . '</p>';
                    }
                    if (strlen($name) < 2 || strlen($name) > 250) {
                        echo '<p>' . $errorMsg['errorName2'] . '</p>';
                    } else {
                        $arraySave['name'] = $name;
                    }
                }
            }
            ?>
            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>">
            <br>
            <?php
            if (isset($_POST['firstname'])) {
                if (empty($_POST['firstname'])) {
                    echo '<p>First name is required</p>';
                } else {
                    $firstname = $_POST['firstname'];
                    $firstname = filter_var($firstname, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/', $firstname)) {
                        echo '<p>' . $errorMsg['errorFirstname'] . '</p>';
                    }
                    if (strlen($firstname) < 2 || strlen($firstname) > 250) {
                        echo '<p>' . $errorMsg['errorFirstname2'] . '</p>';
                    } else {
                        $arraySave['firstname'] = $firstname;
                    }
                }
            }
            ?>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
            <br>
            <?php
            if (isset($_POST['email'])) {
                if (empty($_POST['email'])) {
                    echo '<p>Email adress is required </p>';
                } else {
                    $email = $_POST['email'];
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo '<p>' . $errorMsg['errorEmail'] . '</p>';
                    } else {
                        $arraySave['email'] = $email;
                    }
                }
            }
            ?>

            <label for="comment">Message:</label>
            <textarea id="comment" name="comment"><?php echo isset($_POST["comment"]) ? $_POST["comment"] : ''; ?></textarea>
            <br>
            <?php
            if (isset($_POST['comment'])) {
                if (empty($_POST['comment'])) {
                    echo '<p>Message is required </p>';
                } else {
                    $comment = $_POST['comment'];
                    $comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (strlen($comment) < 250 || strlen($comment) > 1000) {
                        echo '<p>' . $errorMsg['errorComment'] . '</p>';
                    } else {
                        $arraySave['comment'] = $comment;
                    }
                }
            }
            ?>
            <input type="submit" value="Send message">

        </form>
    </main>
</body>

</html>
<?php
if (isset($name) && isset($firstname) && isset($email) && isset($comment)) {
    $insertValue = $conn->prepare('INSERT INTO `form`(name, firstname, email, comment) VALUES (:name, :firstname, :email, :comment)');
    $insertValue->execute([
        'name' => $name,
        'firstname' => $firstname,
        'email' => $email,
        'comment' => $comment
    ]);
}
