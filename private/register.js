const countriesSelect = document.getElementById("ec-select-country");
const statesSelect = document.getElementById("ec-select-state");
const citiesSelect = document.getElementById("ec-select-city");
// Load countries from API
fetch("https://api.countrystatecity.in/v1/countries", {
    headers: {
        "X-CSCAPI-KEY":
            "UU9nakNWczhNOGU4dUpsOHBXYXlHSFFwdmY1S2hhMWZ1c3ZhZmRiVg==",
    },
})
    .then((response) => response.json())
    .then((countries) => {
        countries.forEach((country) => {
            const option = document.createElement("option");
            option.value = country.iso2;
            option.text = country.name;
            countriesSelect.add(option);
        });
    });

// Populate states based on selected country
function populateStates() {
    const countryId = countriesSelect.value;

    statesSelect.innerHTML = "<option selected disabled>Region/State</option>";
    citiesSelect.innerHTML = "<option selected disabled>Select city</option>";

    fetch(`https://api.countrystatecity.in/v1/countries/${countryId}/states`, {
        headers: {
            "X-CSCAPI-KEY":
                "UU9nakNWczhNOGU4dUpsOHBXYXlHSFFwdmY1S2hhMWZ1c3ZhZmRiVg==",
        },
    })
        .then((response) => response.json())
        .then((states) => {
            if (states.length === 0) {
                statesSelect.innerHTML = "<option>No data available</option>";
                citiesSelect.innerHTML = "<option>No data available</option>";
            } else {
                states.forEach((state) => {
                    const option = document.createElement("option");
                    option.value = state.iso2;
                    option.text = state.name;
                    option.setAttribute("data", state.id);
                    statesSelect.add(option);
                });
            }
        });
}

// Populate cities based on selected state
function populateCities() {
    const stateName = statesSelect.value;
    const countryId = countriesSelect.value;

    citiesSelect.innerHTML = "<option selected disabled>Select city</option>";

    fetch(
        `https://api.countrystatecity.in/v1/countries/${countryId}/states/${stateName}/cities`,
        {
            headers: {
                "X-CSCAPI-KEY":
                    "UU9nakNWczhNOGU4dUpsOHBXYXlHSFFwdmY1S2hhMWZ1c3ZhZmRiVg==",
            },
        }
    )
        .then((response) => response.json())
        .then((cities) => {
            if (cities.length === 0) {
                citiesSelect.innerHTML = "<option>No data available</option>";
            } else {
                cities.forEach((city) => {
                    const option = document.createElement("option");
                    option.value = city.name;
                    option.text = city.name;
                    citiesSelect.add(option);
                });
            }
        });
}

function geasdt() {
    // Get the selected country, state, or city text
    const selectedCountryText =
        document.getElementById("ec-select-country").options[
            document.getElementById("ec-select-country").selectedIndex
        ].text;
    const selectedStateText =
        document.getElementById("ec-select-state").options[
            document.getElementById("ec-select-state").selectedIndex
        ].text;
    const selectedCityText =
        document.getElementById("ec-select-city").options[
            document.getElementById("ec-select-city").selectedIndex
        ].text;

    console.log("Selected Country:", selectedCountryText);
    console.log("Selected State:", selectedStateText);
    console.log("Selected City:", selectedCityText);
}

/*
// Load countries from JSON
const countriesSelect = document.getElementById("ec-select-country");
const statesSelect = document.getElementById("ec-select-state");
const citiesSelect = document.getElementById("ec-select-city");

fetch("/json/countries.json")
    .then((response) => response.json())
    .then((countries) => {
        countries.forEach((country) => {
            const option = document.createElement("option");
            option.value = country.name;
            option.text = country.name + " - " + country.native;
            option.setAttribute("data", country.id);
            countriesSelect.add(option);
        });
    });

// Populate states based on selected country
function populateStates() {
    const selectedOption =
        countriesSelect.options[countriesSelect.selectedIndex];
    const countryId = selectedOption.getAttribute("data");

    statesSelect.innerHTML = "<option selected disabled>Region/State</option>";
    citiesSelect.innerHTML = "<option selected disabled>Select city</option>";

    fetch("/json/states.json")
        .then((response) => response.json())
        .then((states) => {
            const filteredStates = states.filter(
                (state) => state.country_id == countryId
            );
            if (filteredStates.length === 0) {
                statesSelect.innerHTML = "<option>No data available</option>";
                citiesSelect.innerHTML = "<option>No data available</option>";
            } else {
                filteredStates.forEach((state) => {
                    const option = document.createElement("option");
                    option.value = state.name;
                    option.text = state.name;
                    option.setAttribute("data", state.id);
                    statesSelect.add(option);
                });
            }
        });
}

// Populate cities based on selected state
function populateCities() {
    const selectedOption = statesSelect.options[statesSelect.selectedIndex];
    const stateId = selectedOption.getAttribute("data");
    citiesSelect.innerHTML = "<option selected disabled>Select city</option>";

    fetch("/json/cities.json")
        .then((response) => response.json())
        .then((cities) => {
            const filteredCities = cities.filter(
                (city) => city.state_id == stateId
            );
            if (filteredCities.length === 0) {
                citiesSelect.innerHTML = "<option>No data available</option>";
            } else {
                filteredCities.forEach((city) => {
                    const option = document.createElement("option");
                    option.value = city.name;
                    option.text = city.name;
                    citiesSelect.add(option);
                });
            }
        });
}

function geasdt() {
    // Get the selected country, state, or city text
    const selectedCountryText =
        document.getElementById("ec-select-country").options[
            document.getElementById("ec-select-country").selectedIndex
        ].text;
    const selectedStateText =
        document.getElementById("ec-select-state").options[
            document.getElementById("ec-select-state").selectedIndex
        ].text;
    const selectedCityText =
        document.getElementById("ec-select-city").options[
            document.getElementById("ec-select-city").selectedIndex
        ].text;

    console.log("Selected Country:", selectedCountryText);
    console.log("Selected State:", selectedStateText);
    console.log("Selected City:", selectedCityText);
}

*/


$(document).ready(function () {
    $("#regiser-form").submit(function (event) {
        // منع تقديم النموذج الافتراضي
        event.preventDefault();

        $("#btn_regiser").prop("disabled", true);
        // جمع بيانات النموذج وتحويلها إلى كائن JSON
        var formData = {};
        $(this)
            .serializeArray()
            .forEach(function (item) {
                formData[item.name] = item.value;
            });

        // إرسال البيانات باستخدام AJAX POST
        $.ajax({
            type: "POST",
            url: "/api/register",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (data) {
                //console.log(data.message);

                Swal.fire({
                    position: "center",
                    icon: "success",
                    text: "You have logged in successfully. Please wait...",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                }).then((result) => {
                    window.location.reload();
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    text: JSON.parse(xhr.responseText).message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                }).then((result) => {
                    $("#btn_regiser").prop("disabled", false);
                    $("#login-form")[0].reset();
                });
                //console.error(JSON.parse(xhr.responseText).message); // عرض رسالة خطأ تسجيل الدخول
            },
        });
    });
});
