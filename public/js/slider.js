function createTableRow2({name, description, category_id}) {
    if(category_id == 1){
        return `<h1> ${name} </h1>
                <p class="description"> ${description.substring(0, 300)} </p>`;
    }
}

async function getElement() {
    let response = await fetch('/elements');

    let data = await response.json();

    return data;
}

function renderElements(elements) {
    let history = document.querySelector('.res')

    let res = "";
    elements.forEach((element) => {
        res += createTableRow2(element);
    })
    history.innerHTML = res;
}

async function loadElement() {
    elements = await getElement();
    return elements;
}

async function start() {
    elements = await loadElement();
    renderElements(elements)
}

start();



// let descr = document.querySelector('.description');
//
// console.log(descr);
// console.log('!!!!='+descr.innerHTML);










// let slider = document.querySelector(".slider");
// let track = document.querySelector(".slider_track");
// let prev = document.querySelector(".btn_prev");
// let next = document.querySelector(".btn_next");
//
// let ind = 0;
// let position = 0;
//
// function setPosition(){
//     track.style.transform = `translateX(${position}px)`
// }
//
//
// img.forEach(function (item){
//     let image = document.createElement("img");
//     image.classList.add("img");
//     image.setAttribute("src", item);
//     image.style.minWidth = "600px";
//     track.append(image);
// });
//
//
// next.addEventListener("click", function() {
//     if(ind == 3){
//         next.disabled = true;
//     }
//
//     else{
//         prev.disabled = false;
//         position-=600;
//         setPosition();
//         ind++;
//     };
// });
//
// prev.addEventListener("click", function() {
//     if(ind == 0){
//         prev.disabled = true;
//     }
//
//     else{
//         next.disabled = false;
//         position+=600;
//         setPosition();
//         ind--;
//     }
// });
