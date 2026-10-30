<?php
require_once 'common/crud.php';
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
    create_contact($name, $phone, $email, $address, $github, $linkedin);
    $message = "Thank you! Your message has been saved successfully.";
  }
}
?>
<section id="contact">
  <p class="eyebrow dark">Contact</p>
  <h2>Let's talk</h2>
  <p class="lead">Feel free to reach out. I'm always open to talking about new projects, opportunities, or just connecting.</p>

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