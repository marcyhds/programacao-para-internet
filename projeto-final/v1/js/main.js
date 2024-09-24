document.addEventListener('DOMContentLoaded', function () {
  const nodeMain = document.getElementById("paginaInicial")
  const nodeButton = document.querySelector("button")
  const nodeBody = document.querySelector("body")
  nodeButton.addEventListener("click", e => {
    e.preventDefault()
    nodeBody.style.overflow = 'visible'
    nodeMain.style.visibility = 'visible'
  })
})