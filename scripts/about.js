//2021 - WRITTEN BY HARVEY COOMBS
var profiles = document.querySelectorAll(".team-member");

profiles.forEach(p => {
    p.addEventListener("click", function () { 
        var id = parseInt(this.getAttribute("data-id"));
        requester("GET", `/functions/getEmployee.php?id=${id}`, function () {
            var data = JSON.parse(this.responseText);
            //navigator.clipboard.writeText(data.email);
            notice("Email copied to clipboard", 1);
        });
    });
});