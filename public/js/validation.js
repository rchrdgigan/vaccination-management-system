function validate() {

    let height = document.forms["myForm"]["height"].value;
    let weight = document.forms["myForm"]["weight"].value;
    var height_m = height.match(/^\d{0,2}(?:\.\d{0,2}){0,1}$/);
    var weight_m = weight.match(/^\d{0,2}(?:\.\d{0,2}){0,1}$/);

    if (!height_m) {
        document.getElementById("height_err").innerHTML = "This height is not valid. Height must be a number.";
        return false;
    }
    if (!weight_m) {
        document.getElementById("weight_err").innerHTML = "This weight is not valid. Weight must be a number.";
        return false;
    }
}
