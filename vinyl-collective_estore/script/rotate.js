var imageArray = [];
for (var i = 0; i < 6; i++) {
    imageArray[i] = "images-homepage/image" + (i + 1) + ".png";
}

var imageCounter = 0;

function rotate() {
    var imageObject = document.getElementById('placeholder');
    if (!imageObject) return;

    imageObject.src = imageArray[imageCounter];
    imageCounter = (imageCounter + 1) % imageArray.length;
}

function startRotation() {
    var imageObject = document.getElementById('placeholder');
    if (!imageObject) return;

    imageObject.src = imageArray[imageArray.length - 1];
    setInterval(rotate, 2250);
}

window.addEventListener("load", startRotation);