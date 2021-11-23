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
            <div class="main-table-container">
                <table>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Salary</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Malcom</td>
                        <td>McDuff</td>
                        <td>10 Castle Drive, London</td>
                        <td>4085552241</td>
                        <td>55780.71</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Fleance</td>
                        <td>Banquo</td>
                        <td>77 Rampart Way, London</td>
                        <td>4085558810</td>
                        <td>70213.88</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Lord</td>
                        <td>Macbeth</td>
                        <td>1 Scotland Yard, London</td>
                        <td>4085556312</td>
                        <td>80123.56</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Lady</td>
                        <td>Macbeth</td>
                        <td>1 Scotland Yard, London</td>
                        <td>4085557723</td>
                        <td>10782.44</td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT']."/html/footer.php";?>
</body>

</html>