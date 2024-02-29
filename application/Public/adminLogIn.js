// Function to sanitize special characters in a string
function sanitize(string) {
  // Mapping of special characters to their corresponding HTML entities
  const map = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#x27;",
    "/": "&#x2F;",
  };

  // Regular expression to match special characters
  const reg = /[&<>"'/]/gi;

  // Replace special characters with their HTML entities
  return string.replace(reg, (match) => map[match]);
}

/**
 * Submits the login form to the server.
 */
function submitForm() {
  // Get username and password from the form
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;

  // Server endpoint for form submission
  const endPoint = "/signinAdmin";

  // Sanitize the username to prevent potential HTML injection
  let sanitizedUsername = sanitize(username);

  // Create an object with sanitized username and password
  let creditObject = {
    username: sanitizedUsername,
    password: password,
  };

  // Log the sanitized username for debugging purposes
  console.log(sanitizedUsername);

  try {
    // Create a new XMLHttpRequest object
    console.log("Credit Object : " + creditObject);
    const xlr = new XMLHttpRequest();

    // Set up the request method, endpoint, and asynchronous flag
    xlr.open("POST", endPoint, true);

    // Set the request header for form data
    xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send the request with the action and creditObject parameters
    xlr.send(
      `action=signin&creditObject=${encodeURIComponent(
        JSON.stringify(creditObject)
      )}`
    );

    // Define the function to handle the state change of the request
    xlr.onreadystatechange = function () {
      if (this.readyState === 4) {
        // Check if the request was successful (status code 200)
        if (this.status === 200) {
          // Check the response text for success (1) or failure (other)
          if (xlr.responseText == 1) {
            window.alert("Success, login successful");
            // Redirect to the admin panel upon successful login
            window.location.href = "/admin-panel";
          } else {
            window.alert("Not success");
          }
        }
      } else {
        // Log status, readyState, and responseText for debugging in case of errors
        console.log(this.status);
        console.log(this.readyState);
        console.log(xlr.responseText);
      }
    };
  } catch (e) {
    // Log any caught exceptions during the try block
    console.error(e);
  }
}
