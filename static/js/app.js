const URL = "http://localhost/form-api/api/api.php";

const idSelRegioni = "regioni";
const idSelProvince = "province";
const idSelComuni = "comuni";

const alertPlaceholder = $('#alertPlaceholder');
const alert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')

    alertPlaceholder.append(wrapper)
}

function populateSelRegioni(regioni) {
    $(`#${idSelRegioni}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    $(`#${idSelProvince}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    $(`#${idSelComuni}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    regioni.forEach((value) => {
        $(`#${idSelRegioni}`).append($('<option>', {
            value: value.nome,
            text: value.nome
        }));
    });
}

function populateSelProvince(province) {
    $(`#${idSelProvince}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    $(`#${idSelComuni}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    province.forEach((value) => {
        $(`#${idSelProvince}`).append($('<option>', {
            value: value.sigla,
            text: value.nome + ' ' + value.sigla
        }));
    });
}

function populateSelComuni(comuni) {
    $(`#${idSelComuni}`).empty().append($('<option>', {
        text: "Scegli ...",
        selected: true
    }));
    comuni.forEach((value) => {
        $(`#${idSelComuni}`).append($('<option>', {
            value: value.nome,
            text: value.nome
        }));
    });
}

function reqRegioni() {
    const ajaxOptions = {
        async: true,
        url: `${URL}?q=getRegioni`,
        method: "GET",
        processData:false
    };

    $.ajax(ajaxOptions)
        .fail(function(errData){
            const jsonRes = JSON.parse(errData);
            alert(jsonRes.message, 'danger');
        })
        .done(function(data){
            const jsonRes = JSON.parse(data);
            populateSelRegioni(jsonRes);
        });
}

function reqProvince(regName) {
    if(regName === undefined) return;
    const ajaxOptions = {
        async: true,
        url: `${URL}?q=getProvince&regione=${regName}`,
        method: "GET",
        processData:false
    };

    $.ajax(ajaxOptions)
        .fail(function(errData){
            const jsonRes = JSON.parse(errData);
            alert(jsonRes.message, 'danger');
        })
        .done(function(data){
            const jsonRes = JSON.parse(data);
            populateSelProvince(jsonRes);
        });
}

function reqComuni(provSigla) {
    if(provSigla === undefined) return;
    const ajaxOptions = {
        async: true,
        url: `${URL}?q=getComuni&siglaProv=${provSigla}`,
        method: "GET",
        processData:false
    };

    $.ajax(ajaxOptions)
        .fail(function(errData){
            const jsonRes = JSON.parse(errData);
            alert(jsonRes.message, 'danger');
        })
        .done(function(data){
            const jsonRes = JSON.parse(data);
            populateSelComuni(jsonRes);
        });
}

function sendReq(data)
{
    if(data === undefined) return;
    if(JSON.stringify(data) === undefined) return;
    const ajaxOptions = {
        async: true,
        url: URL,
        method: "POST",
        processData:false,
        contentType: "application/json",
        data: JSON.stringify(data)
    };

    $.ajax(ajaxOptions)
        .fail(function(errData){
            console.log(errData);
            // const jsonRes = JSON.parse(errData);
            // alert(jsonRes.message, 'danger');
        })
        .done(function(data){
            console.log(data);
            // const jsonRes = JSON.parse(data);
            // alert(jsonRes.message, 'success');
        });
}