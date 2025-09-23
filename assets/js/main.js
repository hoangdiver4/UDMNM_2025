document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.main-navigation');

  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      nav.classList.toggle('open');
    });
  }
});
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('userDropdownBtn');
    var wrapper = document.querySelector('.user-dropdown-wrapper');
    if(btn && wrapper) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            wrapper.classList.toggle('open');
        });
        document.addEventListener('click', function(e) {
            if (!wrapper.contains(e.target)) {
                wrapper.classList.remove('open');
            }
        });
    }
});