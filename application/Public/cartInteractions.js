function addToCart(item) {
  console.log("item: " + item);
  try {
    xlr = new XMLHttpRequest();
    xlr.open("POST", "/shoppingCart", true);
    xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xlr.send(`action=add&item=${encodeURIComponent(JSON.stringify(item))}`);
    xlr.onreadystatechange = function () {
      if (this.readyState === 4) {
        console.log(`XLR Status: ${(this.status, this.responseText)}`);

        console.log("Item added to cart");
        if (this.status === 200) {
          console.log(xlr.responseText);
          xlr.responeText;
          console.log("external file");
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

//Outputs the http response on screen
function outPutResults(itemsArray) {
  console.log("Items array : " + itemsArray);
  const output = document.getElementById("cart-items-output");
  itemsArray.forEach((item) => {
    console.log(item);
    if (item) {
      //Creates the html output for each element of the shopping cart
      let htmlContent = `<div class="grid-container table cart-item">
      <div class="grid-container fifty-fifty">
      <div class="grid-item">
        <img src="${item.url}" />
      </div>
      <span class="grid-item left">
        <b>${item.name}</b><br />
        40x60cm<br />Glossy photo paper<br />
        No frame</span>
    </div>
    <span><u></u></span>
    <span><b>${item.basePrice}</b> DKK</span>
    <span class="right"><i class="fa-solid fa-trash" style="font-size:15pt"></i></span>
  </div><hr/>`;
      // output.innerHTML(htmlContent);

      let newElement = document.createElement("div");
      newElement.innerHTML = htmlContent;

      // Append the new element to the output container
      output.appendChild(newElement);
    } else {
      return;
    }
  });
}

//Parses the HTTP response
function parseContent(xlrResponse) {
  try {
    const responseText = xlrResponse;
    //Regular Expression to escape in the responseText.
    const regex2 = /<pre.*?>([\s\S]*?)<\/pre>/s;

    //Escaping the regex found in the responseText string
    let escapedString = responseText.replace(regex2, "$2").replace("$2", " ");

    if (escapedString && escapedString.length >= 1) {
      //Parsing the escaped string to JSON
      let parsed = JSON.parse(escapedString);
      console.log("Parsed : " + parsed);
      if (parsed.length > 0) {
        outPutResults(parsed);
      } else {
        console.log("Response is empty");
      }
    } else {
      console.error("Failed to extract array from response");
      console.log(escapedString);
      console.log("Escaped String length" + escapedString.length);
    }
  } catch (e) {
    console.error("Error parsing JSON: " + e.message);
    console.log("Response in plain text: " + xlr.responseText);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  function fetchFromCart() {
    const shoppingCartRoute = "/shoppingCart?action=get";
    try {
      xlr = new XMLHttpRequest();
      xlr.open("GET", shoppingCartRoute, true);
      xlr.setRequestHeader("Content-Type", "application/json");
      xlr.send();

      xlr.onreadystatechange = () => {
        if (xlr.status === 200) {
          console.log("Just checking " + xlr.responseText);
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
  fetchFromCart();
});
