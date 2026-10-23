<section id="extracurricular"><p class="eyebrow dark">Extracurricular</p>
  <h2>Leadership &amp; involvement</h2><?php $roles = [
    ['title' => 'General Secretary — CCE Club Female Chapter', 'period' => 'Autumn 2026 — Present'],
    ['title' => 'Assistant General Secretary-II — CCE Club Female Chapter', 'period' => 'Spring 2025 — Spring 2026'],
    ['title' => 'Assistant Chief Executive-II — CCE Club Female Chapter', 'period' => 'Autumn 2024 — Spring 2025'],];?>
  <div class="timeline"><?php foreach ($roles as $role): ?><div class="timeline-item">
        <h3><?php echo htmlspecialchars($role['title']); ?></h3>
        <p><?php echo htmlspecialchars($role['period']); ?></p></div><?php endforeach; ?></div></section>
