// Get form elements
const firstName = document.getElementById("firstName");
const secondName = document.getElementById("secondName");
const customerAddress = document.getElementById("customerAddress");
const customerAddress2 = document.getElementById("customerAddress2");
const customerAddress3 = document.getElementById("customerAddress3");
const customerAddress4 = document.getElementById("customerAddress4");
const customerAddress5 = document.getElementById("customerAddress5");
const customerEmail = document.getElementById("customerEmail");
const productName = document.getElementById("productName");
const productQty = document.getElementById("productQty");
const productPrice = document.getElementById("productPrice");
const gstRate = document.getElementById("gstRate");
const generateBtn = document.querySelector("button");

// Event listener for form submission
generateBtn.addEventListener("click", (e) => {
  e.preventDefault(); // prevent default form submission

  // Get form input values
  const fname = firstName.value;
  const lname = secondName.value;
  const address = customerAddress.value;
  const address2 = customerAddress2.value;
  const address3 = customerAddress3.value;
  const address4 = customerAddress4.value;
  const address5 = customerAddress5.value;
  const email = customerEmail.value;
  const product = productName.value;
  const qty = productQty.value;
  const price = productPrice.value;
  const gst = gstRate.value;

  // Calculate amounts
  const subtotal = qty * price;
  const gstAmount = (subtotal * gst) / 100;
  const total = subtotal + gstAmount;

  // Create invoice HTML
  const invoiceHTML = `
    <style>
      /* INVOICE START */
      #invoice .invoice {
        background-color: white;
        padding: 30px;
        margin-top: 4rem;
        height: 842px;
      }
      #invoice h1,
      #invoice p {
        color: black;
        margin-top: 0 !important;
      }
      #invoice hr,
      #invoice tr {
        color: black;
      }
      #invoice table {
      }
      /* INVOICE END */
    </style>
    <div class="invoice">
      <h1>Invoice</h1>
      <hr />
      <p><u>First Name:</u> ${fname}</p>
      <p><u>Last Name:</u> ${lname}</p>
      <p><u>Address Line 1:</u> ${address}</p>
      <p><u>Address Line 2:</u> ${address2}</p>
      <p><u>ZIP Code:</u> ${address3}</p>
      <p><u>City:</u> ${address4}</p>
      <p><u>Country:</u> ${address5}</p>
      <p><u>Customer Email:</u> ${email}</p>
      <hr />
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${product}</td>
            <td>${qty}</td>
            <td>${price}</td>
            <td>${subtotal.toFixed(2)}</td>
          </tr>
        </tbody>
      </table>
      <hr />
      <p><strong>GST (${gst}%):</strong> ${gstAmount.toFixed(2)}</p>
      <p><strong>Total:</strong> ${total.toFixed(2)}</p>
    </div>
  </div>
  `;

  // Display invoice in a new window
  const newWindow = window.open("", "_blank", "height=842,width=595");
  newWindow.document.body.innerHTML = invoiceHTML;
});
