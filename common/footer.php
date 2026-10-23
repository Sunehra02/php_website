<footer>
  <div class="col"><h4><?php echo $siteName ?? 'Rimjhim Sunehra'; ?></h4><p>Building things, one project at a time.</p></div>
  <div class="col"><h4>Explore</h4><a href="#projects">Projects</a><a href="#experience">Experience</a>
  <a href="#contact">Contact</a></div>
  <div class="col"><h4>Elsewhere</h4><a href="https://github.com/Kazi Sultana Sunehra02s">GitHub</a></div>
  <div class="bottom">&copy; <?php echo date('Y'); ?> <?php echo $siteName ?? 'Rimjhim Sunehra'; ?></div>
</footer>
<script>
const toggle = document.getElementById('navToggle'), nav = document.getElementById('siteNav');
toggle.addEventListener('click', () => { const open = nav.classList.toggle('open'); toggle.classList.toggle('open', open); 
toggle.setAttribute('aria-expanded', open); });
nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { nav.classList.remove('open'); 
toggle.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }));
</script>
</body>
</html>