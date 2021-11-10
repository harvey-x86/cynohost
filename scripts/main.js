var imgs = document.querySelectorAll("img");
document.createElement("er");

for(x = 0; x < imgs.length; x++) {
    imgs[x].setAttribute("draggable", "false");
}

var hb = document.querySelectorAll("#header button");

function addDestination(ref) {
    var page = ref.textContent.toLowerCase();
    var forward = `window.location.href='http://www.harveycoombs.com/cynohost/${page}/'`;
    ref.setAttribute("onclick", forward);
}

hb.forEach(function(e) {
    e.addEventListener("click", addDestination(e));
});

var ub = document.querySelector(".upload");

ub.addEventListener("click", function() {
document.getElementById("uploadFile").classList.toggle('show');    
});

var words = ['', 'Reliability', 'Speed', 'Security'];

var i = 0;

function wordCycle() {

    i == 3 ? i = 1 : i += 1;

    document.querySelector("#word").textContent = words[i]; 

}

setInterval(wordCycle, 1500);
