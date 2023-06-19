function showCategory(data) {
    const select = document.createDocumentFragment();

    for (const key in data.categories) {
        const li = document.createElement('li');
        sHtml = `<a class="dropdown-item" href='index.php?category="${data.categories[key]}"'>${data.categories[key]}</a>`;
        li.innerHTML = sHtml;

        select.appendChild(li);
    }

    document.getElementById("scroll").appendChild(select);

}



fetch("data/categories.json")
    .then(response => response.json())
    .then(data => showCategory(data));
