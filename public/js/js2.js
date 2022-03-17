let burger = document.querySelector(".burger");
let blockMenu = document.querySelector(".block-menu");

burger.addEventListener("click", function(){
    blockMenu.classList.toggle("active");
    burger.classList.toggle("activeBurger");
});

let divPoint = document.querySelectorAll(".block-menu a");

divPoint.forEach(item =>{
    item.addEventListener("click", function(e){
        e.preventDefault();
        let id = e.target.getAttribute("href");
        document.querySelector(id).scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    });
});
