//2021 - WRITTEN BY HARVEY COOMBS
var file_sizes = document.querySelectorAll(".fsize");
file_sizes.forEach(f => {
    f.textContent = formatFS(f.textContent);
});