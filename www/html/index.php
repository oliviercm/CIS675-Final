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
                <ul>
                    <li>
                        <a href="./index.php">All Locations</a>
                    </li>
                    <li>
                        <a href="./index.php">All Products</a>
                    </li>
                    <li>
                        <b>All Employees</b>
                    </li>
                    <li>
                        <a href="./index.php">All Customers</a>
                    </li>
                </ul>
            </nav>
        </div>
        <main>
            <div>
                Tabled data goes here
            </div>
        </main>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/footer.php";?>
</body>

</html>