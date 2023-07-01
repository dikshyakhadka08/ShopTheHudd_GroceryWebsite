<?php require('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop The Hudd</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../dist/main.css" />
</head>
<body>
    <?php include 'includes/header.php' ?>
    <section class="products">
        <div class="products-display-page">
            <h1 class="title">All Products</h1>
            <div class="filters">
                <form action="products-page.php" method="post">
                    <div class="sort-by">
                        <label for="sort-by-select">Sort by:</label>
                        <select id="sort-by-select" name="sort">
                            <option value="price-asc">Price - Low to High</option>
                            <option value="price-desc">Price - High to Low</option>
                            <option value="name-asc">Name - A to Z</option>
                            <option value="name-desc">Name - Z to A</option>
                        </select>
                        <button type="submit" class="custom-button">Sort</button>
                    </div>
                </form>
                <form action="products-page.php" method="post">
                    <div class="filters-dropdown">
                        <label for="filters-select">Filters:</label>
                        <select id="filters-select" name="category">
                            <option value="all">All</option>
                            <option value="fishmonger">Fishmonger</option>
                            <option value="butchers">Butcher</option>
                            <option value="bakery">Bakery</option>
                            <option value="greengrocer">Greengrocer</option>
                            <option value="delicatessen">Delicatessen</option>
                        </select>
                        <button type="submit" class="custom-button">Filter</button>
                    </div>
                </form>
                <form action="products-page.php" method="post">
                    <div class="filters-dropdown">
                        <label for="filters-shop">Shop:</label>
                        <select id="filters-shop" name="shop">
                            <option value="all">All</option>
                            <?php
                            $shopQuery = "SELECT * FROM SHOP";
                            $shopStmt = oci_parse($conn, $shopQuery);
                            oci_execute($shopStmt);

                            while ($shopRow = oci_fetch_array($shopStmt, OCI_ASSOC)) {
                                $shopId = $shopRow['SHOP_ID'];
                                $shopName = $shopRow['SHOP_NAME'];
                                ?>
                                <option value="<?php echo $shopId; ?>"><?php echo $shopName; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" class="custom-button">Filter</button>
                    </div>
                </form>
                <div class="search">
                    <form action="products-page.php" method="post">
                        <input type="text" name="search" placeholder="Search by product or shop name" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                        <button type="submit" class="custom-button">Search</button>
                    </form>
                </div>
            </div>
            <div class="product-grid">
                <?php
                $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
                $category = isset($_POST['category']) ? $_POST['category'] : 'all';
                $shop = isset($_POST['shop']) ? $_POST['shop'] : 'all';
                $search = isset($_POST['search']) ? $_POST['search'] : '';

                $selectallprods = "SELECT p.*, s.SHOP_NAME FROM PRODUCT p
                LEFT JOIN SHOP s ON p.SHOP_ID = s.SHOP_ID";

                $bindValues = [];

                // Add category filter
                if ($category !== 'all') {
                    $selectallprods .= " WHERE p.CATEGORY_NAME = :category";
                    $bindValues['category'] = $category;
                }

                // Add shop filter
                if ($shop !== 'all') {
                    if ($category === 'all') {
                        $selectallprods .= " WHERE";
                    } else {
                        $selectallprods .= " AND";
                    }
                    $selectallprods .= " p.SHOP_ID = :shop";
                    $bindValues['shop'] = $shop;
                }

                // Add search filter
                if (!empty($search)) {
                    if ($category === 'all' && $shop === 'all') {
                        $selectallprods .= " WHERE";
                    } else {
                        $selectallprods .= " AND";
                    }
                    $selectallprods .= " (UPPER(p.PRODUCT_NAME) LIKE '%' || :search || '%' OR UPPER(s.SHOP_NAME) LIKE '%' || :search || '%')";
                    $bindValues['search'] = '%' . strtoupper($search) . '%';
                }

                // Add sorting
                if ($sort == 'price-asc') {
                    $selectallprods .= " ORDER BY p.PRICE ASC";
                } elseif ($sort == 'price-desc') {
                    $selectallprods .= " ORDER BY p.PRICE DESC";
                } elseif ($sort == 'name-asc') {
                    $selectallprods .= " ORDER BY p.PRODUCT_NAME ASC";
                } elseif ($sort == 'name-desc') {
                    $selectallprods .= " ORDER BY p.PRODUCT_NAME DESC";
                }

                $proddisplayexecute = oci_parse($conn, $selectallprods);

                // Bind values
                foreach ($bindValues as $param => $value) {
                    oci_bind_by_name($proddisplayexecute, ':' . $param, $value);
                }

                oci_execute($proddisplayexecute);

                while ($roww = oci_fetch_array($proddisplayexecute, OCI_ASSOC)) {
                    $productImage = $roww['PRODUCT_IMG'];
                    $productName = $roww['PRODUCT_NAME'];
                    $productPrice = $roww['PRICE'];
                    ?>
                    <div class="product">
                        <div class="product-image">
                            <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                        </div>
                        <div class="product-details">
                            <h3 class="product-name"><?php echo $productName; ?></h3>
                            <span class="product-price">$<?php echo $productPrice; ?></span>
                            <p class="product-shop">Shop: <?php echo $roww['SHOP_NAME']; ?></p>
                            <a href="product-detail.php?product=<?php echo $roww['PRODUCT_ID']; ?>" class="custom-button">View Product</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php' ?>
    <script src="app/js/script.js"></script>
</body>
</html>