import {
    renderDataInTable,
} from "./render-table-data.js";

/**
 * Get all elements with IDs matching keys in ```buttonUrlMappings``` and change their onClick events to
 * fetch and display data in the main table using the corresponding mapped value as a URL for a GET request.
 */

const buttonUrlMappings = {
    "all-locations-button": "/php/data/general/locations.php",
    "all-products-button": "/php/data/general/products.php",
    "all-employees-button": "/php/data/general/employees.php",
    "all-customers-button": "/php/data/general/customers.php",
    "current-managers-button": "/php/data/specific/currentmanagers.php",
    "employee-count-button": "/php/data/specific/employeecount.php",
    "employee-high-salary-button": "/php/data/specific/employeeswithhighsalary.php",
    "location-exclusive-products-button": "/php/data/specific/locationexclusiveproducts.php",
    "customer-total-purchases-button": "/php/data/specific/totalpurchasespercustomer.php",
    "products-in-stock-button": "/php/data/specific/productsinstock.php",
    "products-not-in-stock-button": "/php/data/specific/productsnotinstock.php",
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