function createTableRow({name, description, category, id}){
    console.log('123')
    let tr = document.createElement("tr");
    tr.innerHTML = `<tr>
            <td> ${name} </td>
            <td> ${description} </td>
            <td> ${category} </td>
            <td> <a href="#" class="btn btn-outline-primary btn-sm"> Подробно </a> </td>
         </tr>`;

    return tr;
}

function clearContainer(container){
    container.innerHTML = "";
}

