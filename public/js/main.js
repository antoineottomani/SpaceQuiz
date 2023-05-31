// Suppression de catégorie
const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");
const confirmDeleteBtn = document.querySelector(".confirm-delete");
const deleteBtn = document.querySelector(".btn-delete");

let id;
let section;
modalTriggers.forEach((trigger) =>
  trigger.addEventListener("click", (e) => {
    modalContainer.classList.toggle("active");
    id = e.srcElement.attributes[1]["value"];
    section = document.getElementById("section").getAttribute("value");
    document.getElementById("id-selected-" + section).setAttribute("value", id);
  })
);

confirmDeleteBtn.addEventListener("click", () => {
  document.location.href = "?page=delete_" + section + "&id=" + id;
});
