<?php
require_once 'common/crud.php';
require_once 'common/auth.php';
require_admin();
$siteName = 'Kazi Sultana Sunehra';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $role = $_POST["role"];

  if (empty($name) || empty($email) || empty($password)) {
    $message = "Please fill in all fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Please enter a valid email address.";
  } elseif (strlen($password) < 6) {
    $message = "Password must be at least 6 characters.";
  } elseif (!in_array($role, ["admin", "user"])) {
    $message = "Invalid role.";
  } elseif (get_user_by_email($email)) {
    $message = "This email is already registered.";
  } else {
    create_user($name, $email, $password, $role);
    header("Location: view_contacts.php?user_added=1");
    exit;
  }
}
require_once 'common/header.php';
?>
<section>
  <h2>Add user</h2>
  <?php if ($message): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>
  <form method="POST" class="contact-form">
    <div class="form-group"><label>Name</label><input type="text" name="name" required></div>
    <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
    <div class="form-group"><label>Password</label><input type="password" name="password" required></div>
    <div class="form-group">
      <label>Role</label>
      <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <button type="submit" class="btn">Add User</button>
  </form>
</section>
<?php require_once 'common/footer.php'; ?>