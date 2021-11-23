import {
    renderDataInTable,
} from "./render-table-data.js";

/**
 * Get all elements with IDs matching keys in ```buttonUrlMappings``` and change their onClick events to
 * fetch and display data in the main table using the corresponding mapped value as a URL for a GET request.
 */

const buttonUrlMappings = {
    "all-locations-button": "/php/locations.php",
    "all-products-button": "/php/products.php",
    "all-employees-button": "/php/employees.php",
    "all-customers-button": "/php/customers.php",
    "current-managers-button": "/php/currentmanagers.php",
    "employee-count-button": "/php/employeecount.php",
};

for (const buttonId in buttonUrlMappings) {
    document.getElementById(buttonId).setAttribute("data-fetch-url", buttonUrlMappings[buttonId]);
    document.getElementById(buttonId).onclick = handleButtonClick;
};

async function handleButtonClick(event) {
    try {
        setSelectedSidebarButton(event.target);
        renderDataInTable(await fetchDataFromUrl(event.target.getAttribute("data-fetch-url")));
    } catch(e) {
        console.error(e);
    };
};

async function setSelectedSidebarButton(target) {
    try {
        const sidebarButtonList = document.getElementById("sidebar-button-list");
        for (const listElement of sidebarButtonList.children) {
            for (const listElementChild of listElement.children) {
                listElementChild.classList.remove("selected");
            };
        };
        target.classList.add("selected");
    } catch(e) {
        console.error(e);
    };
};

async function fetchDataFromUrl(url) {
    const response = await fetch(url);
    if (response.status < 200 || response.status >= 300) {
        throw Error(response.statusText);
    };
    const result = await response.json();
    return result;
};