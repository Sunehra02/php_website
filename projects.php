<section id="projects">
  <p class="eyebrow dark">Projects</p>
  <h2>Things I've built</h2>
  <?php
  require_once 'common/crud.php';
  $dbProjects = get_admin_projects();
  ?>
  <div class="project-grid">
    <?php if (empty($dbProjects)): ?>
      <p>No projects added yet.</p>
    <?php endif; ?>
    <?php foreach ($dbProjects as $project): ?>
      <div class="card project-card">
        <img src="uploads/<?= htmlspecialchars($project["file"]) ?>" alt="<?= htmlspecialchars($project["title"]) ?>" style="width:100%; border-radius:12px; margin-bottom:12px;">
        <h3><?= htmlspecialchars($project["title"]) ?></h3>
        <p><?= htmlspecialchars($project["description"]) ?></p>
        <p class="meta"><?= htmlspecialchars($project["type"]) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
  <p style="margin-top:30px;"><a href="manage_projects.php" class="btn ghost">View all projects</a></p>
</section>