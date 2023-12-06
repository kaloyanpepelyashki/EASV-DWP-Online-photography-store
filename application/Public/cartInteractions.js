function addToCart() {
  xlr = new XMLHttpRequest();

  xlr.onreadystatechange = () => {
    if (xlr.readyState === 4 && xlr.status === 200) {
      const response = JSON.parse(xlr.responseText);

      if (response == "success") {
      } else {
        console.error("Error, failed to add to cart ");
      }
    }
  };

  xlr.open("POST", "ShoppingCartController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xlr.send(`action=add&item=${encodeURIComponent(item)}`);
}
