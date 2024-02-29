// Function to toggle between two tables based on the state of a checkbox.
function toggleTables() {
  // Get the input checkbox and table elements.
  var input = document.getElementById("toggleswitch");
  var output1 = document.getElementById("table1");
  var output2 = document.getElementById("table2");

  // Check the state of the checkbox.
  if (input.checked) {
    // If checked, hide table1 and display table2.
    output1.style.display = "none";
    output2.style.display = "table";
  } else {
    // If unchecked, hide table2 and display table1.
    output1.style.display = "table";
    output2.style.display = "none";
  }
}
