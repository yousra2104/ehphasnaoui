// back-to-top.js
document.addEventListener('DOMContentLoaded', function () {
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
      window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
          backToTop.classList.add('active');
        } else {
          backToTop.classList.remove('active');
        }
      });
  
      backToTop.addEventListener('click', function () {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }
  });