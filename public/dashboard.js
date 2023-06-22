document.addEventListener("DOMContentLoaded", () => {
    search();
});

function search() {
    const search = document.getElementById('search').value;

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "/search/" + search, false);
    xhttp.send();
    const response = JSON.parse(xhttp.responseText);
    const table = document.getElementById('rows');
    table.innerHTML = '';
    for (let i = 0; i < response.length; i++) {
        let row = response[i];
        table.innerHTML += '<tr><td>' + row.id + '</td><td>' + row.name + '</td><td>' + row.year + '</td>' +
            '<td class="actions"><a href="/form/' + row.id + '">Labot</a><a href="/delete/' + row.id + '">Dzēst</a></td>'
    }
}
