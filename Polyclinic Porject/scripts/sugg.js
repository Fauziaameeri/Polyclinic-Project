document.getElementById("sugg-form").onsubmit = validate;

function validate(){

    clearErrors();

    let valid = true;

    let ename = document.getElementById("ename").value;

    if (ename==""){
        document.getElementById('err-ename').style.display = "block";
        valid = false;
    }

    let eemail = document.getElementById('eemail').value;

    if (eemail==""){
        document.getElementById('err-eemail').style.display = "block";
        valid = false;
    }

    let suggEntry = document.getElementById('sugEntry').value;

    if(suggEntry ==""){
        document.getElementById('err-sugEntry').style.display = "block";
        valid = false;
    }

    return valid;

}

//Clear all error messages
function clearErrors()
{
    let errors = document.getElementsByClassName("err");
    for (let i = 0; i< errors.length; i++)
    {
        errors[i].style.display = "none";
    }
}