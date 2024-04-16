/**
 * Attaches an event listener to the search input field to filter countries by name.
 * 
 * This function listens for input events on the search input field. It retrieves the value entered by the user and filters the list of countries based on their alternative text (alt attribute). The filter is case-insensitive, allowing partial matches. Countries whose alternative text contains the entered value remain visible, while others are hidden.
 */
let search_input = document.getElementById("search_input")
search_input.addEventListener("input", function(event){
    let countries = document.querySelectorAll(".img");
    countries.forEach(function(country){
        country.classList.add("hidden")
        if(country.getAttribute('alt').toLowerCase().includes(event.target.value.toLowerCase())){
            country.classList.remove("hidden")
        }
    })
})


/**
 * Implements a functionality for scrolling to the top of the page and displaying a scroll-to-top button.
 * 
 * This script attaches event listeners to a scroll-to-top element and the window object. When the scroll-to-top element is clicked, it smoothly scrolls the window to the top of the page. Additionally, it monitors the scroll position of the window. When the user scrolls down more than 100 pixels, a scroll-to-top button container is displayed; otherwise, it is hidden.
 */
let arrow_scroll_top = document.getElementById("arrow_scroll_top")
arrow_scroll_top.addEventListener("click", function(){
    window.scrollTo({
        top: 0,
        bottom: 0,
        behavior: "smooth"
    });
})
let arrow_scroll_top_container = document.getElementById("arrow_scroll_top_container")
window.addEventListener("scroll", function(){
    if(window.scrollY > 100){
        arrow_scroll_top_container.classList.remove("hidden");
    } else {
        arrow_scroll_top_container.classList.add("hidden");
    }
});
