<?php
require_once 'common/crud.php';
require_once 'common/auth.php';
$siteName = 'Kazi Sultana Sunehra';
$message = "";
$editProject = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_admin();
  $action = $_POST["action"] ?? "";
  if ($action === "delete") {
    $id = (int) $_POST["id"];
    $project = get_admin_project($id);
    if ($project && file_exists("uploads/" . $project["file"])) {
      unlink("uploads/" . $project["file"]);
    }
    delete_admin_project($id);
    $message = "Project deleted.";
  } elseif (in_array($action, ["create", "update"])) {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $type = trim($_POST["type"]);
    $id = (int) ($_POST["id"] ?? 0);

    if (empty($title) || empty($description)) {
      $message = "Title and description are required.";
    } else {
      $allowedTypes = ["jpg", "jpeg", "png", "pdf", "txt"];
      $hasNewFile = isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK;
      $newFileName = null;

      if ($hasNewFile) {
        $fileName = basename($_FILES["file"]["name"]);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $_FILES["file"]["size"];

        if (!in_array($extension, $allowedTypes)) {
          $message = "Invalid file type.";
        } elseif ($fileSize > 5 * 1024 * 1024) {
          $message = "File size must be under 5MB.";
        } else {
          $newFileName = bin2hex(random_bytes(16)) . "." . $extension;
          move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newFileName);
        }
      }

      if (empty($message)) {
        if ($action === "create") {
          if (!$newFileName) {
            $message = "Please choose a file to upload.";
          } else {
            create_admin_project($title, $description, $newFileName, $type);
            $message = "Project created successfully.";
          }
        } else {
          $existing = get_admin_project($id);
          $fileToSave = $newFileName ?: $existing["file"];
          update_admin_project($id, $title, $description, $fileToSave, $type);
          $message = "Project updated successfully.";
        }
      }
    }
  }
}

$editId = (int) ($_GET["edit"] ?? 0);
if ($editId > 0) {
  require_admin();
  $editProject = get_admin_project($editId);
}

$projects = get_admin_projects();
require_once 'common/header.php';
?>
<section class="wide">
  <?php if (is_admin()): ?>
  <h2><?= $editProject ? "Edit Project" : "Add Project" ?></h2>

  <?php if ($message): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="contact-form">
    <input type="hidden" name="action" value="<?= $editProject ? "update" : "create" ?>">
    <?php if ($editProject): ?>
      <input type="hidden" name="id" value="<?= $editProject["id"] ?>">
    <?php endif; ?>

    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($editProject["title"] ?? "") ?>" required>
    </div>
    <div class="form-group">
      <label>Description</label>
      <input type="text" name="description" value="<?= htmlspecialchars($editProject["description"] ?? "") ?>" required>
    </div>
    <div class="form-group">
      <label>Type</label>
      <select name="type">
        <option value="web-application">Web Application</option>
        <option value="mobile-app">Mobile App</option>
        <option value="software">Software</option>
        <option value="game">Game</option>
      </select>
    </div>
    <div class="form-group">
      <label>File <?= $editProject ? "(leave empty to keep current)" : "" ?></label>
      <input type="file" name="file" <?= $editProject ? "" : "required" ?>>
    </div>
    <button type="submit" class="btn"><?= $editProject ? "Update Project" : "Add Project" ?></button>
  <?php if ($editProject): ?>
    <a href="manage_projects.php" class="btn ghost">Cancel</a>
    <?php endif; ?>
  </form>
  <?php endif; ?>

  <h2 style="margin-top:50px;">All Projects</h2>
  <?php if (empty($projects)): ?>
    <p>No projects yet.</p>
  <?php else: ?>
    <div class="project-grid">
      <?php foreach ($projects as $p): ?>
        <div class="card project-card">
          <img src="uploads/<?= htmlspecialchars($p["file"]) ?>" alt="<?= htmlspecialchars($p["title"]) ?>" style="width:100%; border-radius:12px; margin-bottom:12px;">
          <h3><?= htmlspecialchars($p["title"]) ?></h3>
          <p><?= htmlspecialchars($p["description"]) ?></p>
          <p class="meta"><?= htmlspecialchars($p["type"]) ?></p>
          <?php if (is_admin()): ?>
             <a href="manage_projects.php?edit=<?= $p["id"] ?>">Edit</a>
            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this project?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $p["id"] ?>">
            <button type="submit" class="link-btn">Delete</button>
          </form>
        <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
<?php require_once 'common/footer.php'; ?>