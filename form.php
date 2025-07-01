<?php
  include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleform.css">
    <title>FORM</title>
</head>
<body>

<div class="container">
    <div class="title">
        REGISTRATION FORM
    </div>
    <div class="form">

    <form name="formTag" class="formTag row g-3" action="form.php" method="POST" enctype="multipart/form-data" onsubmit="return validationForm();">

<!-- FIRST NAME -->
    <div class="input-field col-md-6">
    <label for="inputFname4" class="form-label">First Name<span style="color: red;">*</span></label>
    <input type="text" class="form-control" id="inputFname4" name="fname" required>
  </div>

<!-- LAST NAME -->
  <div class="input-field col-md-6">
    <label for="inputLname4" class="form-label">Last Name<span style="color: red;">*</span></label>
    <input type="text" class="form-control" id="inputLname4" name="lname" required>
  </div>

<!-- PASSWORD -->
  <div class="input-field col-md-6">
    <label for="inputPassword4" class="form-label">Password<span style="color: red;">*</span></label>
    <input type="password" class="form-control" id="inputPassword4" name="password" required>
  </div>
<!-- CONFIRM-PASSWORD -->
  <div class="input-field col-md-6">
    <label for="inputCPassword4" class="form-label">Confirm Password<span style="color: red;">*</span></label>
    <input type="password" class="form-control" id="inputCPassword4" name="conpassword" required>
  </div>
<!-- GENDER (Radio Buttons) -->
  <div class="input-field col-md-6">
    <label for="inputGender4" class="form-label">Gender</label>
    <input type="radio" name="gender" value="Male" required><label style="margin: 0 6px 0 1px;">Male</label>
    <input type="radio" name="gender" value="Female" required><label style="margin: 0 6px 0 1px;">Female</label>
    <input type="radio" name="gender" value="Other" required><label style="margin: 0 6px 0 1px;">Other</label>
  </div>
<!-- STATE (Dropdown) -->
<div class="input-field col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select" name="state">
      <option value="" selected>Choose...</option>
      <option value="Rajasthan">Rajasthan</option>
      <option value="Delhi">Delhi</option>
      <option value="Maharastra">Maharastra</option>
      <option value="Madhya pradesh">Madhya pradesh</option>
      <option value="Uttar pradesh">Uttar pradesh</option>
      <option value="Haryana">Haryana</option>
      <option value="Punjab">Punjab</option>
      <option value="Himachal pradesh">Himachal pradesh</option>
      <option value="Gujarat">Gujarat</option>
      <option value="Jharkhand">Jharkhand</option>
      <option value="Goa">Goa</option>
      <option value="Assam">Assam</option>
      <option value="Kerela">Kerela</option>
      <option value="Tamil nadu">Tamil nadu</option>
      <option value="Telengana">Telengana</option>
      <option value="Uttarakhand">Uttarakhand</option>
      <option value="West bengal">West bengal</option>
      <option value="Odisha">Odisha</option>
      <option value="Bihar">Bihar</option>
      <option value="Jammu & Kashmir">Jammu & Kashmir</option>
      <option value="Manipur">Manipur</option>
      <option value="Meghalya">Meghalya</option>
      <option value="Other">Other</option>

    </select>
  </div>
<!-- LANGUAGE (Checkboxes)-->
<div class="input-field col-md-6">
    <label for="inputGender4" class="form-label">Language</label>
    <input type="checkbox" name="language[]" value="Hindi" ><label style="margin: 0 6px 0 1px;">Hindi</label>
    <input type="checkbox" name="language[]" value="English" ><label style="margin: 0 6px 0 1px;">English</label>
</div>
<!-- EMAIL -->
<div class="input-field col-md-6">
    <label for="inputEmail4" class="form-label">Email<span style="color: red;">*</span></label>
    <input type="email" class="form-control" id="inputEmail4" name="email" required>
  </div>
<!-- PHONE NUMBER -->
  <div class="input-field col-md-6">
    <label for="inputPnumber4" class="form-label">Phone number<span style="color: red;">*</span></label>
    <input type="text" class="form-control" id="inputPnumber4" name="phone" required>
  </div>
<!-- ADDRESS -->
  <div class="input-field col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <textarea class="form-control" id="inputAddress" name="address"></textarea>
  </div>
<!-- PHOTO -->
<div class="input-field col-md-6">
    <label for="photo" class="form-label">Upload Photo <span style="color:red">*</span></label>
    <input type="file" class="form-control" id="photo" name="photo" accept="image/png, image/jpeg" required>
    <!-- <small>Max size: 2MB | Allowed formats: JPG, PNG</small> -->
</div>

<!-- TERMS & CONDITIONS -->
  <div class="input-field col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Agree to terms and conditions
      </label>
    </div>
  </div>
<!-- BUTTON -->
  <div class="input-field col-12">
    <input type="submit" value="Register" class="btn btn-primary" name="register">
  </div>
</form>


        </div>
    </div>
</div>

<script>
function validationForm() {
    const form = document.forms["formTag"];
    const fname = form["fname"].value.trim();
    const lname = form["lname"].value.trim();
    const email = form["email"].value.trim();
    const phone = form["phone"].value.trim();
    const password = form["password"].value;
    const conpassword = form["conpassword"].value;

    if (!fname || !lname || !email || !phone || !password || !conpassword) {
        alert("Please fill in all required fields.");
        return false;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    const phonePattern = /^\d{10}$/;
    if (!phonePattern.test(phone)) {
        alert("Phone number must be exactly 10 digits.");
        return false;
    }

    const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
    if (!passwordPattern.test(password)) {
        alert("Password must be at least 6 characters and include at least one number and one special character.");
        return false;
    }

    if (password !== conpassword) {
        alert("Passwords do not match.");
        return false;
    }

    const termsChecked = document.getElementById("gridCheck").checked;
    if (!termsChecked) {
        alert("You must agree to the terms and conditions.");
        return false;
    }

    return true; 
}
</script>

    
</body>
</html>


<?php

if(isset($_POST['register']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pwd = $_POST['password'];
  $cpwd  = $_POST['conpassword'];
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
  $state = isset($_POST['state']) ? $_POST['state'] : '';

  // If language is empty - use an empty array (so implode() works safely)
  $lang = isset($_POST['language']) ? $_POST['language'] : [];
  $lang1 = implode(", ", $lang);

  $email  = $_POST['email'];
  $phone  = $_POST['phone'];
  $address = isset($_POST['address']) ? $_POST['address'] : '';

  // $file_name = $_FILES['photo']['name'];
  // $tempname = $_FILES['photo']['tmp_name'];
  // $folder = 'Uploads/'.$file_name;

  // Photo Upload Handling
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $fileTmp = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Extract file extension
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileExt, $allowed)) {
            die("<script>alert('Only JPG, JPEG, PNG files are allowed.'); window.history.back();</script>");
        }

        if ($fileSize > 2 * 1024 * 1024) {
            die("<script>alert('File size should be less than 2MB.'); window.history.back();</script>");
        }

        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = uniqid("IMG_") . '.' . $fileExt;
        $destination = $uploadDir . $newFileName;

        if (!move_uploaded_file($fileTmp, $destination)) {
            die("<script>alert('File upload failed.'); window.history.back();</script>");
        }
    } else {
        die("<script>alert('Photo is required.'); window.history.back();</script>");
    }
  


  $query = "INSERT INTO form (fname, lname, password, cpassword, gender, state, language, email, phoneno, address, photo) VALUES('$fname', '$lname', '$pwd', '$cpwd', '$gender', '$state', '$lang1', '$email', '$phone', '$address', '$newFileName')";
  $data = mysqli_query($conn,$query);

  // if(move_uploaded_file($tempname, $folder)){
  //   echo "<script>alert('File uploaded successful!');</script>";
  // }
  // else{
  //   echo "<script>alert('File not uploaded');</script>";
  // }

  if($data){
    echo "<script>alert('Registration successful!');</script>";
    // echo "<meta http-equiv='refresh' content='2; url=table.php'>";
  }
  else{
    echo "<script>alert('Registration Failed!!!');</script>";
  } 

}

?>

