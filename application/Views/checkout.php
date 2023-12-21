<?php
namespace Views;

?>

<!DOCTYPE html>
<html>

<head>
    <?php
  include 'Components/head.php';
  ?>
    <title>Checkout</title>
</head>

<body id="store-checkout" class="store">
    <?php include 'Components/nav-bar.php'; ?>
    <?php include 'Components/shopping-cart.php'; ?>

    <main>
        <article class="wrapper-wide">
            <div class="pathname-container"></div>

            <h1>Checkout</h1>

            <div class="pathname-container">
                <p>
                    <span class="pathname"><a href="/"></a> &#8250; </span>
                    <span class="pathname"><a href="/store/store">store</a> &#8250; checkout</span>
                </p>
            </div>
            <hr class="reveal" />

            <section class="contact-form-section">
                <form>
                    <div class="grid-container contact-form fifty-fifty reveal">
                        <div class="grid-item">
                            <h2>Customer details</h2>
                            <div class="form-group">
                                <label for="customerName">First Name: *</label>
                                <input type="text" class="form-control" id="firstName" required
                                    autocomplete="given-name" placeholder="Enter First Name *" />
                            </div>
                            <div class="form-group">
                                <label for="customerName">Last Name:</label>
                                <input type="text" class="form-control" id="secondName" required
                                    autocomplete="family-name" placeholder="Enter Last Name *" />
                            </div>

                            <div class="form-group">
                                <label for="customerEmail">Email:</label>
                                <input type="email" class="form-control" id="customerEmail" placeholder="Enter Email"
                                    required autocomplete="email" />
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">Address Line 1:</label>
                                <input type="text" class="form-control" id="customerAddress"
                                    placeholder="Enter Address Line 1 *" required autocomplete="address-level1" />
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">Address Line 2:</label>
                                <input type="text" class="form-control" id="customerAddress2"
                                    placeholder="Enter Address Line 2 " required autocomplete="address-line1" />
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">ZIP Code: *</label>
                                <input type="text" class="form-control" id="customerAddress3"
                                    placeholder="Enter ZIP Code *" required />
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">City: *</label>
                                <input type="text" class="form-control" id="customerAddress4" placeholder="Enter City *"
                                    required autocomplete="city" />
                            </div>
                            <div class="form-group">
                                <label for="customerAddress">Country: *</label>
                                <select id="customerAddress5">
                                    <option value="Denmark">Denmark</option>
                                    <option value="Finland">Finland</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Sweden">Sweden</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid-item">
                            <h2>Goods overview</h2>
                            <div class="form-group">
                                <label for="productName">Product Name:</label>
                                <input type="text" class="form-control" id="productName"
                                    placeholder="Enter Product Name" />
                            </div>
                            <div class="form-group">
                                <label for="productQty">Product Quantity:</label>
                                <input type="number" class="form-control" id="productQty"
                                    placeholder="Enter product quantity" />
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Product Price:</label>
                                <input type="number" class="form-control" id="productPrice"
                                    placeholder="Enter product price" />
                            </div>
                            <div class="form-group">
                                <label for="gstRate">GST Rate (%):</label>
                                <input type="number" class="form-control" id="gstRate" placeholder="Enter GST rate" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="cta">Generate Invoice</button>
                </form>
            </section>
        </article>
    </main>
</body>

</html>
<?php include_once("Components/footer.php"); ?>
<script src="../Public/checkout.js"></script>
</body>

</html>