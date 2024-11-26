// Get the toggle button and menu
const toggleButton = document.getElementById("toggle-button");
const menu = document.querySelector(".menu");

// Add a click event listener to the toggle button
toggleButton.addEventListener("click", () => {
  // Toggle the 'active' class on the menu
  menu.classList.toggle("active");

  // Toggle the icon between 'fa-bars' (hamburger) and 'fa-times' (close)
  const icon = toggleButton.querySelector("i");
  if (menu.classList.contains("active")) {
    icon.classList.remove("fa-bars");
    icon.classList.add("fa-times");
  } else {
    icon.classList.remove("fa-times");
    icon.classList.add("fa-bars");
  }
});
