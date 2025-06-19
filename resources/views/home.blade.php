@extends('layouts.app')

    <title>
        Home - Gruppo di Ricerca
    </title>

    <div style="background-image: url('nature.jpg');align-items: center;">
        <div class="container-fluid my-5 text-center" style="max-width: 800px;background-color: white;">
          <div class="container-fluid text-center text-message" style="max-width: 600px;padding-top: 10%;padding-bottom: 9%;">
            <h2>
              {{__('messages.welcome')}}
              <br><br></h2>
            <p class="lead">Il Gruppo di Ricerca XYZ è un team multidisciplinare di scienziati e ricercatori impegnati nell'avanzamento della conoscenza e dell'innovazione. Fondato nel 2010, il nostro gruppo collabora con istituzioni accademiche e industriali di tutto il mondo per esplorare nuove frontiere della scienza e della tecnologia.</p>
            <p class="lead">Siamo entusiasti di condividere i nostri progressi e le nostre scoperte con voi. Esplorate il nostro sito per saperne di più sui nostri progetti, pubblicazioni e collaborazioni. Per ulteriori informazioni, non esitate a contattarci.<br><br></p>
            <button type="button" class="btn btn-secondary btn-lg" onclick="location.href='#contatti'"><span style="text-decoration: none;color: aliceblue;">&nbsp;&nbsp;&nbsp;Contattaci&nbsp;</span><a class="bi bi-envelope bi-envelope-top" style="text-decoration: none;color: aliceblue;"></a></button>
          </div>
        </div>
    </div>
    <div class="container-fluid my-5 text-center">
      <h2>SCOPRI LE NOSTRE ATTIVITÀ<br><br></h2>
      <div class="container-fluid" style="align-items: center;display: flex; justify-content: center;">
        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;" role="button" onclick="location.href='/chisiamo'">
          <img src="chisiamo.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">CHI SIAMO</h5>
            <p class="card-text">Un team multidisciplinare dedicato alla ricerca e all’innovazione.
              Dal 2010 collaboriamo con università, centri di ricerca e aziende per affrontare sfide scientifiche complesse e generare impatto reale attraverso la conoscenza.</p>
          </div>
        </div>
        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;" role="button" onclick="location.href='/progetti'">
          <img src="progetti.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">PROGETTI</h5>
            <p class="card-text">Soluzioni concrete per problemi reali.
              Dalla teoria alla pratica: sviluppiamo progetti che uniscono competenze scientifiche, tecniche e creative per affrontare le sfide del futuro.</p>
          </div>
        </div>
        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;" role="button" onclick="location.href='/pubblicazioni'">
          <img src="pubblicazioni.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">PUBBLICAZIONI</h5>
            <p class="card-text">Condividiamo la nostra conoscenza con il mondo.
              Le nostre pubblicazioni riflettono l’impegno per l’eccellenza scientifica e la diffusione dei risultati in ambito accademico e industriale.</p>
          </div>
        </div>
      </div>
    </div>
