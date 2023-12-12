const shoppingCartFrontEnd = document.getElementById("shoppingCartFrontEnd");

// function addToCart(item) {
//   try {
//     xlr = new XMLHttpRequest();
//     xlr.open("POST", "/shoppingCart", true);
//     xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//     xlr.send(`action=add&item=${encodeURIComponent(item)}`);

//     xlr.onreadystatechange = function () {
//       if (this.readyState === 4) {
//         console.log(`XLR Status: ${(this.status, this.responseText)}`);

//         console.log("Item added to cart");
//         if (this.status === 200) {
//           console.log(xlr.responseText);
//         }
//       } else {
//         console.error("Error, failed to add to cart");
//       }
//     };
//   } catch (e) {
//     console.log(`Error adding to cart: ${e.message}`);
//   }
// }

function addToCart(item) {
  console.log(item);
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

document.addEventListener("DOMContentLoaded", () => {
  function fetchFromCart() {
    try {
      xlr = new XMLHttpRequest();
      xlr.open("GET", "/shoppingCart?action=get", true);
      xlr.setRequestHeader("Content-Type", "application/json");
      xlr.send();

      xlr.onreadystatechange = () => {
        if (xlr.status === 200) {
          try {
            const responseText = xlr.responseText;
            //Regular Expression to escape in the responseText.
            const regex2 = /<pre.*?>([\s\S]*?)<\/pre>/s;

            //Escaping the regex found in the responseText string
            let escapedString = responseText
              .replace(regex2, "$2")
              .replace("$2", " ");
            if (escapedString && escapedString.length >= 1) {
              //Parsing the escaped string to JSON
              let parsed = JSON.parse(escapedString);
              parsed.forEach((item) => {
                console.log(item);
              });
            } else {
              console.error("Failed to extract array from response");
            }
          } catch (e) {
            console.error("Error parsing JSON: " + e.message);
            console.log("Response in plain text: " + xlr.responseText);
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
