// Portfolio Jon Do — scripts
window.addEventListener('load', () => document.getElementById('loader')?.classList.add('hide'));
const header = document.querySelector('.site-header');
const toTop = document.querySelector('.to-top');
const onScroll = () => {
  header.classList.toggle('scrolled', window.scrollY > 40);
  toTop.classList.toggle('show', window.scrollY > 300);
};
window.addEventListener('scroll', onScroll); onScroll();
document.getElementById('year').textContent = new Date().getFullYear();
// Barres de compétences animées à l'apparition
const io = new IntersectionObserver(entries => entries.forEach(e => {
  if (e.isIntersecting) { e.target.classList.add('on'); io.unobserve(e.target); }
}), { threshold: .4 });
document.querySelectorAll('.bar').forEach(b => io.observe(b));
// Fermer le menu mobile au clic sur un lien
document.querySelectorAll('#menu .nav-link').forEach(a => a.addEventListener('click', () => {
  const m = bootstrap.Offcanvas.getInstance(document.getElementById('menu')); m && m.hide();
}));
if (window.AOS) AOS.init({ duration: 800, once: true });
