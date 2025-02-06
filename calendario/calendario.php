<?php
// Aguarda 1 segundos antes de redirecionar o usuário
sleep(1);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="in.css">
  <link rel="stylesheet" href="../../css/navbar.css">
  <link rel="shortcut icon" href="../../img/img/calendario.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css" />
  <title>Calendário</title>
</head>

<body>


  <div class="container">
    <div class="left">
      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date"></div>
          <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
          <div>Dom</div>
          <div>Seg</div>
          <div>Ter</div>
          <div>Qua</div>
          <div>Qui</div>
          <div>Sex</div>
          <div>Sáb</div>
        </div>
        <div class="days"></div>
        <div class="goto-today">
          <div class="goto">
            <input type="text" placeholder="mm/yyyy" class="date-input" />
            <button class="goto-btn">Ir</button>
          </div>
          <button class="today-btn">Hoje</button>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="today-date">
        <div class="event-day"></div>
        <div class="event-date"></div>
      </div>
      <div class="events"></div>
      <div class="add-event-wrapper">
        <div class="add-event-header">
          <div class="title">Adicionar Evento</div>
          <i class="fas fa-times close"></i>
        </div>
        <div class="add-event-body">
          <div class="add-event-input">
            <input type="text" placeholder="Nome do evento" class="event-name" />
          </div>
          <div class="add-event-input">
            <input
              type="text"
              placeholder="Hora do evento a partir de"
              class="event-time-from" />
          </div>
          <div class="add-event-input">
            <input
              type="text"
              placeholder="Hora do evento até"
              class="event-time-to" />
          </div>
        </div>
        <div class="add-event-footer">
          <button class="add-event-btn">Adicionar Evento</button>
        </div>
      </div>
    </div>
    <button class="add-event">
      <i class="fas fa-plus"></i>
    </button>
  </div>


  <script src="script.js"></script>
  <script src="calendario.js"></script>
</body>

</html>