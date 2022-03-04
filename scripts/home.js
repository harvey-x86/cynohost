//2021 - WRITTEN BY HARVEY COOMBS
const target = document.querySelector("#text strong target");

var words = ['Reliability', 'Speed', 'Security'];

var i = 0;

setInterval(function () {
	i == 2 ? i = 0 : i += 1;
	target.textContent = words[i];
	if (window.innerWidth <= 1400) { 
        var br = document.createElement("br");
        target.prepend(br)
    }
}, 1500);

const upload_button = document.querySelector("#upload_button");
const file_upload = document.querySelector("input[type=file]");
const submit_upload = document.querySelector("#submit_files");
//submit_upload.disabled = true;

const files_area = document.querySelector(".data");
const uploader = document.querySelector("form");

upload_button.addEventListener("click", function () {
    document.querySelector("#uploader").classList.remove("hide");
	file_upload.click();
});

files_area.addEventListener("click", resetUpload);

const clear_upload = document.querySelector("#clear_upload");

clear_upload.addEventListener("click", function () {
    uploader.reset();
    files_area.addEventListener("click", resetUpload); 
    files_area.classList.add("dashed-border");
    files_area.innerHTML = "<div class=\"inner-upl\"><strong>Your Files Will Appear Here</strong><span>Drop your files here or click this area to upload</span></div>";
});

document.querySelector("#uploader .popup .top button").addEventListener("click", function () { document.querySelector("#uploader").classList.add("hide"); });

const password_input = document.querySelector(".use-password");
const passw_toggle = document.querySelector("#uploader .popup .main #pw_toggle");
const passw_field = document.querySelector("#password_field");

    const pw_view = document.querySelector("#pw_view");
    pw_view.addEventListener("click", function (e) {
        e.preventDefault();
        this.textContent = (this.textContent === "Show") ? "Hide" : "Show";
        document.querySelector("input[name=pw]").classList.toggle("protected");
    });

function resetUpload() { 
    uploader.reset();
    passw_toggle.checked = false;
    file_upload.click(); 
}

passw_toggle.addEventListener("change", function () {
    //this.checked ? passw_field.remove() : password_input.innerHTML += `<input type="text" placeholder="A Password" class="protected" name="pw" />`;
    passw_field.classList.toggle("hide");
    //f.insertBefore(inp, f.lastChild);
});

file_upload.addEventListener("change", function (e) {
    var uploaded = e.target.files;
    files_area.removeEventListener("click", resetUpload);
    if(uploaded.length > 0) {
        //submit_upload.disabled = true;
        //submit_upload.classList.remove("inactive");
        files_area.innerHTML = `<table id="allfiles"><th>File Name</th><th>Size</th><th>Type</th><th>Manage</th></table>`;
        files_area.classList.remove("dashed-border");
        var file_table = document.querySelector("#allfiles");
        var total_size = 0;
        for(var x = 0; x < uploaded.length; x++) {
            var fn = uploaded[x].name;
            var file_name = fn.length > 35 ? `${fn.substring(0, 35)}...` : fn;
            var file_size = formatFS(uploaded[x].size);
            total_size += uploaded[x].size;
            file_table.innerHTML += `<tr data-row=${x}><td>${file_name}</td><td>${file_size}</td><td>${(fn.substring(fn.lastIndexOf(".") + 1, fn.length)).toUpperCase()}</td><td><input type="button" class="rem" name="rem" value="&minus;" /></td></tr>`;
        } file_table.innerHTML += `<tr><td><b>Total:</b></td><td><b>${formatFS(total_size)}</b></td></tr>`;
    } else { 
        file_upload.click(); 
        //submit_upload.disabled = true;
        //submit_upload.classList.add("inactive");
    }
});

const logout_btn = document.querySelector("#logout");
if (logout_btn != null) {
    logout_btn.addEventListener("click", logout);
}

var user_avi = document.querySelector(".avatar");

if (user_avi != null) { 
    user_avi.addEventListener("click", function () {
        var request = new XMLHttpRequest();
        request.onloadend = function () {
        var data = JSON.parse(request.responseText);
            //popup();
        }
        request.open("GET", "functions/getUser.php", true);
        request.send();
    });
}

files_area.addEventListener("dragover", function (e) {
    e.preventDefault();
})

files_area.addEventListener("drop", function (e) {
    var files = e.dataTransfer.items;
    //files.forEach(f => {
        console.log(files);
    //});
});

var ua = document.querySelector("#ukr-donate");
ua.addEventListener("click", function () {
    window.location.href = "https://www.unicef.org.uk/donate/donate-now-to-protect-children-in-ukraine/";
});