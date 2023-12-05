<?php
//ADDITIONAL LOGIC OF THE VIEW GOES HERE
include_once(__DIR__ . '/../Controllers/HomeController.php');

use Controllers as C;

$controller = new C\HomeController();


function renderTableProducts($controller)
{
    foreach ($controller->getAllProducts() as $product) {
        $productId = $product["id"];
        $productName = $product["name"];
        $productUrl = $product["url"];
        echo "<div class='grid-item' id='product-component'><a href='/store/product'><img  src='$productUrl'><a><div class='text-wrapper flex-center'><h3>$productName</h3><p>From 300 DKK</p><a href='./product' class='cta cta-2 flex-center'>Buy</a></div></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <?php include 'nav-bar.php'; ?>

    <main>

        <!--NEWS STARTS HERE-->
        <article class="wrapper-wide" style="margin-top:8rem;">
            <div class="pathname-container"></div>
            <div class="grid-container fifty-fifty">
                <div class="grid-item">
                    <h1 class="reveal">Recently published</h1>
                    <p class="reveal">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui
                        voluptatem blanditiis expedita omnis corrupti id rem perspiciatis
                        possimus, cumque cum optio ut illo incidunt laborum ad magnam est,
                        architecto dignissimos.
                    </p>
                    <a href="./product" class="cta flex-center hideCTA-max reveal">Learn more
                    </a>
                </div>
                <div class="grid-item v-stretch reveal">
                    <img src="/img/2021-04-13-00596.jpg" />
                    <a href="./product" class="cta flex-center hideCTA-min reveal">Learn more
                    </a>
                </div>
            </div>
            <hr class="reveal" />
            
        </article>
        <!--NEWS ENDS HERE-->
        


        <hr class="semi" />
        <!--PRODUCT LIST STARTS HERE-->
        <article class="wrapper-standard">
            <hr class="reveal" />
            <h1 class="reveal">ABOUT</h1>
            <!-- THE GRID THAT HOLDS THE PRODUCTS -->
            <section class="product-grid">
                <!-- GRID ELEMENT -->
                <?php
                //The function that outputs the product template for each item from the database
                renderTableProducts($controller);
                ?>
            </section>
            <?php $controller->updateTableById("photo", 5, "base_price", "301");
             $controller->updateTableById("photo", 5, "base_price", "401") ;
            ?>
            
            <p class="reveal">
                Greetings from Denmark! As a Czech-born multimedia design student 🇨🇿,
                I'm bringing the Slavic spirit to my new venture,
                <a href="https://www.slavicmedia.dk" target="_blank" rel="noopener noreferrer">Slavic Media</a>
                – small but mighty!
            </p>
            <p class="reveal">
                I'm a Canon-wielding photography enthusiast with a side of iPhone, and
                a website wizard, thanks to my multimedia studies on
                <a href="https://www.iba.dk/fuldtidsuddannelser" target="_blank"
                    rel="noopener noreferrer">Erhversakademi Kolding</a>.
            </p>
            <p class="reveal">
                Former
                <a href="https://www.flickr.com/photos/141401020@N03/" target="_blank" rel="noopener noreferrer">LEGO
                    architect</a>, current purveyor of digital aesthetics and sarcasm.
            </p>
            <p class="reveal">PS: No cookies — just creativity!</p>
            <hr class="reveal" />

            <article id="contact">
                <section class="wrapper-standard">
                  <section class="contact-form-section">
                    <hr class="reveal" />
                    <h1 class="reveal">Contact</h1>
                    <form
                      id="contactForm"
                      action="https://formsubmit.co/2007080c2cf8bd2ebb68506e7aa98c5f"
                      method="POST"
                      novalidate
                      enctype="multipart/form-data"
                    >
                      <!-- Email invisibility -->
                      <div class="grid-container contact-form fifty-fifty reveal">
                        <div class="grid-item">
                          <p><label for="email">Email * </label></p>
                          <input
                            type="email"
                            id="email"
                            name="Email"
                            placeholder=""
                            required
                            autocomplete="email"
                          />
                          <br />
                          <p><label for="name">Name *</label></p>
                          <input
                            required
                            type="text"
                            id="name"
                            name="Name"
                            placeholder=""
                            autocomplete="name"
                          />
        
                          <br />
                        </div>
                        <div class="grid-item">
                          <p><label for="subject">Subject * </label></p>
                          <input
                            type="text"
                            id="subject"
                            name="_subject"
                            required
                            placeholder=""
                          />
                          <br />
                          <p><label for="company">Company (optional)</label></p>
                          <input
                            type="text"
                            id="company"
                            name="Company"
                            placeholder=""
                            autocomplete="work"
                          />
                          <br />
                        </div>
                      </div>
                      <div class="reveal">
                        <p><label for="message">Message * </label></p>
                        <textarea
                          minlength="10"
                          name="Message"
                          rows="7"
                          id="message"
                          required
                          placeholder=""
                        ></textarea>
                        <br />
                        <br />
        
                        <div class="btn-area flex-center">
                          <button id="btn" class="submit-btn" type="submit">
                            Submit contact form
                          </button>
                          <div class="btn-shadow"></div>
                        </div>
                        <input
                          type="hidden"
                          name="_captcha"
                          value="true"
                        /><!-- Spam captcha deactivation -->
                        <input
                          type="hidden"
                          name="_next"
                          value="https://adamsochorec.com/success"
                        />
                        <!-- Redirect to the success page -->
                      </div>
                    </form>
                  </section>
                </section>
              </article>
        </article>
        <!--PRODUCT LIST ENDS HERE-->
        
        <!--EMAIL FORM-->
        <?php include 'email-form.php'; ?>

    </main>
    <!--FOOTER-->
    <?php include 'footer.php'; ?>
    
</body>

    <script src="/Views/assets/autoload.js"></script>
</html>