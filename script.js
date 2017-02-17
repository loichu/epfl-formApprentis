$(document).ready(function () {
    initButtonsAction();
    if (location.pathname.split("/").slice(-1)[0] == "form.php") {
        initJobChange();
        initButtonsAction();
        initAddChildButtons();
        initAddRadioButtonEvent();
        initDateChecker();
        initDatepicker();
        clearFiles();
    }
});

function checkDate() {
    var birthdate = moment(document.getElementById("birthApp").value, "DD/MM/YYYY")._d;
    var cur = new Date();
    var diff = cur - birthdate; // This is the difference in milliseconds
    var age = Math.floor(diff / 31536000000); // Divide by 1000*60*60*24*365

    if (age <= 12 || birthdate.getFullYear() < 1910 || age > 60) {
        document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';
    }
    else {
        document.getElementById('errorMsg').innerHTML = '';
    }
}

function initDateChecker() {
    $("#birthApp").change(function () {
        checkDate();
    });

    $("#dejaCandAnnee").change(function () {
        checkYearDate("#dejaCandAnnee", "#dejaCandError", 0);
    });
    $("#anneeFin").change(function () {
        checkYearDate("#anneeFin", "#anneeFinError", 1);
    });
}

function addChildren(parentId, maxItems, childTemplate, addButtonId) {
    var i = $(parentId + ' > tbody').children().size() + 1;
    if (i < maxItems) {
        var fullTemplate = childTemplate.replace(/\{(.*?)\}/g, i);
        $(parentId).append(fullTemplate);
        if (i == maxItems - 1) {
            $(addButtonId).hide(750);
        }
    }
}

function changeTitleFile(objFile) {
    objFile.parentNode.setAttribute('title', objFile.value.replace(/^.*[\\/]/, ''));
    checkFileFormat(objFile);
}

function checkFileFormat(obj) {
    var errorSection = obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling;
    var fileExtension = ['pdf', 'jpeg', 'png', 'jpg'];

    if (fileExtension.indexOf(obj.value.split('.').pop().toLowerCase()) == -1) {
        //extension invalide
        errorSection.innerHTML = '<p class ="errorMsgs">Format invalide</p>';
        clearFileInput(obj);
    } else {
        //extension valide
        errorSection.innerHTML = '';
    }
}

function checkYearDate(toCheckValue, errorZone, coefficiantYear) {
    var inputYear = $(toCheckValue).val();
    var currentYear = (new Date).getFullYear() + coefficiantYear;

    if ((inputYear != parseInt(inputYear, 10)) || (currentYear < inputYear)) {
        $(errorZone).html('<p class ="errorMsgs">Date invalide');
    } else {
        $(errorZone).html("");
    }
}

function initButtonsAction() {
    $('#createAc').click(function () {
        window.open("https://guests.epfl.ch/selfaddform", '_blank');
    });
    $('#connectB').click(function () {
        document.location.href = "form.php";
    });
    $('#infoFilieres').click(function () {
        window.open("https://www.ict-berufsbildung.ch/fr/formation-professionnelle/formation-initiale-ict/", '_blank');
    });
    $('#retourHome').click(function () {
        document.location.href = "http://apprentis.epfl.ch/";
        logOutTequila();
    });
    $('#retourFormulaire').click(function () {
        history.go(-1);
    });
}

function initAddChildButtons() {
    $('#addSch').click(function () {
        var template = '<tr><td><input type="text" name="ecole{i}" placeholder="Ecole" autocomplete="off"/></td><td><input type="text" name="lieuEcole{i}" placeholder="Lieu" autocomplete="off"/></td> <td><input type="text" name="niveauEcole{i}" placeholder="Niveau" autocomplete="off"/></td><td><input type="text" name="anneesEcole{i}" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        addChildren('#scolaire', 6, template, '#addSch');
    });

    $('#addPro').click(function () {
        var template = '<tr><td><input type="text" name="employeurPro{i}" placeholder="Employeur" autocomplete="off"/></td><td><input type="text" name="lieuPro{i}" placeholder="Lieu" autocomplete="off"/></td><td><input type="text" name="activitePro{i}" placeholder="Activité" autocomplete="off"/></td><td><input type="text" name="anneesPro{i}" placeholder="de-à(années)" autocomplete="off"/></td></tr>';
        addChildren('#activites', 4, template, '#addPro');
    });

    $('#addStage').click(function () {
        var template = '<tr><td><input type="text" name="activiteStage{i}" placeholder="Métier" autocomplete="off"></td><td><input type="text" name="entrepriseStage{i}" placeholder="Entreprise" autocomplete="off"></td></tr>';
        addChildren('#stages', 5, template, '#addStage');
    });

    $('#addInputFile').click(function () {
        var nextIndex = $('#newCertifZone > tbody').children().size() + 1;
        var zoneId = nextIndex + 7;
        if (nextIndex < 10) {
            $('#newCertifZone').append('<tr><td><div class="tooltip"><label class="file" title="" id="certifLabel' + nextIndex
                + '"><input type="file" name="certifs' + nextIndex
                + '" id="certifs' + nextIndex
                + '" onchange="changeTitleFile(this)" /></label><span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span><p></p><section id="formatErrorZone' + zoneId
                + '"></section></div></td></tr>');
            if (nextIndex == 9) {
                $('#addInputFile').hide(750);
            }
        }
    });
}

function setMajState() {
    $('#maj1')[0].checked ? $("#representants").show(1000) : $("#representants").hide(1000);
}

function setDejaCandState() {
    if ($('#dejaCand1')[0].checked) {
        $("#dejaCandAnnee").hide(750);
        $("#dejaCandAnnee").val("");
        $("#dejaCandError").html("");
    } else {
        $("#dejaCandAnnee").show(750);
    }
}

function initAddRadioButtonEvent() {
    $('#maj1').change(setMajState);
    $('#maj2').change(setMajState);
    setMajState();

    $("#dejaCand1").change(setDejaCandState);
    $("#dejaCand2").change(setDejaCandState);
    setDejaCandState();
}

function clearRepresentants() {
    for (i = 1; i <= 2; i++) {
        $("#genreRep" + i + " :nth-child(1)").prop('selected', true);
        $("#nameRep" + i).val("");
        $("#surnameRep" + i).val("");
        $("#adrRep" + i).val("");
        $("#NPARep" + i).val("");
        $("#telRep" + i).val("");
    }
}

function initDatepicker() {
    $.datepicker.setDefaults($.datepicker.regional["fr"]);
    $("#birthApp").datepicker({ minDate: '-60y', maxDate: '-13y', dateFormat: "dd/mm/yy" });
}

function initJobChange() {
    $("#jb").change(function () {
        var selectedFormation = $("#jb option:selected")[0].value;
        var laborantPeople = ["laborantinChimie", "laborantinPhysique", "laborantinBiologie"];

        if (laborantPeople.indexOf(selectedFormation) == -1) {
            showPolyAndInfoDivs(selectedFormation);

        } else {
            $("#all").hide(1000);

            if (confirm("Pour les métiers de laborantins, l'inscription se fait auprès de l'AVML, cliquer sur ok pour être redirigé-e.")) {
                window.location.replace("https://wp.unil.ch/avml/");
            }
        }
    });
}
/*
function logOutTequila() {
    var win = window.open('https://tequila.epfl.ch/logout', '_blank', 'toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=10000, top=10000, width=100, height=100, visible=none', '');
    win.close();
    //Seems not working yet
}
*/
function showOnFormReturn() {
    var selectedFormation = $("#jb option:selected")[0].value;
    showPolyAndInfoDivs(selectedFormation);
}
function showPolyAndInfoDivs(selectedFormation) {
    $("#all").show(1000);
    selectedFormation == "informaticien" ? $("#infoOnly").show(1000) : $("#infoOnly").hide(500);
    selectedFormation == "informaticien" ? $("#griTest").show(1000) : $("#griTest").hide(500);
    selectedFormation == "polyMecanicien" ? $("#polyOnly").show(1000) : $("#polyOnly").hide(500);
}
function clearFileInput(fileInput) {
    fileInput.parentNode.setAttribute('title', "");
    fileInput.type = '';
    fileInput.type = 'file';
}
function clearFiles() {
    $("#files input").each(function (input) {
        clearFileInput(this);
    });
}
