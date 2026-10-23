<section id="experience"><p class="eyebrow dark">Experience</p>
  <h2>Teaching &amp; mentoring</h2>
  <?php
  $experience = [
    ['title' => 'Teaching Assistant — CCE-1106', 'desc' => 'I assist the course teacher with conduction the class, grading lab 
    reports, and helping students with their assignments.'],
    ['title' => 'Teaching Assistant — CCE-4830', 'desc' => 'I assist the course teacher with conduction the class and explaining 
    machine learning codes to students.'],
    ['title' => 'Teaching Assistant — CCE-2310', 'desc' => 'I assist the course teacher with grading lab reports, and helping 
    students with their assignments.'],
    ['title' => 'Former Teaching Assistant — CCE-3506', 'desc' => 'I assisted the course teacher with grading, noting students 
    performance, taking presentations'],];?>
  <div class="timeline"><?php foreach ($experience as $item): ?>
      <div class="timeline-item">
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
        <p><?php echo htmlspecialchars($item['desc']); ?></p>
      </div><?php endforeach; ?></div></section>
