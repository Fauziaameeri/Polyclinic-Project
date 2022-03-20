/*
This JavaScript will program the Search button while writing using a
for-loop and also filtering
 */
//get button
let myScrollBtn = document.getElementById("btnBack-Top");
//when user scrolls 20px from the top show button
window.onscroll = function () {
    scrollFunction();
}
//scrollFunction
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        myScrollBtn.style.display = "block";
    } else {
        myScrollBtn.style.display = "none";
    }
}
//when user clicks the button goes to top
myScrollBtn.addEventListener("click", scrollToTop);

//scrollToTop function
function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

//arrays that hold data
let data = [];
let hospitalData = [];

//function that displays "more" text or "less" text on card expanding buttons
function toggleBtnText(button) {
    if (button.innerText === 'More') {
        button.innerText = 'Less';
    } else {
        button.innerText = 'More';
    }
}

//function that takes in the value for push_capability and checks to see which pill badge color to apply
function badgeColor(push) {
    let pillColor = "";
    let pushLowCase = push.toLowerCase();
    if (pushLowCase === "push") {
        pillColor = "success";
    } else {
        pillColor = "primary";
    }

    return pillColor;
}

//function that takes in values from the database for phone string and formats them to have parentheses and dash
function formatPhoneNumber(phoneNumberString) {
    const cleaned = ('' + phoneNumberString).replace(/\D/g, '');
    const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
    if (match) {
        return '(' + match[1] + ') ' + match[2] + '-' + match[3];
    }
    return null;
}

//Gets the database objects for fields and maps them  
function getHospitalData() {
    $.ajax({
        type: 'GET',
        url: 'https://short-circuits.greenriverdev.com/Polyclinic/php/polyclinic-service.php',
        success: function (obj) {
            const hospitals = obj || [];
            const hospitalsMapped = hospitals.map(function (hos) {
                const procedures = hos.procedures || '';
                const split = procedures.split(', ');

                return {
                    name: hos.facility_name,
                    city: hos.city,
                    state: hos.state,
                    phone: hos.main_phone,
                    phoneDisplay: formatPhoneNumber(hos.main_phone),
                    fax: hos.main_fax,
                    faxDisplay: formatPhoneNumber(hos.main_fax),
                    film: hos.film_phone,
                    filmDisplay: formatPhoneNumber(hos.film_phone),
                    filmFax: hos.film_fax,
                    filmFaxDisplay: formatPhoneNumber(hos.film_fax),
                    notes: hos.notes,
                    procedures: hos.procedures,
                    proceduresList: split,
                    pushCapable: hos.push_capability,
                    pillColor: badgeColor(hos.push_capability)
                }
            })
            data = hospitalsMapped;
            hospitalData = data;
            rebuildTable();
        }
    })
};

//runs function
getHospitalData();

//function that allows user to filter by search bar, takes in keystrokes and filters data accordingly 
function searchHospital() {
    let input = document.getElementById("search-bar").value;
    const inputList = input.split(',');
    const list = inputList.map(function (value) {
        return value.trim();
    })

    let results = data;
    // Filter by name
    for (let i = 0; i < list.length; i++) {
        const filter = list[i];
        results = results.filter(function (value) {
            return (value.name && value.name.toLowerCase().includes(filter.toLowerCase())) ||
                (value.city && value.city.toLowerCase().includes(filter.toLowerCase())) ||
                (value.state && value.state.toLowerCase().includes(filter.toLowerCase())) ||
                (value.phone && value.phone.includes(filter)) ||
                (value.fax && value.fax.includes(filter)) ||
                (value.film && value.film.includes(filter)) ||
                (value.filmFax && value.filmFax.includes(filter)) ||
                (value.procedures && value.procedures.toLowerCase().includes(filter.toLowerCase())) ||
                (value.pushCapable && value.pushCapable.toLowerCase().includes(filter.toLowerCase()));
        });
    }

    hospitalData = results;

    rebuildTable();
}

//function that adds the procedures to the card in h6 tags building down the card
function buildProcedureList(proceduresList) {
    let list = ``;
    for (let i = 0; i < proceduresList.length; i++) {
        list += `<h6>${proceduresList[i]}</h6>`;
    }
    return list;
}

//function that checks if there is a city or state and adds a space, comma, and dash as needed
function populateCityState(city, state) {
    let cityState = '';
    if (city || state) {
        cityState += ' - ';
    }

    if (city) {
        cityState += `${city}`;
    }

    if (state) {
        cityState += `, ${state}`;
    }

    return cityState;
}

function generateBadge(pillColor, pushCapable) {
    if (pushCapable === 'no') {
        return `<br>`;
    }
    return `<span class="badge badge-pill badge-${pillColor}">${pushCapable}</span>`;
}

//function that builds the cards for user end and implements the data object into the correct fields, creates two cards for each row.
function rebuildTable() {
    const spinner = document.getElementById("hospital-cards-loading");
    if (spinner) {
        spinner.style.display = 'none';
    }
    const table = document.getElementById("hospital-cards");
    const hospitalCards = [];

    //structure for the cards that are then put into a array to be displayed
    let cardRow = [];
    for (let i = 0; i < hospitalData.length; i++) {
        const hospital = hospitalData[i];
        const card = `
            <div class="col" id="cardInfo${i}">
                <div class="card d-inline-block border rounded border-dark">
                    <div id="search${i}" class="p-2"><h4 class="name">${hospital.name}${populateCityState(hospital.city, hospital.state)}</h4>
                        <h5>${generateBadge(hospital.pillColor, hospital.pushCapable)}</h5>
                        <h5 class="border-bottom border-dark" >Medical Record Contact Information</h5>
                        <p>Phone: ${hospital.phoneDisplay || 'N/A'}</p>
                        <p>Fax: ${hospital.faxDisplay || 'N/A'}</p>
                        <h5 class="border-bottom border-dark">Film Library Contact Information</h5>
                        <p>Phone: ${hospital.filmDisplay || 'N/A'}</p>
                        <p>Fax: ${hospital.filmFaxDisplay || 'N/A'}</p>
                        <div id="more${i}" class="collapse">
                            <h5 class="border-bottom border-dark">Procedure:</h5>
                            ${buildProcedureList(hospital.proceduresList)}
                            <br />
                            <h6>Notes</h6>
                            <div class="mt-2">
                                <p class="comment-text border border-danger rounded bg-light">
                                    ${hospital.notes || 'No notes added'}
                                </p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-dark" data-toggle="collapse" data-target="#more${i}" style="margin: 5px;" onclick="toggleBtnText(this)">More</button>
                </div>
            </div>
        `;
        cardRow.push(card);

        if (i % 2 === 1) {
            hospitalCards.push(
                `
                <div class="row">
                    ${cardRow[0]}
                    ${cardRow[1]}
                </div>
                `
            );
            cardRow = [];
        }
    }

    if (cardRow.length > 0) {
        hospitalCards.push(
            `
                <div class="row">
                    ${cardRow[0]}
                </div>
            `
        );
    }

    table.innerHTML = hospitalCards;
}



function tablePrint() {
    let url = "http://short-circuits.greenriverdev.com/Polyclinic/table.php";
    let printWindow = window.open(url);
    printWindow.print();
}