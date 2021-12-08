document.getElementById("buy-now-button").onclick = handleBuyProduct;

async function handleBuyProduct(event) {
    event.preventDefault();

    const productId = new URLSearchParams(window.location.search).get("id");
    const productQuantity = document.getElementById("product-quantity").value;

    const requestBody = {
        productId: productId,
        customerId: 1,
        quantity: productQuantity,
    };
    const response = await fetch("/php/purchase.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(requestBody),
    });
    if (200 <= response.status && response.status < 300) {
        alert("Purchase successful.");
        window.location.reload();
    } else {
        alert(await response.text() || "Error.");
        window.location.reload();
    };
};