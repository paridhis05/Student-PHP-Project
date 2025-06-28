<?php
/*
echo $_GET['id'];
echo $_GET['fn'];
echo $_GET['ln'];
echo $_GET['gen'];
echo $_GET['st'];
echo $_GET['em'];
echo $_GET['ph'];
echo $_GET['add'];
*/
?>

<?php
include("connection.php");

$id = $_GET['id'];

$query = "SELECT * FROM FORM where id = '$id'"; 
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

$result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleform.css">
    <title>Update table</title>
</head>
<body>

<div class="container">
    <div class="title">
        UPDATE RECORDS
    </div>
    <div class="form">

    
    <form class="row g-3" action="#" method="POST">
<!-- FIRST NAME -->
    <div class="input-field col-md-6">
    <label for="inputFname4" class="form-label">First Name</label>
    <input type="text" value="<?php echo $result['fname']; ?>" class="form-control" id="inputFname4" name="fname" required>
  </div>
<!-- LAST NAME -->
  <div class="input-field col-md-6">
    <label for="inputLname4" class="form-label">Last Name</label>
    <input type="text" value="<?php echo $result['lname']; ?>" class="form-control" id="inputLname4" name="lname" required>
  </div>
<!-- PASSWORD -->
  <div class="input-field col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" value="<?php echo $result['password']; ?>" class="form-control" id="inputPassword4" name="password" required>
  </div>
<!-- CONFIRM-PASSWORD -->
  <div class="input-field col-md-6">
    <label for="inputCPassword4" class="form-label">Confirm Password</label>
    <input type="password" value="<?php echo $result['cpassword']; ?>" class="form-control" id="inputCPassword4" name="conpassword" required>
  </div>

<!-- GENDER (Radio Buttons)  -->
<div class="input-field col-md-6">
    <label for="inputGender4" class="form-label">Gender</label>

    <input type="radio" name="gender" value="Male" <?php if($result['gender'] == 'Male') echo "checked"; ?> required><label style="margin: 0 6px 0 1px;">Male</label>

    <input type="radio" name="gender" value="Female"<?php if($result['gender'] == 'Female') echo "checked"; ?> required> <label style="margin: 0 6px 0 1px;">Female</label>

    <input type="radio" name="gender" value="Other" <?php if($result['gender'] == 'Other') echo "checked"; ?> required> <label style="margin: 0 6px 0 1px;" >Other</label>
  </div>

<!-- STATE (Dropdown)-->
<div class="input-field col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select" name="state" required>
      <option value="">Choose...</option>
      <option value="Rajasthan"
      <?php
        if($result['state'] == 'Rajasthan'){
            echo "selected";
        }
        ?>
      >Rajasthan</option>
      <option value="Delhi"
      <?php
        if($result['state'] == 'Delhi'){
            echo "selected";
        }
        ?>
      >Delhi</option>
      <option value="Maharastra"
      <?php
        if($result['state'] == 'Maharastra'){
            echo "selected";
        }
        ?>
      >Maharastra</option>
      <option value="Madhya pradesh"
      <?php
        if($result['state'] == 'Madhya pradesh'){
            echo "selected";
        }
        ?>
      >Madhya pradesh</option>
      <option value="Uttar pradesh"
      <?php
        if($result['state'] == 'Uttar pradesh'){
            echo "selected";
        }
        ?>
      >Uttar pradesh</option>
      <option value="Haryana"
      <?php
        if($result['state'] == 'Haryana'){
            echo "selected";
        }
        ?>
      >Haryana</option>
      <option value="Punjab"
      <?php
        if($result['state'] == 'Punjab'){
            echo "selected";
        }
        ?>
      >Punjab</option>
      <option value="Himachal pradesh"
      <?php
        if($result['state'] == 'Himachal pradesh'){
            echo "selected";
        }
        ?>
      >Himachal pradesh</option>
      <option value="Gujarat"
      <?php
        if($result['state'] == 'Gujarat'){
            echo "selected";
        }
        ?>
      >Gujarat</option>
      <option value="Jharkhand"
      <?php
        if($result['state'] == 'Jharkhand'){
            echo "selected";
        }
        ?>
      >Jharkhand</option>
      <option value="Goa"
      <?php
        if($result['state'] == 'Goa'){
            echo "selected";
        }
        ?>
      >Goa</option>
      <option value="Assam"
      <?php
        if($result['state'] == 'Assam'){
            echo "selected";
        }
        ?>
      >Assam</option>
      <option value="Kerela"
      <?php
        if($result['state'] == 'Kerela'){
            echo "selected";
        }
        ?>
      >Kerela</option>
      <option value="Tamil nadu"
      <?php
        if($result['state'] == 'Tamil nadu'){
            echo "selected";
        }
        ?>
      >Tamil nadu</option>
      <option value="Telengana"
      <?php
        if($result['state'] == 'Telengana'){
            echo "selected";
        }
        ?>
      >Telengana</option>
      <option value="Uttarakhand"
      <?php
        if($result['state'] == 'Uttarakhand'){
            echo "selected";
        }
        ?>
      >Uttarakhand</option>
      <option value="West bengal"
      <?php
        if($result['state'] == 'West bengal'){
            echo "selected";
        }
        ?>
      >West bengal</option>
      <option value="Odisha"
      <?php
        if($result['state'] == 'Odisha'){
            echo "selected";
        }
        ?>
      >Odisha</option>
      <option value="Bihar"
      <?php
        if($result['state'] == 'Bihar'){
            echo "selected";
        }
        ?>
      >Bihar</option>
      <option value="Jammu & Kashmir"
      <?php
        if($result['state'] == 'Jammu & Kashmir'){
            echo "selected";
        }
        ?>
      >Jammu & Kashmir</option>
      <option value="Manipur"
      <?php
        if($result['state'] == 'Manipur'){
            echo "selected";
        }
        ?>
      >Manipur</option>
      <option value="Meghalya"
      <?php
        if($result['state'] == 'Meghalya'){
            echo "selected";
        }
        ?>
      >Meghalya</option>
      <option value="Other"
      <?php
        if($result['state'] == 'Other'){
            echo "selected";
        }
        ?>
      >Other</option>

    </select>
  </div>

<!-- LANGUAGE (Checkboxes)-->
<div class="input-field col-md-6">
    <label for="inputGender4" class="form-label">Language</label>
    <?php $languages = explode(", ", $result['language']); // Convert string to array ?>
    <input type="checkbox" name="language[]" value="Hindi"
    <?php if(in_array("Hindi", $languages)) echo "checked"; ?>
    ><label style="margin: 0 6px 0 1px;" >Hindi</label>
    <input type="checkbox" name="language[]" value="English" 
    <?php if(in_array("English", $languages)) echo "checked"; ?>
    ><label style="margin: 0 6px 0 1px;">English</label>
</div>
<!-- EMAIL -->
<div class="input-field col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" value="<?php echo $result['email']; ?>" class="form-control" id="inputEmail4" name="email" required>
  </div>
<!-- PHONE NUMBER -->
  <div class="input-field col-md-6">
    <label for="inputPnumber4" class="form-label">Phone number</label>
    <input type="text" value="<?php echo $result['phoneno']; ?>" class="form-control" id="inputPnumber4" name="phone" required>
  </div>

<!-- ADDRESS -->
  <div class="input-field col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <textarea class="form-control" id="inputAddress" name="address" required><?php echo $result['address']; ?>
    </textarea>
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
    <input type="submit" value="Update" class="btn btn-primary" name="update">
  </div>
</form>


        </div>
    </div>
</div>
    
</body>
</html>


<?php

if(isset($_POST['update']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pwd = $_POST['password'];
  $cpwd  = $_POST['conpassword'];
  $gender = $_POST['gender'];
  $state = $_POST['state'];

  $lang = $_POST['language'];
  $lang1 = implode(", ",$lang);
  //echo $lang1;

  $email  = $_POST['email'];
  $phone  = $_POST['phone'];
  $address = $_POST['address'];

  //$query = "INSERT INTO form (fname, lname, password, cpassword, gender, state, email, phoneno, address) VALUES('$fname', '$lname', '$pwd', '$cpwd', '$gender', '$state', '$email', '$phone', '$address')";

//Query for Updation
  $query = "UPDATE form set fname='$fname', lname='$lname',password='$pwd',cpassword='$cpwd',gender='$gender',
  state='$state',language='$lang1',email='$email',phoneno='$phone',address='$address' WHERE id='$id'";
  
  $data = mysqli_query($conn,$query);

  if($data){
    echo "<script>alert('Record Updated')</script>";
    ?>
    <meta http-equiv = "refresh" content = "2; url = http://localhost/registrationform/table.php" />

    <?php
  }
  else{
    echo "Failed to Update";
  }

}

?>

