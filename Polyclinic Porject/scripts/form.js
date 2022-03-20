document.getElementById("create-form").onsubmit = validate;

function validate() {

    clearErrors();
    let valid = true;

    let hname = document.getElementById("hname").value;

    if(hname == ""){
        document.getElementById("err-hname").style.display = "block";
        valid = false;
    }

    let phone = document.getElementById("phone").value;
    let fax_num = document.getElementById("fax_num").value;

    /*
    var ok = phone.search(/^\(?\d{3}\D*\d{3}\D*\d{4}$/);
    if (ok==0) {
        var parts = phone.match(/^\(?(\d{3})\D*(\d{3})\D*(\d{4})$/);
        output.value='('+parts[1]+') '+parts[2]+'-'+parts[3];
    }

     */

    $("input[name='phone']").keyup(function() {
        $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1)$2-$3"));
    });

    if ((phone != "") && (fax_num == "")) {
        document.getElementById("err-fax").style.display = "block";
        valid = false;
    }

    if ((phone != "") && (fax_num == "")) {
        document.getElementById("err-fax").style.display = "block";
        valid = false;
    }

    if ((phone == "") && (fax_num != "")) {
        document.getElementById("err-phone").style.display = "block";
        valid = false;
    }

    let filmPhone = document.getElementById("filmNum").value;
    let filmFax = document.getElementById("film_fax_num").value;

    if ((filmPhone != "") && (filmFax == "")) {
        document.getElementById("err-film-fax").style.display = "block";
        valid = false;
    }

    if ((filmPhone == "") && (filmFax != "")) {
        document.getElementById("err-film-phone").style.display = "block";
        valid = false;
    }

    // TODO: there must be a medical records phone and fax OR film library...
    if ((phone == "") && (filmPhone == "" )) {
        document.getElementById("err-aphone").style.display = "block";
        valid = false;
    }



    // TODO: at least one image type must be selected
    const xr = document.getElementById("xr").checked;
    const us = document.getElementById("us").checked;
    const mri = document.getElementById("mri").checked;
    const ct = document.getElementById("ct").checked;
    const mg = document.getElementById("mg").checked;
    const path = document.getElementById("path").checked;
    const dexa = document.getElementById("dexa").checked;

    let images = document.getElementsByName("procedure[]");
    let imagesCount = 0;

    for (let i = 0; i < images.length; i++) {

        if (images[i].checked)
        {
            imagesCount++;
            console.log(imagesCount);
        }
    }

    if (imagesCount < 1)
    {
        document.getElementById("err-images").style.display = "block";
        valid = false;
    } else {
        document.getElementById("err-images").style.display = "none";
    }


    // TODO: At least one push option must be selected
    const pushOption = document.getElementById("push_option").value;

    if (pushOption == "none"){

        document.getElementById("err-push").style.display="block";
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