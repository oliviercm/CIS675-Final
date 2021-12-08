<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/google-material-icons.css">
    <link rel="stylesheet" href="./styles/header.css">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/footer.css">
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/header.php";?>
    <div class="grid-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <span style="font-size: 1.2em;">Administration</span>
                <hr>
                <ul id="sidebar-button-list">
                    <li>
                        <a id="all-locations-button">All Locations</a>
                    </li>
                    <li>
                        <a id="all-products-button">All Products</a>
                    </li>
                    <li>
                        <a id="all-employees-button">All Employees</a>
                    </li>
                    <li>
                        <a id="all-customers-button">All Customers</a>
                    </li>
                    <li>
                        <a id="current-managers-button">Current Managers</a>
                    </li>
                    <li>
                        <a id="employee-count-button">Employee Count Per Location</a>
                    </li>
                    <li>
                        <a id="employee-high-salary-button">Employees with Salary > $100,000</a>
                    </li>
                    <li>
                        <a id="location-exclusive-products-button">Products exclusive to Location IDs 1, 2, 3</a>
                    </li>
                    <li>
                        <a id="customer-total-purchases-button">Total Purchases per Customer</a>
                    </li>
                    <li>
                        <a id="products-in-stock-button">Products in Stock</a>
                    </li>
                    <li>
                        <a id="products-not-in-stock-button">Products not in Stock</a>
                    </li>
                </ul>
            </nav>
        </div>
        <main>
            <div class="main-table-container">
                <table id="main-table"></table>
            </div>
        </main>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/footer.php";?>
    <script src="./scripts/main.js" type="module"></script>
</body>

</html>