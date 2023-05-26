<?php
// Include config file
require_once '../config/config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = 'SELECT id FROM users WHERE username = ?';

        if ($stmt = $mysql_db->prepare($sql)) {
            // Set parameter
            $param_username = trim($_POST['username']);

            // Bind parameter to prepared statement
            $stmt->bind_param('s', $param_username);

            // Attempt to execute statement
            if ($stmt->execute()) {
                // Store executed result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = 'This username is already taken.';
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        } else {
            // Close db connection
            $mysql_db->close();
        }
    }

    // Check if email is empty
    if (empty(trim($_POST['email']))) {
        $email_err = "Please enter an email address.";
    } else {
        $email = trim($_POST['email']);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {
        // Check if a profile picture was uploaded
        if (!empty($_FILES['profile_picture']['name'])) {
            $targetDir = "profile_pictures/"; // Carpeta donde se guardarán las imágenes de perfil
            $fileName = basename($_FILES['profile_picture']['name']);
            $uploadPath = $targetDir . $fileName;
            $fileType = pathinfo($uploadPath, PATHINFO_EXTENSION);

            // Verificar si el archivo es una imagen
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Mover el archivo al directorio de destino
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadPath)) {
                    // El archivo se movió exitosamente, ahora puedes guardar el nombre en la base de datos
                    // Prepare insert statement with profile picture field
                    $sql = 'INSERT INTO users (username, password, email, profile_picture) VALUES (?, ?, ?, ?)';

                    if ($stmt = $mysql_db->prepare($sql)) {
                        // Set parameters
                        $param_username = $username;
                        $param_password = password_hash($password, PASSWORD_DEFAULT); // Create a password hash
                        $param_email = $email;
                        $param_profile_picture = $fileName;

                        // Bind parameters to prepared statement
                        $stmt->bind_param('ssss', $param_username, $param_password, $param_email, $param_profile_picture);

                        // Attempt to execute
                        if ($stmt->execute()) {
                            // Redirect to login page
                            header('location: ./login.php');
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }

                        // Close statement
                        $stmt->close();
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            // Prepare insert statement without profile picture field
            $sql = 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)';

            if ($stmt = $mysql_db->prepare($sql)) {
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Create a password hash
                $param_email = $email;

                // Bind parameters to prepared statement
                $stmt->bind_param('sss', $param_username, $param_password, $param_email);

                // Attempt to execute
                if ($stmt->execute()) {
                    // Redirect to login page
                    header('location: ./login.php');
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $mysql_db->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style/styleRegister.css">
    <link rel="icon" type="image/png" href="  " />
</head>

<body>
    <main>
        <section class="container wrapper">
            <h2 class="display-4 pt-3">Regístrate</h2>
            <p class="text-center">Por favor, completa este formulario para crear una cuenta.</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label for="username">Nombre de usuario:</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label for="confirm_password">Confirmar contraseña:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Imagen de perfil:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-outline-success" value="Registrar">
                    <input type="reset" class="btn btn-block btn-outline-primary" value="Cancelar">
                </div>
                <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesion aqui</a>.</p>
            </form>
        </section>
    </main>
</body>

</html>
