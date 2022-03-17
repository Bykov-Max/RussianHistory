let godsName = document.querySelector(".godsName");
let godsDescr = document.querySelector(".godsDescr");

godsName.addEventListener("click", function(){
    godsDescr.hidden = !godsDescr.hidden;
});