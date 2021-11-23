async function renderDataInTable(data) {
    const tableElement = document.getElementById("main-table");

    while (tableElement.firstChild) {
        tableElement.removeChild(tableElement.lastChild);
    };
    
    if (data.length > 0) {
        // Infer table header names from the first data element,
        // then append a header row to the table based on the inferred names.
        const tableHeaders = [
            ...(Object.keys((data.length ? (data[0] || {}) : {}))),
        ];
        if (tableHeaders.length) {
            const tableHeaderRow = tableElement.insertRow();
            for (const header of tableHeaders) {
                try {
                    const tableHeaderCell = document.createElement("th");
                    tableHeaderCell.appendChild(document.createTextNode(header));
                    tableHeaderRow.appendChild(tableHeaderCell);
                } catch(e) {
                    console.error(e);
                };
            };
        };
        
        for (const datum of data) {
            try {
                const tableRow = tableElement.insertRow();
                // Use the previously inferred array of headers to make sure that displayed data goes into the correct columns,
                // regardless of discrepancy in ordering of keys between data objects.
                // This also ensures that missing data is displayed as a blank cell.
                for (const header of tableHeaders) {
                    const cell = document.createElement("td");
                    cell.appendChild(document.createTextNode((datum[header] || "")));
                    tableRow.appendChild(cell);
                };
            } catch(e) {
                console.error(e);
            };
        };
    } else {
        console.error("Attempting to render table with empty data array.");
    };
};

export {
    renderDataInTable,
};