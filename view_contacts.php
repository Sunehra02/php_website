<?php
require_once 'common/crud.php';
$siteName = 'Kazi Sultana Sunehra';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  delete_contact((int) $_POST["id"]);}
$contacts = get_contacts();
require_once 'common/header.php';
?>
<section>
  <h2>Saved contacts</h2>
  <div class="table-wrap">
    <table class="contacts-table">
      <tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>GitHub</th><th>LinkedIn</th><th>Actions</th></tr>
      <?php foreach ($contacts as $c): ?>
        <tr>
          <td><?= $c["id"] ?></td>
          <td><?= htmlspecialchars($c["name"]) ?></td>
          <td><?= htmlspecialchars($c["phone"]) ?></td>
          <td><?= htmlspecialchars($c["email"]) ?></td>
          <td><?= htmlspecialchars($c["address"]) ?></td>
          <td><?= htmlspecialchars($c["github"]) ?></td>
          <td><?= htmlspecialchars($c["linkedin"]) ?></td>
          <td>
            <a href="edit_contact.php?id=<?= $c["id"] ?>">Edit</a>
            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this contact?');">
              <input type="hidden" name="id" value="<?= $c["id"] ?>">
              <button type="submit" class="link-btn">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</section>
<?php require_once 'common/footer.php'; ?>