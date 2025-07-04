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
    <style>
      .photo-preview-container {
    text-align: center;
    margin-bottom: 25px;
}

.photo-preview-container img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    border: 3px solid #005cbf;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.photo-preview-container img:hover {
    transform: scale(1.05);
}

.photo-preview-name {
    margin-top: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

    </style>
</head>
<body>

<div class="container">
    <div class="title">
        UPDATE RECORDS
    </div>
    <div class="form">

    <form class="row g-3" action="#" method="POST" enctype="multipart/form-data">

    <div class="photo-preview-container">
        <label for="photoInput" style="cursor: pointer;" title="Click to change photo">
            <img id="photoPreview" src="uploads/image1_<?= htmlspecialchars($result['photo']) ?>" alt="Student Photo">
        </label>
        <input type="file" id="photoInput" name="photo" accept="image/png, image/jpeg" style="display: none;">
        <div class="photo-preview-name"><?= htmlspecialchars($result['id']) ?></div>
    </div>
    
<!-- hidden input - Carries the current user's ID -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">

<!-- FIRST NAME -->
    <div class="input-field col-md-6">
      <label for="inputFname4" class="form-label">First Name<span style="color: red;">*</span></label>
      <input type="text" value="<?php echo $result['fname']; ?>" class="form-control" id="inputFname4" name="fname" required>
    </div>

<!-- LAST NAME -->
  <div class="input-field col-md-6">
    <label for="inputLname4" class="form-label">Last Name<span style="color: red;">*</span></label>
    <input type="text" value="<?php echo $result['lname']; ?>" class="form-control" id="inputLname4" name="lname" required>
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
    <select id="inputState" class="form-select" name="state">
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
    <label for="inputEmail4" class="form-label">Email<span style="color: red;">*</span></label>
    <input type="email" value="<?php echo $result['email']; ?>" class="form-control" id="inputEmail4" name="email" required>
  </div>
<!-- PHONE NUMBER -->
  <div class="input-field col-md-6">
    <label for="inputPnumber4" class="form-label">Phone number<span style="color: red;">*</span></label>
    <input type="text" value="<?php echo $result['phoneno']; ?>" class="form-control" id="inputPnumber4" name="phone" required>
  </div>

<!-- ADDRESS -->
  <div class="input-field col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <textarea class="form-control" id="inputAddress" name="address" required><?php echo trim($result['address']); ?>
    </textarea>
  </div>

<!-- BUTTON -->
  <div class="input-field col-12">
    <input type="submit" value="Update" class="btn btn-primary" name="update">
  </div>
</form>


        </div>
    </div>
</div>

<script>
document.getElementById('photoInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>


<?php

if(isset($_POST['update']))
{
  $id     = $_POST['id'];
  $fname  = $_POST['fname'];
  $lname  = $_POST['lname'];
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
  $state  = isset($_POST['state']) ? $_POST['state'] : '';
  $lang   = isset($_POST['language']) ? $_POST['language'] : [];
  $lang1  = implode(", ", $lang);
  $email  = $_POST['email'];
  $phone  = $_POST['phone'];
  $address = isset($_POST['address']) ? $_POST['address'] : '';

  // Get old photo filename from DB
    $getOld = mysqli_query($conn, "SELECT photo FROM form WHERE id='$id'");
    $oldData = mysqli_fetch_assoc($getOld);
    $oldPhoto = $oldData['photo'];

    // Image Resize Function -
    function resizeImage($source, $destination, $new_width, $new_height, $ext) {
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($ext == 'png') {
            $image = imagecreatefrompng($source);
        } else {
            return false;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $resized = imagecreatetruecolor($new_width, $new_height);

        if ($ext == 'png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled($resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        if ($ext == 'jpg' || $ext == 'jpeg') {
            imagejpeg($resized, $destination, 90);
        } elseif ($ext == 'png') {
            imagepng($resized, $destination, 9);
        }

        imagedestroy($image);
        imagedestroy($resized);
    }

    $photoToUse = $oldPhoto;

    // If New Photo is selected
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $fileTmp = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
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
        $originalPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmp, $originalPath)) {
            $smallPath = $uploadDir . "image1_" . $newFileName;
            resizeImage($originalPath, $smallPath, 60, 60, $fileExt);

            $largePath = $uploadDir . "image2_" . $newFileName;
            resizeImage($originalPath, $largePath, 800, 800, $fileExt);

            // Remove old images if you want
            @unlink("uploads/" . $oldPhoto);
            @unlink("uploads/image1_" . $oldPhoto);
            @unlink("uploads/image2_" . $oldPhoto);

            $photoToUse = $newFileName;
        } else {
            die("<script>alert('New photo upload failed.'); window.history.back();</script>");
        }
    }

  $query = "UPDATE form SET fname='$fname', lname='$lname', gender='$gender',
            state='$state', language='$lang1', email='$email', phoneno='$phone', address='$address', photo='$photoToUse' WHERE id='$id'";

  $data = mysqli_query($conn, $query);

  if($data){
    echo "<script>alert('Record Updated!');</script>";
    echo "<meta http-equiv='refresh' content='2; url=table.php'>";
  } else {
    echo "<script>alert('Record Failed to Update!');</script>";
  }
}


?>

