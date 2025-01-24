document.addEventListener('DOMContentLoaded', function () {
  // Redirection du logo vers la page d'accueil
  document
    .querySelector('.custom-logo-link')
    .addEventListener('click', function (e) {
      e.preventDefault() // Annule l'action par défaut si nécessaire
      window.location.href = '/' // Redirige vers la page d'accueil
    })

  // Interaction pour le hamburger-menu
  const hamburgerMenu = document.getElementById('hamburger-menu')
  const menuToggle = document.getElementById('menu-toggle')
  const body = document.querySelector('body')

  // Lorsque le hamburger-menu est cliqué
  hamburgerMenu.addEventListener('click', function () {
    // Ajouter ou retirer la classe "open" pour afficher ou masquer le menu
    hamburgerMenu.classList.toggle('open')
    menuToggle.classList.toggle('open')
    body.classList.toggle('no-scroll') // Bloquer le défilement du body lorsque le menu est ouvert
  })
})
