const im = document.querySelectorAll("img");
im.forEach(i => {
	i.setAttribute("draggable", false);
});

var d = new Date();
document.querySelector("#footer span").append(d.getFullYear());

/*if(window.innerWidth < 767) {
    window.location.href = "http://mobile.cynohost.com";
}*/

function requester(method, url, callback) {
    var request = new XMLHttpRequest();
    request.onloadend = callback;
    request.open(method, url, true);
    request.send();
}

function genURLvars(input) {
    var final = "?";
    var converted = JSON.parse(input);
    converted.forEach(v => { final += `${v.name}=${v.val}&`; });
    return final;
}

function formatFS(size) {
    var format;
    var divider;
    switch (true) {
        case (size >= 1000000000):
            format = "GB";
            divider = 1000000000;
        break;

        case (size >= 1000000):
            format = "MB";
            divider = 1000000;
        break;
    
        case (size >= 1000):
            format = "KB";
            divider = 1000;
        break;

        default:
            format = "B";
            divider = 1;
        break;
    }
    return `${parseFloat(size / divider)}${format}`;
}

function popup(title, content, options, options_callb) {
    document.body.insertAdjacentHTML("beforeend", `<div class="popup-outer"><div class="popup">`);
}

function changeLang(lang) {
    document.querySelector(".lang-selector img").setAttribute("src", `/media/${lang}.png`);
    document.cookie = `Language=${lang}`;
}

const lang_selector = document.querySelector("#langSelect");
lang_selector.addEventListener("change", function () {
    var list = document.querySelector("#langSelect");
    var choice = list[list.selectedIndex];
    changeLang(choice.getAttribute("data-lang"));
});

function logout() {
    var request = new XMLHttpRequest();
    request.onloadend = window.location.reload();
    request.open("GET", "/functions/logout.php", true);
    request.send();
}

function viewPassword(target) {
    const pw_view = document.querySelector("#pw_view");
    pw_view.addEventListener("click", function (e) {
        e.preventDefault();
        this.textContent = (this.textContent === "Show") ? "Hide" : "Show";
        target.classList.toggle("protected");
    });
}

function notice(message, type) {
    var color;
    switch (type) {
        case 0: 
            color = "D62246";
        break;
        case 1: 
            color = "3FA34D";
        break;
        case 2:
            color = "FFC800";
        break;
    }
    (document.body).innerHTML += `<div class="notice-outer" style="background: #${color};">${message}</div>`;
    setTimeout(function () {
        document.querySelector(".notice-outer").remove();
    }, 3500);
}
