// Script used for traversing to the registration and login page with the help of button.

"use strict"; 

const loginRegBtn = document.querySelector("#small-btn"); 


loginRegBtn.addEventListener('click', () => {

    const homePageURL = "http://localhost/finalProject/"; 

    if (window.location.href == homePageURL) {
        window.location.replace(window.location.href + "register.php");
    } else {
        window.location.replace(homePageURL); 
    }

}); 