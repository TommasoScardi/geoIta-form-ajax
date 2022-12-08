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
    $(`#${idSelRegioni}`).empty();
    regioni.forEach((value) => {
        $(`#${idSelRegioni}`).append($('<option>', {
            value: value.nome,
            text: value.nome
        }));
    });
}

function populateSelProvince(province) {
    $(`#${idSelProvince}`).empty();
    province.forEach((value) => {
        $(`#${idSelProvince}`).append($('<option>', {
            value: value.sigla,
            text: value.nome + ' ' + value.sigla
        }));
    });
}

function populateSelComuni(comuni) {
    $(`#${idSelComuni}`).empty();
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
        url: "http://localhost/form-api/api.php?q=getRegioni",
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
        url: `http://localhost/form-api/api.php?q=getProvince&regione=${regName}`,
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
        url: `http://localhost/form-api/api.php?q=getComuni&sigla=${provSigla}`,
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