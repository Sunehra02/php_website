<section id="skills">
  <p class="eyebrow dark">Skills</p>
  <h2>What I work with</h2>
  <p class="lead">
    I like figuring things out as I go — some of these I'm comfortable with,
    some I'm still exploring, and there's always something new on the list.
  </p><?php $skills = ['HTML', 'CSS', 'JavaScript', 'C', 'Python', 'SQL', 'MATLAB']; ?>
  <div class="skill-grid"><?php foreach ($skills as $skill): ?>
      <div class="card skill-tile"><?php echo htmlspecialchars($skill); ?></div>
    <?php endforeach; ?></div></section>