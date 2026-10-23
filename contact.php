<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "portfolio_db";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn){
  die("Database connection failed: ". mysqli_connect_error());
}
?>
<section id="contact">
  <p class="eyebrow dark">Contact</p>
  <h2>Let's talk</h2>
  <p class="lead">Feel free to reach out — I'm always open to talking about new projects, opportunities, or just connecting.</p>

  <?php
  $message = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = trim($_POST["name"]);
      $phone = trim($_POST["phone"]);
      $email = trim($_POST["email"]);
      $address = trim($_POST["address"]);
      $github = trim($_POST["github"]);
      $linkedin = trim($_POST["linkedin"]);

      if (empty($name) || empty($phone) || empty($email) || empty($address)) {
          $message = "Please fill in all required fields.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $message = "Please enter a valid email address.";
      } else {
          // Prepared statement prevents SQL injection
          $stmt = mysqli_prepare($conn, "INSERT INTO contacts (name, phone, email, address, github, linkedin) VALUES (?, ?, ?, ?, ?, ?)");
          mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $email, $address, $github, $linkedin);

          if (mysqli_stmt_execute($stmt)) {
              $message = "Thank you! Your message has been saved successfully.";
          } else {
              $message = "Error: " . mysqli_error($conn);
          }
          mysqli_stmt_close($stmt);
      }
  }
?>
  <?php if ($message): ?>
    <p class="form-message"><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>

  <form method="POST" action="" class="contact-form">
    <div class="form-group">
      <label for="name">Name *</label>
      <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="phone">Phone *</label>
      <input type="text" id="phone" name="phone" required>
    </div>
    <div class="form-group">
      <label for="email">Email *</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="address">Address *</label>
      <input type="text" id="address" name="address" required>
    </div>
    <div class="form-group">
      <label for="github">GitHub (optional)</label>
      <input type="text" id="github" name="github">
    </div>
    <div class="form-group">
      <label for="linkedin">LinkedIn (optional)</label>
      <input type="text" id="linkedin" name="linkedin">
    </div>
    <button type="submit" class="btn">Submit</button>
  </form>
</section>