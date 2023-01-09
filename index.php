<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Form Indirizzo Residenza</title>
</head>

<body>
    <main class="container p-2">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://img.icons8.com/office/480/globe-earth.png" alt="icon" width="72" height="72">
            <h2>Form Indirizzo Residenza</h2>
            <p class="lead">Il form sottostante fa appoggio ad una pagina API.php che fornisce i dati di autocompletamento per le select qua sotto</p>
        </div>

        <div class="row g-5">
            <div class="form-group">
                <div id="alertPlaceholder"></div>
                <h4 class="mb-3">Indirizzo Residenza</h4>
                <form id="form-geo">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="firstName">Nome</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Mario" value="Mario" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Cognome</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Rossi" value="Rossi" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="regioni" class="form-label">Regione</label>
                        <select class="form-select" id="regioni" required>
                            <option value="" selected>Scegli...</option>
                        </select>
                        <div class="invalid-feedback">
                            Inserisci una Regione valida
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="province" class="form-label">Provincia</label>
                        <select class="form-select" id="province" required>
                            <option value="" selected>Scegli...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comuni" class="form-label">Comune</label>
                        <select class="form-select" id="comuni" required>
                            <option value="" selected>Scegli...</option>
                        </select>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Invia</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="./static/js/app.js"></script>
    <script>
        $(function() {
            reqRegioni();

            $("#regioni").on("change", function(e) {
                const regName = e.currentTarget.value;
                reqProvince(regName);
            });

            $("#province").on("change", function(e) {
                const codProv = e.currentTarget.value;
                reqComuni(codProv);
            })

            $("#form-geo").on("submit", function(e) {
                e.stopPropagation();
                e.preventDefault();

                const dataToSend = {
                    regione: $("#regioni").val(),
                    provincia: $("#province").val(),
                    comune: $("#comuni").val()
                };
                sendReq(dataToSend);
            })
        })
    </script>

</body>

</html>