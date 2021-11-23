import {
    renderDataInTable,
} from "./render-table-data.js";

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

document.getElementById("all-employees-button").onclick = handleGetEmployees;

async function handleGetEmployees(event) {
    try {
        setSelectedSidebarButton(event.target);
        renderDataInTable(await getEmployees());
    } catch(e) {
        console.error(e);
    };
};
async function getEmployees() {
    const response = await fetch("/php/employees.php");
    if (response.status < 200 || response.status >= 300) {
        throw Error(response.statusText);
    };
    const result = await response.json();
    return result;
};