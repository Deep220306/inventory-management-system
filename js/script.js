const searchInput = document.getElementById("searchInput");
searchInput.addEventListener("keyup", function() {
    let filter = searchInput.value.toLowerCase();
    let rows = document.querySelectorAll("#productTable tr");
    rows.forEach((row, index) => {
        if(index === 0) return;
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});