var container;
var category;
var currentPage = 'Home';
var plantObjects = [];

document.addEventListener('DOMContentLoaded', function() {
    initializeEventListeners();
    container = document.getElementById('container');
    category = document.getElementById('category');
    pageLoader('Home');
});

function initializeEventListeners() {
    var navbarItems = document.querySelectorAll('#navbar li');
    navbarItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var itemType = this.dataset.name;
            currentPage = itemType;
            pageLoader(itemType);
        });
    });
    
    var searchButton = document.querySelector('.searchButton');
    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        currentPage = 'Search';
        pageLoader('Search');
    });
}

function pageLoader(currentPage) {
    switch(currentPage) {
        case 'Home':
            category.innerHTML = ` 
                <h1 class='category'>Our Best Sellers</h1>
            `;                                          
            container.innerHTML = ``;
            fetchProducts(currentPage);
        break;
        case 'Search':
            //displaySortBar();
            category.innerHTML = ``;
            container.innerHTML = ``;
            var searchInput = document.getElementById('Search');
            displaySearchResults(searchInput.value);
            break;
        case 'All':
        case 'Flower':
        case 'Tree':
        case 'Shrub':
            displaySortBar();
            container.innerHTML = '';
            fetchProducts(currentPage);
            break;
    }
}

function displaySortBar() {
    category.innerHTML = `
    <div class="container">
        <form class="sortSelect" id="sortSelect">
            <label for="sortBy">Sort By:</label>
            <select name="sortBy" id="sortBy" form="sortSelect">
                <option value="ASCPrice">Lowest to Highest Price</option>
                <option value="DESCPrice">Highest to Lowest Price</option>
                <option value="ASCLetters">Plant Name A-Z</option>
                <option value="DESCLetters">Plant Name Z-A</option>
                <option value="ASCQuantAvail">Lowest to Highest # Available</option>
                <option value="DESCQuantAvail">Highest to Lowest # Available</option>
            </select>
            <input type="button" value="SORT" class="sortButton" onclick="sortByForm()">
        </form>
    </div>
    `;
}

function sortByForm() {
    var sortBy = document.getElementById('sortBy').value;

    fetch('./assets/php/plantData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'sortBy=' + sortBy + '&currentPage=' + currentPage,
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response form server:', data);
        if (Array.isArray(data)) {
            plantObjects = [];
            container.innerHTML = '';
            parseItems(data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function displaySearchResults(searchQuery) {
    fetch('./assets/php/plantData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'Search=' + encodeURIComponent(searchQuery),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response from server:', data);
        if (Array.isArray(data)) {
            plantObjects = [];
            parseItems(data);
        }
        else {
            container.innerHTML = "No results found";
        }
    })
    .catch(error => {
        console.error('error', error);
    });
}

function fetchProducts(itemType) {
    fetch('./assets/php/plantData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'itemName=' + encodeURIComponent(itemType),
    })
    .then(response => response.json())
    .then(data => {
        plantObjects = [];
        parseItems(data);
    })
    .catch(error => {
        console.error('error', error);
    })
}

function parseItems(data) {                 //parses json items into plant objects
    data.forEach(item => {
        const plantObject = {
            name: item.name,
            type: item.type,
            description: item.desc,
            image: item.imgURL,
            price: item.price,
            quantity: item.quantity,
            quantityAvailable: item.quantityAvailable
        }
        plantObjects.push(plantObject);
    });

    plantObjects.forEach(plant => {
        const cardElement = createCard(plant);
        container.appendChild(cardElement);
    });
}

function createCard(plant) {
    const cardElement = document.createElement('div');
    cardElement.classList.add('card');

    const plantElement = document.createElement('div');
    plantElement.classList.add('cardbody');

    plantElement.innerHTML = `
    <div class="card">
        <div class="cardbody">
            <img src='${plant.image}' alt="" class="cardimage" width="150px">
                <h2 id="itemName" class="cardtitle">${plant.name}</h2>
                <p id="itemDesc" class="carddescription">${plant.description}</p>
                <p id="itemPrice" class="cardprice">$${plant.price}</p>
                <p id="itemQuantity" class="cardquantityAvail">Quantity Available: ${plant.quantityAvailable}</p>
        </div>
        <form action="./assets/php/plantData.php" method="post" class="addToCartForm">
            <input type="hidden" name="addToCart" value="${plant.name}">
            <button type="submit" class="cardbutton">Add to cart</button>
        </form>
    </div>
    `;

    const addToCartForm = plantElement.querySelector('.addToCartForm');
    addToCartForm.addEventListener('submit', function(event) {
        console.log('atc button triggered');
        event.preventDefault(); 
        addToCart(plant.name);
    });

    cardElement.appendChild(plantElement);
    return cardElement;
}

function addToCart(plantName) {
    fetch('./assets/php/plantData.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'addToCart=' + encodeURIComponent(plantName),
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from server:', data);
    })
    .catch(error => {
        console.error('error', error);
    });

    console.log('added to cart', plantName); 
}
