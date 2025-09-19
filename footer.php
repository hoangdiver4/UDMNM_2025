<?php
// Contains the footer.
?>

<!-- ==== FOOTER GIAO DIỆN ==== -->
<footer class="site-footer">
  <div class="footer-container">
    <!-- Logo + mô tả -->
    <div class="footer-col">
      <div class="footer-logo">
        <a href="http://robiz.local" target="_top"><img src="http://robiz.local/wp-content/uploads/2025/09/cropped-Couchly-black-1-32x32.png" srcset="http://robiz.local/wp-content/uploads/2025/09/cropped-Couchly-black-1-150x150.png 2x" width="32" height="32" alt="" class="wp-embed-site-icon"></a>
        <span class="footer-title">COUCHLY</span>
      </div>
      <p>
        Bring rustic charm into your home with our cozy furniture. Explore our collection of wooden tables,
        distressed finishes, and country-inspired designs.
      </p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
    <!-- Contact info -->
    <div class="footer-col">
      <h3>Contact info</h3>
      <p><i class="fas fa-map-marker-alt"></i> 2972 Westheimer Rd.<br>Santa Ana, Illinois 85486</p>
      <p><i class="fas fa-envelope"></i> hello@eternaspark.com</p>
    </div>

    <!-- Collection -->
    <div class="footer-col">
      <h3>Collection</h3>
      <ul>
        <li><a href="#">Living Room Furniture</a></li>
        <li><a href="#">Bedroom Furniture</a></li>
        <li><a href="#">Dining Room Furniture</a></li>
        <li><a href="#">Office Furniture</a></li>
        <li><a href="#">Outdoor Furniture</a></li>
      </ul>
    </div>




    <!-- Insight -->
    <div class="footer-col">
      <h3>Insight</h3>
      <ul>
        <li><a href="http://robiz.local/">Home</a></li>
        <li><a href="http://robiz.local/pages/">Pages</a></li>
        <li><a href="http://robiz.local/shop/">Shop</a></li>
        <li><a href="http://robiz.local/blog/">Blog</a></li>
        <li><a href="http://robiz.local/contact/">Contact</a></li>
      </ul>
    </div>
  </div>

  <hr />

  <div class="footer-bottom">
    © 2025 Copyright by Kitpapa
  </div>
</footer>

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

