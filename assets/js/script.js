document.addEventListener('DOMContentLoaded', function () {
  console.log('DOMContentLoaded a été déclenché')

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

  // Script pour la modale
  var modal = document.getElementById('contactModal')
  console.log(modal) // Vérifie si l'élément est correctement sélectionné

  // Sélectionner les deux liens CONTACT
  var btn1 = document.querySelector('#menu-item-59 > a')
  var btn2 = document.querySelector('#menu-toggle ul li:nth-child(3) a')

  // Fonction pour ouvrir la modale
  function openModal(event) {
    event.preventDefault() // Empêche le comportement par défaut du lien
    event.stopPropagation() // Arrête la propagation de l'événement

    // Fermer le menu toggle si nécessaire
    if (menuToggle.classList.contains('open')) {
      hamburgerMenu.classList.remove('open')
      menuToggle.classList.remove('open')
      body.classList.remove('no-scroll')
    }

    // Ouvrir la modale
    modal.style.display = 'block'
  }

  // Ajouter la fonction d'ouverture de la modale aux deux boutons
  if (btn1) {
    btn1.addEventListener('click', openModal)
  }
  if (btn2) {
    btn2.addEventListener('click', openModal)
  }

  // Fermer la modale si clic en dehors
  window.addEventListener('click', function (event) {
    if (event.target == modal) {
      modal.style.display = 'none'
    }
  })

  // Écouter l'événement de soumission réussie de CF7
  document.addEventListener(
    'wpcf7mailsent',
    function (event) {
      // Fermer la modale après 3 secondes
      setTimeout(function () {
        modal.style.display = 'none'
        // Rediriger vers la page d'accueil
        window.location.href = '/'
      }, 3000) // 3000 millisecondes = 3 secondes
    },
    false
  )
})
