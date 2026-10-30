<?php
require_once 'common/crud.php';
$siteName = 'Kazi Sultana Sunehra';
$message = "";
$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

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
    update_contact($id, $name, $phone, $email, $address, $github, $linkedin);
    header("Location: view_contacts.php");
    exit;
  }
}

$contact = get_contact($id);
if (!$contact) die("Contact not found.");
require_once 'common/header.php';
?>
<section>
  <h2>Edit contact</h2>
  <?php if ($message): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" class="contact-form">
    <input type="hidden" name="id" value="<?= $contact["id"] ?>">
    <?php foreach (["name", "phone", "email", "address", "github", "linkedin"] as $f): ?>
      <div class="form-group">
        <label><?= ucfirst($f) ?></label>
        <input type="text" name="<?= $f ?>" value="<?= htmlspecialchars($contact[$f]) ?>">
      </div>
    <?php endforeach; ?>
    <button type="submit" class="btn">Update Contact</button>
  </form>
</section>
<?php require_once 'common/footer.php'; ?>