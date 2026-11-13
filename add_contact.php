<?php
require_once 'common/crud.php';
require_once 'common/auth.php';
require_admin();
$siteName = 'Kazi Sultana Sunehra';
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
    header("Location: view_contacts.php?added=1");
    exit;
  }
}
require_once 'common/header.php';
?>
<section>
  <h2>Add contact</h2>
  <?php if ($message): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" class="contact-form">
    <?php foreach (["name", "phone", "email", "address", "github", "linkedin"] as $f): ?>
      <div class="form-group">
        <label><?= ucfirst($f) ?></label>
        <input type="text" name="<?= $f ?>" value="<?= htmlspecialchars($_POST[$f] ?? "") ?>">
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn">Add Contact</button>
  </form>
</section>
<?php require_once 'common/footer.php'; ?>