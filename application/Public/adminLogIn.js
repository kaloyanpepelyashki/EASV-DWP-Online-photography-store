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

function submitForm() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  const endPoint = "/signinAdmin";

  let sanitizedUsername = sanitize(username);

  let creditObject = {
    username: sanitizedUsername,
    password: password,
  };

  console.log(sanitizedUsername);
  try {
    console.log("Credit Object : " + creditObject);
    const xlr = new XMLHttpRequest();
    xlr.open("POST", endPoint, true);
    xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xlr.send(
      `action=signin&creditObject=${encodeURIComponent(
        JSON.stringify(creditObject)
      )}`
    );

    xlr.onreadystatechange = function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          if (xlr.responseText == 1) {
            window.alert("Success, login successfull");
            window.location.href = "/admin-panel";
          } else {
            window.alert("Not success");
          }
        }
      } else {
        console.log(this.status);
        console.log(this.readyState);
        console.log(xlr.responseText);
      }
    };
  } catch (e) {
    console.error(e);
  }
}
