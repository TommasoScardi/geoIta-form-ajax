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
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Form Indirizzo Residenza</h2>
      <p class="lead">Il form sottostante fa appoggio ad una pagina API.php che fornisce i dati di autocompletamento per le select qua sotto</p>
    </div>

    <div class="row g-5">
      <div class="">
        <div class="alertPlaceholder"></div>
        <h4 class="mb-3">Indirizzo Residenza</h4>
        <form class="needs-validation" novalidate="">
          
        <div class="">
              <label for="country" class="form-label">Regione</label>
              <select class="form-select" id="regioni" required="">
                <option value="">Scegli...</option>
              </select>
              <div class="invalid-feedback">
                Inserisci una Regione valida
              </div>
            </div>

            <div class="">
              <label for="state" class="form-label">Provincia</label>
              <select class="form-select" id="province" required="">
                <option value="">Scegli...</option>
              </select>
              <div class="invalid-feedback">
                Inserisci una Provincia valida
              </div>
            </div>

            <div class="">
              <label for="state" class="form-label">Comune</label>
              <select class="form-select" id="comuni" required="">
                <option value="">Scegli...</option>
              </select>
              <div class="invalid-feedback">
                Inserisci un Comune valido
              </div>
            </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Invia</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">© 2017–2021 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
    
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="./static/js/app.js"></script>
<script>
    $(function(){
        reqRegioni();

        $("#regioni").on("change", function(e){
            const regName = e.currentTarget.value;
            reqProvince(regName);
        });

        $("#province").on("change", function(e){
            const codProv = e.currentTarget.value;
            reqComuni(codProv);
        })
    })
</script>

</body>
</html>