function createTableRow2({name, category, description, id}) {
    let path = '/admin/elements/edit/'+id;
    let path2 = '/admin/elements/'+id;
    return `<tr style="border: 2px solid black">
                        <td> ${name} </td>
                        <td> ${description.substring(0,101)} </td>
                        <td> ${category} </td>
                        <td> <a href="${path}" class="btn btn-outline-primary btn-sm"> Изменить </a> </td>
                        <td> <form action='${path2}' method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Вы действительно хотите удалить информацию?');"
                                        name="deleteBtn" class="buttonDel">
                                        Удалить
                                </button>
                               </form>
                        </td>
                    </tr>`;
}

function clearContainer(container){
    container.innerHTML = "";
}

