let burger = document.querySelector(".burger");
let blockMenu = document.querySelector(".block-menu");
//let up = document.querySelector("button");

burger.addEventListener("click", function(){
    blockMenu.classList.toggle("active");
    blockMenu.classList.toggle("block-menu");
    burger.classList.toggle("activeBurger");
});