//2021 - WRITTEN BY HARVEY COOMBS
var input = document.querySelector("#help_input");
var search_btn = document.querySelector("#submit_search");

search_btn.addEventListener("click", function () {
    document.querySelector("#main_subt").textContent = `You searched for: ${input.value}`;
    processSearch(input.value);
});

function processSearch(query) {
    var request = new XMLHttpRequest();

    request.onloadend = function () {
        var data = JSON.parse(this.responseText);
        for (var x = 0; x < data.length; x++) {
            document.querySelector("#result_display").innerHTML += `<div class="inner-result-ctr"><div class="result-head-ctr"><strong>${data.title}</strong><a href="${data.url}">&plus;</a></div><p>${data.body}</p></div>`;
        }
    }

    request.open("GET", `/functions/searchForHelp.php?q=${query}`, true);
    request.send();
}