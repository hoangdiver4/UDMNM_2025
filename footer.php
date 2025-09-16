<?php
// Contains the footer.
?>

<!-- Toggle menu script -->
<script>
document.addEventListener('DOMContentLoaded', function(){
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.main-navigation');

  if(toggle && nav){
    toggle.addEventListener('click', function(){
      nav.classList.toggle('show');
      // Đổi biểu tượng ☰ thành ✕ khi mở menu
      toggle.textContent = nav.classList.contains('show') ? '✕' : '☰';
    });
  }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
