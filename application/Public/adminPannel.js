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

function updateShopAbout() {
  const endPoint = "/adminPannelController";

  let newValue = document.getElementById("shopInfoAboutText").value;

  if (newValue != null && newValue.length > 10) {
    try {
      xlr = new XMLHttpRequest();
      xlr.open("POST", endPoint, true);
      xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xlr.send(
        `action=updateAboutText&newText=${encodeURIComponent(
          JSON.stringify(sanitize(newValue))
        )}`
      );

      xlr.onreadystatechange = function () {
        try {
          if (this.readyState === 4) {
            console.log(`XLR Status: ${(this.status, this.responseText)}`);

            console.log("Update sent");
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
    window.alert("Please provide a valid text input");
  }
}

function updateShopOwnerTel() {
  const endPoint = "/adminPannelController";

  let newValue = document.getElementById("shopOwnerTel").value;

  if (sanitize(newValue) != null && sanitize(newValue).length > 10) {
    try {
      xlr = new XMLHttpRequest();
      xlr.open("POST", endPoint, true);
      xlr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xlr.send(
        `action=updateOwnerTel&newTel=${encodeURIComponent(
          JSON.stringify(sanitize(newValue))
        )}`
      );

      xlr.onreadystatechange = function () {
        try {
          if (this.readyState === 4) {
            console.log(`XLR Status: ${(this.status, this.responseText)}`);

            console.log("Update sent");
            if (this.status === 200) {
              console.log(xlr.responseText);
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
  } else {
    window.alert("Please provide a valid telephone number");
  }
}
