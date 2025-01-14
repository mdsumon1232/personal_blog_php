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

// ------------------- search box ----------

const searchToggle  = document.getElementById("search-toggle");
const searchBox = document.getElementById('search-bar');
const magnifying = document.getElementById('magnifying');

searchToggle.addEventListener('click' , ()=>{
   searchBox.classList.toggle('toggle-display');

   if(searchBox.classList.contains('toggle-display')){
    magnifying.classList.remove('fa-magnifying-glass');
    magnifying.classList.add("fa-xmark")
   }
   else{
    magnifying.classList.add('fa-magnifying-glass');
    magnifying.classList.remove("fa-xmark")
   }
})