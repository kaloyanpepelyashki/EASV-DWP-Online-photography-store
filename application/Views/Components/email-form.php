<!-- <hr style="width: 37.5rem" />
<section class="contact-form-section">
  <form id="contactForm" method="post" action="Controllers/sendemail.php">
    <div>
      <div style="display: inline-block">
        <p>Email*</p>
        <br />
        <input id="email" type="text" name="email" />
      </div>
      <div style="display: inline-block">
        <p>Subject*</p>
        <br />
        <input id="subject" type="text" name="subject" />
      </div>
    </div>

    <div>
      <div style="display: inline-block">
        <p>Name*</p>
        <br />
        <input id="name" type="text" name="name" /><br />
      </div>
      <div style="display: inline-block">
        <p>Company (optional)</p>
        <br />
        <input id="company" type="text" name="company" /><br />
      </div>
    </div>

    <p>Message*</p>
    <br />
    <textarea id="message" name="message" rows="15" cols="40"></textarea><br />
    <button id="submit" type="button" name="submit" onclick="sendEmail()">
      Send
    </button>
  </form>
</section> -->

<article id="contact">
  <section class="wrapper-standard">
    <section class="contact-form-section">
      <hr class="reveal" />
      <h1 class="reveal">Contact</h1>
      <form id="contactForm" action="Controllers/sendemail.php" method="POST">
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
            <button
              id="btn"
              class="submit-btn"
              onclick="sendEmail()"
              type="submit"
            >
              Submit contact form
            </button>
            <div class="btn-shadow"></div>
          </div>
        </div>
      </form>
    </section>
  </section>
</article>
