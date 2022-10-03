// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyBtj_q3IOwh6wp3Cj7X-vd9T6xq8xysFYk",
    authDomain: "projectblogvudl138.firebaseapp.com",
    databaseURL: "https://projectblogvudl138-default-rtdb.firebaseio.com",
    projectId: "projectblogvudl138",
    storageBucket: "projectblogvudl138.appspot.com",
    messagingSenderId: "10784678199",
    appId: "1:10784678199:web:75c6e89ad2ec04cfa0bab2",
    measurementId: "G-Y9EHBM0Y4C",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});