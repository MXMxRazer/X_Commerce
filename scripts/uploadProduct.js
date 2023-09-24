//Sets the current date to the publish date input

// Using it for default date while uploading the product
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

document.getElementById('publishDate').value = new Date().toDateInputValue();