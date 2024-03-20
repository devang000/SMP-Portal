const sidePanel = document.querySelector(".side-panel");
const mainContent = document.querySelector(".main-content");

document.addEventListener("DOMContentLoaded", function () {
  const openPanelButton = document.createElement("button");
  openPanelButton.classList.add("open-panel-button");
  openPanelButton.textContent = "☰";
  document.body.appendChild(openPanelButton);

  openPanelButton.addEventListener("click", function () {
    sidePanel.classList.toggle("active");
    mainContent.classList.toggle("active");
  });
});
