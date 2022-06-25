
/**
 * Function to switch between product type
 * ----------------------------------------
 * Function to validate each input field (exg. sku(), name()....etc)
 * ------------------------------------------------------------------
 * Check that all input fields are validated and submit form
 *  
 */

//change of type switch (this function is to dynamically change the input form for atttribute when the type is switched)
function prodType(value) {

    const typeSwitch = {
        "Book": ["weight"],
        "Disc": ["size"],
        "Furniture": ["width", "length", "height"],
    };

    document.querySelectorAll(".inputbox").forEach((node) => (node.style.display = "none"));
    typeSwitch[value].forEach((node) => (document.getElementById(node).style.display = "block"));
}
//end of type switch function

//validate sku
function sku() {
    var sku = document.getElementById("sku").value;
    var error = document.getElementById("skuErrorMessage");

    if (sku === "") {
        error.innerHTML = "Please, submit required data.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

//validate name input field
function name() {
    var name = document.getElementById("name").value;
    var error = document.getElementById("nameErrorMessage");
    if (name == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^[a-zA-Z0-9]*$/g.test(name)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
    // end validate name input field
}

//validate price input field
function price() {
    var price = document.getElementById("price").value;
    var error = document.getElementById("priceErrorMessage");
    if (price == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(price)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function product_type() {
    var productType = document.getElementById("productType");
    var productTypeCheck = productType.options[productType.selectedIndex].value;
    var error = document.getElementById("productTypeErrorMessage");
    if (productTypeCheck == "0") {
        error.innerHTML = "Please, submit required data.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function size() {
    var size = document.getElementById("prod_size").value;
    var error = document.getElementById("sizeErrorMessage");
    if (size == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(size)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function width() {
    var width = document.getElementById("prod_width").value;
    var error = document.getElementById("widthErrorMessage");
    if (width == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(width)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function height() {
    var height = document.getElementById("prod_height").value;
    var error = document.getElementById("heightErrorMessage");
    if (height == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(height)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function length() {
    var length = document.getElementById("prod_length").value;
    var error = document.getElementById("lengthErrorMessage");
    if (length == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(length)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

function weight() {
    var weight = document.getElementById("prod_weight").value;
    var error = document.getElementById("weightErrorMessage");
    if (weight == "") {
        error.innerHTML = "Please, submit required data.";
    } else if (!/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(weight)) {
        error.innerHTML = "Please, provide the data of indicated type.";
    } else {
        error.innerHTML = '';
        return false;
    }
}

var button = document.querySelector('.save');

//the event occurred
button.addEventListener('click', async _ => {
    var skuError = sku();
    var nameError = name();
    var priceError = price();
    var productTypeError = product_type();
    var weightError = false;
    var sizeError = false;
    var widthError = false;
    var lengthError = false;
    var heightError = false;
    var productType = document.getElementById("productType");
    var productTypeCheck = productType.options[productType.selectedIndex].value;
    var validation = {
        "Book": ["weight"],
        "Disc": ["size"],
        "Furniture": ["width", "length", "height"],
        "0": ["0"],
    };

    validation[productTypeCheck].forEach(element => {
        //alert(element);
        if (element == "weight") {
            weightError = weight();
        }
        if (element == "size") {
            sizeError = size();
        }
        if (element == "width") {
            widthError = width();
        }
        if (element == "length") {
            lengthError = length();
        }
        if (element == "height") {
            heightError = height();
        }
    });

    if (skuError == false && nameError == false && priceError == false && productTypeError == false && weightError == false && sizeError == false && widthError == false && lengthError == false && heightError == false) {
        var productForm = document.getElementById("product_form");
        productForm.submit();
    }
});




