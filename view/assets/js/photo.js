function UploadPic() {
    var canvas = document.getElementById('canvas_pp');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms["form1"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

   alert('Image ajoutée avec succès :)');


    window.location.reload();
}

function UploadPic1() {
    var canvas = document.getElementById('canvas_p1');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data1').value = dataURL;
    var fd = new FormData(document.forms["form2"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

function UploadPic2() {
    var canvas = document.getElementById('canvas_p2');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data2').value = dataURL;
    var fd = new FormData(document.forms["form3"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

function UploadPic3() {
    var canvas = document.getElementById('canvas_p3');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data3').value = dataURL;
    var fd = new FormData(document.forms["form4"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

function UploadPic4() {
    var canvas = document.getElementById('canvas_p4');
    var dataURL = canvas.toDataURL();
    document.getElementById('hidden_data4').value = dataURL;
    var fd = new FormData(document.forms["form5"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../controllers/PhotosController.php");


    xhr.send(fd);

    alert('Image ajoutée avec succès :)');


    window.location.reload();
}

document.getElementById('imagepp').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawpp;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawpp() {
    var canvas = document.getElementById('canvas_pp');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
    document.getElementById("btnpp").disabled = false;
}

document.getElementById('imagep1').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp1;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp1() {
    var canvas = document.getElementById('canvas_p1');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
    document.getElementById("btnp1").disabled = false;
}

document.getElementById('imagep2').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp2;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp2() {
    var canvas = document.getElementById('canvas_p2');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
    document.getElementById("btnp2").disabled = false;
}

document.getElementById('imagep3').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp3;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp3() {
    var canvas = document.getElementById('canvas_p3');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
    document.getElementById("btnp3").disabled = false;
}

document.getElementById('imagep4').onchange = function(e) {
    if (this.files[0] && this.files[0].type.includes('image')) {
        var img = new Image();
        img.onload = drawp4;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    } else {
        alert('Fichiers autorisés: *.png - *.jpeg - *.gif');
    }
};

function drawp4() {
    var canvas = document.getElementById('canvas_p4');
    canvas.width = 480;
    canvas.height = 480;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(this, 0,0, canvas.width, canvas.height);
    document.getElementById("btnp4").disabled = false;
}


function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
}
