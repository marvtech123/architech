<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $firstName = $_POST['first-name'];
  $lastName = $_POST['last-name'];
  $email = $_POST['email'];
  $file = $_FILES['file-input'];

  $errors = array();

  // First Name validation
  if (empty($firstName)) {
    $errors['first-name'] = 'First name is required';
  }

  // Last Name validation
  if (empty($lastName)) {
    $errors['last-name'] = 'Last name is required';
  }

  // Email validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email address';
  }

  // File input validation
  if (empty($file['myfile'])) {
    $errors['file-input'] = 'File is required';
  }
    // validate the text area input
    if ($("textarea[name='message']").val().trim() === "") {
      alert("Message is required");
      return;
    }

    // submit the form if the input is valid
    $(this).off("submit").submit();
   // check if there are any errors
  if (count($errors) == 0) {
    // insert the form data into the database
    // ...

    // redirect to the success page
    header("Location: success.php");
    exit;
     // connect to the database
    $conn = mysqli_connect("localhost", "username", "password", "database");

    // check if the connection was successful
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // prepare the SQL statement
    $sql = "INSERT INTO form (first_name, last_name, message, file, email)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // bind the parameters
    mysqli_stmt_bind_param($stmt, "sssss", $_POST["first_name"], $_POST["last_name"], $_POST["message"], $_FILES["file"]["name"], $_POST["email"]);

    // execute the statement
    if (mysqli_stmt_execute($stmt)) {
      // upload the file
      move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);

      // redirect to the success page
      header("Location: success.php");
      exit;
    } else {
      echo "Error: " . mysqli_stmt_error($stmt);
    }

    // close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
}
  ?>