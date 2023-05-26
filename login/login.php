<?php
// Initialize sessions
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

// Include config file
require_once "../config/config.php";

// Define variables and initialize with empty values
$username = $password = $email = '';
$username_err = $password_err = $email_err = '';

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if email is empty
  if (empty(trim($_POST['email']))) {
    $email_err = 'Please enter your email address.';
  } else {
    $email = trim($_POST['email']);
  }

  // Check if username is empty
  if (empty(trim($_POST['username']))) {
    $username_err = 'Please enter username.';
  } else {
    $username = trim($_POST['username']);
  }

  // Check if password is empty
  if (empty(trim($_POST['password']))) {
    $password_err = 'Please enter your password.';
  } else {
    $password = trim($_POST['password']);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err) && empty($email_err)) {
    // Prepare a select statement
    $sql = 'SELECT id, username, password FROM users WHERE username = ? OR email = ?';

    if ($stmt = $mysql_db->prepare($sql)) {

      // Set parmater
      $param_username = $username;
      $param_email = $email;

      // Bind param to statement
      $stmt->bind_param('ss', $param_username, $param_email);

      // Attempt to execute
      if ($stmt->execute()) {

        // Store result
        $stmt->store_result();

        // Check if username or email exists. Verify user exists then verify
        if ($stmt->num_rows == 1) {
          // Bind result into variables
          $stmt->bind_result($id, $username, $hashed_password);

          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {

              // Start a new session
              session_start();

              // Store data in sessions
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $username;

              // Redirect to user to page
              header('Location: /pruebas/index.php');
            } else {
              // Display an error for passord mismatch
              $password_err = 'Invalid password';
            }
          }
        } else {
          $username_err = "Invalid username or email";
        }
      } else {
        echo "Oops! Something went wrong please try again";
      }
      // Close statement
      $stmt->close();
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
  <title>Iniciar sesion</title>
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
  <link rel="stylesheet" href="style/styleLogin.css">
  <link rel="icon" type="image/png" href="  " />
</head>

<body>
  <main>
    <section class="container wrapper">

      <img src="img2/logo.png" alt=""><br><br>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group <?php echo (!empty($email_err)) ? 'has_error' : ''; ?>">
          <label for="email">Correo electrónico:</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
          <span class="help-block"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Nombre de usuario:</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Contraseña:</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-block btn-outline-primary" value="Entrar">
        </div>
        <p>¿No tienes una cuenta? <a href="register.php">Registrate aqui</a>.</p>
      </form>
    </section>
  </main>
</body>

</html>
