$(document).keydown(function (event) {
    if (event.keyCode == 123) {
        return false;
    }
    else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
        return false;  //Prevent from ctrl+shift+i
    }
    else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
        return false;  //Prevent from ctrl+shift+i
    }
    else if (event.ctrlKey && event.shiftKey && event.keyCode == 67) {
        return false;  //Prevent from ctrl+shift+i
    }
});

document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});