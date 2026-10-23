<section id="projects">
  <p class="eyebrow dark">Projects</p>
  <h2>Things I've built</h2>
  <?php $projects = [
    ['title' => 'Restaurant Management System', 'desc' => 'A complete restaurant management system built with Python and 
    Tkinter.', 'link' => 'https://github.com/Kazi Sultana Sunehra02/restaurant-management-system'],
    ['title' => 'DBMS for a Restaurant Management System', 'desc' => 'A database management system for restaurants, designed 
    to handle inventory, orders, and customer data.', 'link' => 'https://github.com/Kazi Sultana Sunehra02/DBMS-for-a-Restaurant-Management-System'],
    ['title' => 'Tic Tac Toe — Python', 'desc' => 'A simple implementation of the classic Tic Tac Toe game using Python and 
    Tkinter.', 'link' => 'https://github.com/Kazi Sultana Sunehra02/Tic-Tac-Toe-using-Python'],
    ['title' => 'Pac-Man Clone — C++', 'desc' => 'A simple implementation of the classic Pac-Man game using C++ and graphics 
    libraries.', 'link' => 'https://github.com/Kazi Sultana Sunehra02/pac-man-clone-with-cpp-graphics'],];?>

  <div class="project-grid">
    <?php foreach ($projects as $project): ?>
      <div class="card project-card">
        <h3><?php echo htmlspecialchars($project['title']); ?>
      </h3>
        <p>
          <?php echo htmlspecialchars($project['desc']); ?>
        </p>
        <a href="<?php echo htmlspecialchars($project['link']); 
        ?>">GitHub Link →</a></div><?php endforeach; ?>
  </div>
</section>
