<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dentist Appointment</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
  <!-- Header -->
  <header class="header">
    <nav class="nav">
      <a href="#" class="nav_logo">Dentist Appointment</a>

      <ul class="nav_items">
        <!--<li class="nav_item">
            <a href="#" class="nav_link">Home</a>
            <a href="#" class="nav_link">Product</a>
            <a href="#" class="nav_link">Services</a>
            <a href="#" class="nav_link">Contact</a>
          </li>-->
      </ul>

      <button class="button" id="form-open">Make Appointment</button>
    </nav>
  </header>

  <!-- Home -->
  <section class="home">
    <div class="form_container">
      <i class="uil uil-times form_close"></i>
      <!-- Login From -->
      <div class="form login_form">
        <form action="appointment.php" method="POST">
          <h2>Appointment</h2>

          <div class="input_box">
            <input type="text" name="full_name" placeholder="username (if signed up)" required />
          </div>
          <div class="input_box">
            <input type="date" name="appointment_date" placeholder="Day of Appointment" required />
          </div>
          <div class="input_box">
            <input type="time" name="appointment_time" placeholder="Time of Appointment" required />
          </div>

          <button class="button">Confirm</button>

          <div class="login_signup">
            Is it your First Time? <a href="#" id="signup">Signup</a>
          </div>
        </form>
      </div>

      <!-- Signup From -->
      <div class="form signup_form">
        <form action="signup.php" method="POST">
          <h2>Signup</h2>
          <div class="input_box">
            <input type="text" name="name" placeholder="Enter your Full Name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
          </div>
          <div class="input_box">
            <input type="text" name="username" placeholder="Enter a username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" />
          </div>
          <div class="input_box">
            <input type="email" name="email" placeholder="Enter your Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
          </div>
          <div class="input_box">
            <input type="text" name="gender" placeholder="Male or female" required value="<?php echo isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : ''; ?>" />
          </div>
          <div class="input_box">
            <input type="date" name="birthday" placeholder="Enter your Date of birth" required value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : ''; ?>" />
          </div>
          <div class="input_box">
            <input type="text" name="address" placeholder="Enter your Address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" />
          </div>
          <div class="input_box" style="color: red;">
            <?php if (isset($_GET['error'])) : ?>
              <label><?php echo htmlspecialchars($_GET['error']); ?></label>
            <?php endif; ?>
            <?php if (isset($_GET['suggestions'])) : ?>
              <ul>
                <?php
                $suggestions = json_decode($_GET['suggestions']);
                foreach ($suggestions as $suggestion) : ?>
                  <li style="padding-left: 20px;"><?php echo htmlspecialchars($suggestion); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
          <button class="button">Signup</button>
          <div class="login_signup">
            Already a regular patient? <a href="#" id="login">Make Appointment</a>
          </div>
        </form>


      </div>
    </div>
  </section>
  <div class="footer">
    &copy; Copyright 2024. All rights reserved.
  </div>

  <script src="script.js"></script>
</body>

</html>