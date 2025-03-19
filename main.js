var updateInterval = null;

function startup(menuId) {
    setMenu(menuId);
    
    var url = "";
    switch (menuId) {
        case 1: url = "/pages/main.php"; break;
        case 3: url = "/pages/switches.php"; break;
        case 4: url = "/pages/lights.php"; break;
        case 5: url = "/pages/automations.php"; break;
        case 6: url = "/pages/players.php"; break;
    }

    if (url) {
        replacePageContent(url);
        
        if (updateInterval !== null) {
            clearInterval(updateInterval);
        }

        updateInterval = setInterval(function () {
            replacePageContent(url);
        }, 5000);
    }
}

function setMenu(floor) {
    var allItems = document.getElementsByClassName('main-menu-item');
    for (var i = 0; i < allItems.length; i++) {
        allItems[i].classList.remove("main-menu-active");
    }
    document.getElementById("menu" + floor).classList.add("main-menu-active");
}

function fetchPageContent(url) {
    var apiRequest = new XMLHttpRequest();

    apiRequest.open("GET", url, false);

    apiRequest.send(null);

    if (apiRequest.status === 200 && apiRequest.readyState == 4) {
        return apiRequest.responseText;
    } else {
        return null;
    }
}

function replacePageContent(url) {
    var pageContent = fetchPageContent(url);
    if (pageContent !== null) {
        var pageEl = document.getElementById("page-content");
        pageEl.innerHTML = pageContent;
    }
}

function stateChange(entity_id, service) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "api.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var data = "entity_id=" + encodeURIComponent(entity_id) + "&service=" + encodeURIComponent(service);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        console.log("Befehl gesendet:", entity_id, service);
                    } else {
                        console.error("Fehler:", response.error);
                    }
                } catch (e) {
                    console.error("Invalid response.");
                }
            } else {
                console.error("Error during request:", xhr.status);
            }
        }
    };

    xhr.send(data);
}
