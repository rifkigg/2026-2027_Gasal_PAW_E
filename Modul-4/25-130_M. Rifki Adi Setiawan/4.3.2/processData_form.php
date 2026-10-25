
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input</title>
</head>
<body>
    <fieldset>
        <legend>Detail User</legend>

        <form name="myForm" method="POST">
            <?php
            $errors = array();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require 'validate.inc';

                validateName($errors, $_POST, 'surname');
                validateEmail($errors, $_POST, 'email');
                validatePassword($errors, $_POST, 'password');
                validateAddress($errors, $_POST, 'street_address');
                validateState($errors, $_POST, 'state');
                validateGender($errors, $_POST, 'gender');
                validateCountry($errors, $_POST, 'country');

                if ($errors) {
                    echo '<h2>Invalid, correct the following errors:</h2>';

                    foreach ($errors as $field => $error) {
                        echo htmlspecialchars($field . ': ' . $error) . '<br>';
                    }

                    echo '<hr>';

                    include 'form.inc';
                } else {
                    echo '<h2>Form submitted successfully with no errors</h2>';
                }
            } else {
                include 'form.inc';
            }
            ?>
        </form>
    </fieldset>
</body>
</html>
