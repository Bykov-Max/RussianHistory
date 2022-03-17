let flag = true;
let users = [];

async function getUsers() {
    let response = await fetch('/admin/users/all');
    let data = await response.json();

    console.log(data);
    return data;
}

async function getFilterUsers(role){
    let response = await fetch('/admin/users/filter/'+role);
    console.log(response)
    let data = await response.json()
    console.log(data)
    return data.users;
}

async function loadFilterUsers(role = 0) {
    if(role == 0){
        users = await getUsers();
    }
    else{
        users = await getFilterUsers(role);
    }
    document.querySelector('#countUsers').textContent = "Пользователей найдено: "+users.length;
    return users;
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

    flag ? sortArray(users, 'full_name') : users.reverse();

    renderUsers(users);
    flag = !flag;
});

document.querySelector("#orderPost").addEventListener('click', function (e) {
    e.target.innerHTML = flag ? '&uarr;' : '&darr;';

    flag ? sortArray(users, 'posts_count') : users.reverse();

    renderUsers(users);
    flag = !flag;
});

document.querySelector('#roles').addEventListener('change', async (e)=>{
    let roleValue = e.target.value;
    users = await loadFilterUsers(roleValue);
    renderUsers(users);
});
