// Function to sanitize a given string by replacing special characters with their HTML entities.
function sanitize(string) {
  const map = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#x27;",
    "/": "&#x2F;",
  };
  const reg = /[&<>"'/]/gi;
  return string.replace(reg, (match) => map[match]);
}

// Function to update the about text of the shop.
function updateShopAbout() {
  // Define the endpoint for the admin panel controller.
  const endPoint = "/adminPannelController";

  // Get the new value from the "shopInfoAboutText" input field.
  let newValue = document.getElementById("shopInfoAboutText").value;

  // Check if the new value is not null and has a length greater than 10 characters.
  if (newValue != null && newValue.length > 10) {
    try {
      // Create a new XMLHttpRequest object.
      xlr = new XMLHttpRequest();
      xlr.open("POST", endPoint, true);
      xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      // Send a request to update the about text with the sanitized new value.
      xlr.send(
        `action=updateAboutText&newText=${encodeURIComponent(
          JSON.stringify(sanitize(newValue))
        )}`
      );

      // Define the callback function to handle the response.
      xlr.onreadystatechange = function () {
        try {
          if (this.readyState === 4) {
            console.log(`XLR Status: ${(this.status, this.responseText)}`);
            console.log("Update sent");

            // Check if the response status is 200 and log the response text.
            if (this.status === 200) {
              console.log(xlr.responseText);
            }
          } else {
            console.log("Update failed");
            console.log(
              `Response status and text: ${(this.status, this.responseText)}`
            );
          }
        } catch (e) {
          console.log(e);
        }
      };
    } catch (e) {
      console.error(e);
    }
  } else {
    // Display an alert if the input is invalid.
    window.alert(
      "Please provide a valid text input (minimum length: 10 characters)"
    );
  }
}

// Function to update the shop owner's telephone number.
function updateShopOwnerTel() {
  // Define the endpoint for the admin panel controller.
  const endPoint = "/adminPannelController";

  // Get the new value from the "shopOwnerTel" input field.
  let newValue = document.getElementById("shopOwnerTel").value;

  // Check if the sanitized new value is not null and has a length greater than 9 characters.
  if (sanitize(newValue) != null && sanitize(newValue).length > 9) {
    try {
      // Create a new XMLHttpRequest object.
      xlr = new XMLHttpRequest();
      xlr.open("POST", endPoint, true);
      xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      // Send a request to update the owner's telephone number with the sanitized new value.
      xlr.send(
        `action=updateOwnerTel&newTel=${encodeURIComponent(
          JSON.stringify(sanitize(newValue))
        )}`
      );

      // Define the callback function to handle the response.
      xlr.onreadystatechange = function () {
        try {
          if (this.readyState == 4) {
            console.log(`XLR Status: ${(this.status, this.responseText)}`);
            console.log("Update sent");

            // Check if the response status is 200 and log the response text.
            if (this.status === 200) {
              console.log(xlr.responseText);
              window.alert("Updating telephone number");
              window.location.reload();
            }
          } else if (this.readyState == 3) {
            // Check if the response status is 200 when the request is in progress.
            if (this.status === 200) {
              window.alert("Updating telephone number successful");
              window.location.reload();
            }
          } else {
            console.log(this.readyState);
            console.log("Updating telephone number failed");
            console.log(
              `Response status and text: ${(this.status, this.responseText)}`
            );
            window.alert("Updating telephone number failed");
          }
        } catch (e) {
          console.log(e);
        }
      };
    } catch (e) {
      console.error(e);
    }
  } else if (sanitize(newValue) == null || sanitize(newValue).length < 9) {
    // Display an alert if the input is invalid.
    window.alert(
      "Please provide a valid telephone number (minimum length: 9 digits)"
    );
  }
}
