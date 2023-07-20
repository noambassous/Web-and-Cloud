function showCategory_ended(data) {
    const select = document.createDocumentFragment();

    for (const key in data.event_type) {
        const li = document.createElement('li');
        sHtml = `<a class="dropdown-item" href='endedEvents.php?event_type="${data.event_type[key]}"'>${data.event_type[key]}</a>`;
        li.innerHTML = sHtml;

        select.appendChild(li);
    }

    document.getElementById("scroll").appendChild(select);

}



fetch("data/categories.json")
    .then(response => response.json())
    .then(data => showCategory_ended(data));
