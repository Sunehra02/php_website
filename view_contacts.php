<?php
require_once 'common/crud.php';
require_once 'common/auth.php';
require_login();
$siteName = 'Kazi Sultana Sunehra';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_admin();
  $id = (int) $_POST["id"];
  if ($_POST["action"] == "delete") delete_contact($id);
  if ($_POST["action"] == "toggle") toggle_viewed($id);
}
$contacts = get_contacts();
require_once 'common/header.php';
?>
<section class="wide">
  <h2>Saved contacts</h2>
  <p>Logged in as <?= htmlspecialchars($_SESSION["name"]) ?> (<?= $_SESSION["role"] ?>)</p>

  <?php if (isset($_GET["added"])): ?><p class="form-message">Contact added successfully.</p><?php endif; ?>
  <?php if (isset($_GET["user_added"])): ?><p class="form-message">User added successfully.</p><?php endif; ?>

  <div style="display:flex; gap:12px; margin-bottom:20px; flex-wrap:wrap;">
    <?php if (is_admin()): ?>
      <a href="add_contact.php" class="btn ghost">Add Contact</a>
      <a href="add_user.php" class="btn ghost">Add User</a>
    <?php endif; ?>
    <a href="logout.php" class="btn">Logout</a>
  </div>

  <div class="table-wrap">
    <table class="contacts-table">
      <tr>
        <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>GitHub</th><th>LinkedIn</th><th>Status</th>
        <?php if (is_admin()): ?><th>Actions</th><?php endif; ?>
      </tr>
      <?php foreach ($contacts as $c): ?>
        <tr>
          <td><?= $c["id"] ?></td>
          <td><?= htmlspecialchars($c["name"]) ?></td>
          <td><?= htmlspecialchars($c["phone"]) ?></td>
          <td><?= htmlspecialchars($c["email"]) ?></td>
          <td><?= htmlspecialchars($c["address"]) ?></td>
          <td><?= htmlspecialchars($c["github"]) ?></td>
          <td><?= htmlspecialchars($c["linkedin"]) ?></td>
          <td class="<?= $c["viewed"] ? "badge-viewed" : "badge-new" ?>"><?= $c["viewed"] ? "Viewed" : "New" ?></td>
          <?php if (is_admin()): ?>
            <td>
              <a href="edit_contact.php?id=<?= $c["id"] ?>">Edit</a>
              <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $c["id"] ?>">
                <input type="hidden" name="action" value="toggle">
                <button type="submit" class="link-btn"><?= $c["viewed"] ? "Mark new" : "Mark viewed" ?></button>
              </form>
              <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this contact?');">
                <input type="hidden" name="id" value="<?= $c["id"] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="link-btn">Delete</button>
              </form>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</section>
<?php require_once 'common/footer.php'; ?>