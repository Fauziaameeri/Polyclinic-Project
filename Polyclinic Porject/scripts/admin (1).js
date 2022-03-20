
document.getElementById("login").onsubmit = validate;

$('#myModal').modal('toggle');
function validate()
{
    clearErrors();

    let valid = true;

    let username = document.getElementById("username").value;
    let password = document.getElementById("pass").value;

    if (username == "")
    {
        document.getElementById("err-username").style.display = "block";
        valid = false;
    }
    if (password == "")
    {
        document.getElementById("err-pass").style.display = "block";
        valid = false;
    }

    if((password == "") || (username == ""))
    {
        valid = false;
    }





    return valid;
}

function clearErrors()
{
    let errors = document.getElementsByClassName("err");
    for (let i = 0; i< errors.length; i++)
    {
        errors[i].style.display = "none";
    }
}

