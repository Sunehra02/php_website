<?php
require_once 'common/crud.php';
require_once 'common/auth.php';
$siteName = 'Kazi Sultana Sunehra';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = get_user_by_email(trim($_POST["email"]));

  if ($user && password_verify($_POST["password"], $user["password"])) {
    session_regenerate_id(true);
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["role"] = $user["role"];
    header("Location: view_contacts.php");
    exit;
  }
  $message = "Invalid email or password.";
}
require_once 'common/header.php';
?>
<section>
  <h2>Login</h2>
  <?php if ($message): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>
  <form method="POST" class="contact-form">
    <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
    <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
    <button type="submit" class="btn">Login</button>
  </form>
</section>
<?php require_once 'common/footer.php'; ?>