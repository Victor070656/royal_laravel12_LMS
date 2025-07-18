if("serviceWorker" in navigator){
    navigator.serviceWorker.register("/sw.js", {scope: "/"})
    .then(function(registration) {
        console.log("Service Worker registered with scope:", registration.scope);
    })
    .catch(function(error) {
        console.error("Service Worker registration failed:", error);
    });
}