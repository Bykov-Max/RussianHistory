let flag = true;
let elements = [];

async function getElements() {
    let response = await fetch('/admin/elements/all');
    let data = await response.json();

    console.log(data);
    return data;
}

async function getFilterElements(category){
    let response = await fetch('/admin/elements/filter/'+category);
    console.log(response)
    let data = await response.json()
    console.log(data)
    return data.elements;
}

async function loadFilterElements(category = 0) {
    if(category == 0){
        elements = await getElements();
    }
    else{
        elements = await getFilterElements(category);
    }
    document.querySelector('#countElements').textContent = "Элементов найдено: "+elements.length;
    return elements;
}

function sortArray(array, property) {
    array.sort((item1, item2) => {
        if (item1[property] > item2[property]) {
            return 1;
        }

        if (item1[property] < item2[property]) {
            return -1;
        }

        return 0;
    });
}

document.querySelector("#orderName").addEventListener('click', function (e) {
    e.target.innerHTML = flag ? '&darr;' : '&uarr;';

    flag ? sortArray(elements, 'name') : elements.reverse();

    renderElements(elements);
    flag = !flag;
});


document.querySelector('#categories').addEventListener('change', async (e)=>{
    let categoryValue = e.target.value;
    elements = await loadFilterElements(categoryValue);
    renderElements(elements);
});
