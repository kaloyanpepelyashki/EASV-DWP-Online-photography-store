// Function to add an item to the shopping cart using AJAX.
function addToCart(item) {
  try {
    // Create a new XMLHttpRequest object.
    xlr = new XMLHttpRequest();
    xlr.open("POST", "/shoppingCart", true);
    xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send a request to add the item to the shopping cart.
    xlr.send(`action=add&item=${encodeURIComponent(JSON.stringify(item))}`);

    // Define the callback function to handle the response.
    xlr.onreadystatechange = function () {
      if (this.readyState === 4) {
        console.log(`XLR Status: ${(this.status, this.responseText)}`);
        console.log("Item added to cart");

        // Check if the response status is 200 and log the response text.
        if (this.status === 200) {
          console.log(xlr.responseText);
          xlr.responeText;
          console.log("Redirecting to the home page");
          window.location.href = "/";
        }
      } else {
        console.error("Error, failed to add to cart");
      }
    };
  } catch (e) {
    console.log(`Error adding to cart: ${e.message}`);
  }
}

// Function to output the shopping cart items on the screen.
function outPutResults(itemsArray) {
  console.log("Items array : " + itemsArray);
  const output = document.getElementById("cart-items-output");

  // Iterate through each item in the shopping cart array.
  itemsArray.forEach((item) => {
    console.log(item);
    if (item) {
      // Create HTML output for each item in the shopping cart.
      let htmlContent = `<div class="grid-container table cart-item">
      <div class="grid-container fifty-fifty">
      <div class="grid-item">
        <img src="${item.photo.url}" />
      </div>
      <span class="grid-item left">
        <b>${item.photo.name}</b><br />
        40x60cm<br />Glossy photo paper<br />
        No frame</span>
    </div>
    <span><u>${item.quantity}</u></span>
    <span><b>${item.photo.basePrice}</b> DKK</span>
    <span class="right"><i class="fa-solid fa-trash" style="font-size:15pt"></i></span>
  </div><hr/>`;

      // Create a new element and set its inner HTML content.
      let newElement = document.createElement("div");
      newElement.innerHTML = htmlContent;

      // Append the new element to the output container.
      output.appendChild(newElement);
    } else {
      return;
    }
  });
}

// Function to parse the HTTP response and extract the shopping cart items.
function parseContent(xlrResponse) {
  try {
    // Extract the response text from the XMLHttpRequest response.
    const responseText = xlrResponse;

    // Regular Expression to escape content within <pre> tags in the responseText.
    const regex2 = /<pre.*?>([\s\S]*?)<\/pre>/s;

    // Escape the content using the regex found in the responseText string.
    let escapedString = responseText.replace(regex2, "$2").replace("$2", " ");

    // Check if the escaped string has a length greater than or equal to 1.
    if (escapedString.length >= 1) {
      // Parse the escaped string as JSON.
      let parsed = JSON.parse(escapedString);
      console.log("Parsed : " + parsed);

      // Check if the parsed array has items and output them on the screen.
      if (parsed.length > 0) {
        outPutResults(parsed);
      } else {
        console.log("Response is empty");
      }
    } else {
      console.error("Failed to extract array from the response");
      console.log(escapedString);
    }
  } catch (e) {
    console.error("Error parsing JSON: " + e.message);
    console.log("Response in plain text: " + xlr.responseText);
  }
}

// Event listener for DOMContentLoaded to fetch and display items from the shopping cart.
document.addEventListener("DOMContentLoaded", () => {
  // Function to fetch items from the shopping cart.
  function fetchFromCart() {
    const shoppingCartRoute = "/shoppingCart?action=get";
    try {
      // Create a new XMLHttpRequest object.
      xlr = new XMLHttpRequest();
      xlr.open("GET", shoppingCartRoute, true);
      xlr.setRequestHeader("Content-Type", "application/json");

      // Send a request to get items from the shopping cart.
      xlr.send();

      // Define the callback function to handle the response.
      xlr.onreadystatechange = () => {
        if (xlr.status === 200) {
          if (xlr.responseText !== "Nothing to show") {
            parseContent(xlr.responseText);
          } else {
            console.log("Nothing to show");
          }
        } else {
          console.error("Could not get cart items. Status: " + xlr.status);
        }
      };
    } catch (e) {
      console.error("Error getting cart items: " + e.message);
    }
  }

  // Call the fetchFromCart function when the DOM content is loaded.
  fetchFromCart();
});
