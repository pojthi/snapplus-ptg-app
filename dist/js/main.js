'use strict';

var videoElement = document.querySelector('video');
var videoSelect = document.querySelector('select#videoSource');
var vdoSelecterId = '';

videoSelect.onchange = getStream;
getStream().then(getDevices).then(gotDevices);

function getDevices() {
    return navigator.mediaDevices.enumerateDevices();
}

function gotDevices(deviceInfos) {
    window.deviceInfos = deviceInfos; // make available to console
    //alert('Available input and output devices:', deviceInfos);
    for (const deviceInfo of deviceInfos) {
        const option = document.createElement('option');
        option.value = deviceInfo.deviceId;

        if (deviceInfo.kind === 'videoinput') {
            // alert(deviceInfo.kind);
            var str = deviceInfo.label;
            var res = str.substring(0, 3); //USB
            if (res == 'USB') {
                vdoSelecterId = deviceInfo.deviceId;
                defaultUSB(deviceInfo.deviceId);
            }

            option.text = deviceInfo.label || `Camera ${videoSelect.length + 1}`;
            videoSelect.appendChild(option);
        }
    }
}

function getStream() {
    if (window.stream) {
        window.stream.getTracks().forEach(track => {
            track.stop();
        });
    }
    //Default USB
    const videoSource = videoSelect.value;
    // alert(vdoSelecterId);
    // const videoSource = vdoSelecterId;

    const constraints = {
        video: { deviceId: videoSource ? { exact: videoSource } : undefined }
    };
    return navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
}

function defaultUSB(vdoSelecterId) {
    if (window.stream) {
        window.stream.getTracks().forEach(track => {
            track.stop();
        });
    }
    //Default USB
    const videoSource = vdoSelecterId;
    const constraints = {
        video: { deviceId: videoSource ? { exact: videoSource } : undefined }
    };
    return navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
}

function gotStream(stream) {
    window.stream = stream;
    videoSelect.selectedIndex = [...videoSelect.options].findIndex(option => option.text === stream.getVideoTracks()[0].label);
    videoElement.srcObject = stream;
}

function handleError(error) {
    if (!error) {
        console.log("Error: dist/js/main.js");
    } else {
        console.error('Error: ', error);
    }
}