function toggleTables() {
    var input = document.getElementById('toggleswitch');
    var output1 = document.getElementById('table1');
    var output2 = document.getElementById('table2');

    if(input.checked) {
        output1.style.display = "none";
        output2.style.display = "table";
    } else {
        output1.style.display = "table";
        output2.style.display = "none";
    }
}