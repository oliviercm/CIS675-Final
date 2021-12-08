<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/google-material-icons.css">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="../../styles/product.css">
    <link rel="stylesheet" href="../../styles/footer.css">
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/header.php";?>
    <main>
        <div class="product">
            <div class="grid-container">
                <div class="grid-item" style="width: 256px; height: 256px; align-self: start;">
                    <img style="max-width: 256px; max-height: 256px;" id="product-listing-image">
                </div>
                <div class="grid-item">
                    <h3>
                        <span style="font-size: 1.2em;" id="product-listing-name">&ZeroWidthSpace;</span>
                        <br>
                        <br>
                        <p class="stars" id="product-listing-rating">Rating:</p>
                        <p class="stock" id="product-listing-stock">&ZeroWidthSpace;</p>
                        <label for="product-quantity">Qty: </label>
                        <select id="product-quantity" class="quantity" id="product-quantity" name="product-quantity">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <p class="price">Price: <span style="color: #b12704;" id="product-listing-price"></span></p>
                        About this item:
                    </h3>
                    <p class="description">
                        <div>
                            <ul id="product-listing-description"></ul>
                        </div>
                    </p>
                </div>
                <div class="grid-item">
                    <button id="add-to-cart-button" type="button" class="add-to-cart-button"><span class="material-icons">shopping_cart</span> Add to Cart</button>
                    <a><button type="button" class="buy-now-button">Buy Now</button></a>
                </div>
            </div>
        </div>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/footer.php";?>
    <script src="../../scripts/render-product-listing.js" type="module"></script>
</body>

</html>