<?php
require_once 'verificar_sessao.php';
verificar_login(); // Verifica se o usuário está logado
$usuario = obter_usuario_logado();
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Corrija Aí</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="styletemas.css">
  <link rel="stylesheet" href="swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>

<body>

  <main>
    <div class="big-wrapper light">
      <img src="./img/shape.png" alt="" class="shape" />

  <header>
    <div class="container1">
      <div class="logo">
        <img src="logo.png" alt="Logo" />
      </div>

      <div class="links">
        <ul>
          <li><a href="inicio.php">Início</a></li>
          <li><a href="aulas.php">Vídeoaulas</a></li>
          <li><a href="temas.php">Temas</a></li>
          <li><a href="correcao.php">Correção</a></li>
          <li><a href="historico.php">Histórico</a></li>
          <li><a href="logout.php" style="color: #dc3545; margin-left: 360px;">Sair</a></li>
        </ul>
      </div>

      <div class="overlay"></div>

      <div class="hamburger-menu">
        <div class="bar"></div>
      </div>
    </div>
  </header>

  <div class="slide-container swiper">
    <div class="slide-content">
      <div class="card-wrapper swiper-wrapper">

        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/herança africana.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2024</h2>
            <p class="description">Tema: Desafios para a valorização da herança africana no Brasil.</p>

            <a href='temas php/herancaafricana.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/invisibilidade do trabalho.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2023</h2>
            <p class="description">Tema: Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil.</p>

            <a href='temas php/invibilidademulher.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/povos tradicionais.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2022</h2>
            <p class="description">Tema: Os desafios para a valorização de comunidades e povos tradicionais no Brasil.</p>

            <a href='temas php/comunidadestradicionais.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/acesso cidadania.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2021</h2>
            <p class="description">Tema: Invisibilidade e registro civil: garantia de acesso à cidadania no Brasil.</p>

            <a href='temas php/registrocivil.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/doenças mentais.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2020</h2>
            <p class="description">Tema: O estigma associado às doenças mentais na sociedade brasileira.</p>

            <a href='temas php/doencasmentais.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/acesso cinema.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2019</h2>
            <p class="description">Tema: Democratização do acesso ao cinema no Brasil.</p>

            <a href='temas php/acessoaocinema.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/manipulação  internet.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2018</h2>
            <p class="description">Tema: Manipulação do comportamento de usuário pelo controle de dados na internet.</p>

            <a href='temas php/manipulacaointernet.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/formação surdos.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2017</h2>
            <p class="description">Tema: Desafios para a formação educacional de surdos no Brasil.</p>

            <a href='temas php/formacaosurdos.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/intolerancia religiosa.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2016</h2>
            <p class="description">Tema: Caminhos para combater a intolerância religiosa no Brasil.</p>

            <a href='temas php/intoleranciareligiosa.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/violência mulher.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2015</h2>
            <p class="description">Tema: A persistência da violência contra a mulher na sociedade brasileira.</p>

            <a href='temas php/violenciamulher.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>
        <div class="card swiper-slide">
          <div class="image-content">
            <span class="overlay"></span>

            <div class="card-image">
              <img src="temas/publicidade infantil.png" alt="" class="card-img">
            </div>
          </div>

          <div class="card-content">
            <h2 class="name">Enem 2014</h2>
            <p class="description">Tema: Publicidade infantil em questão no Brasil.</p>

            <a href='temas php/publicidadeinfantil.php'><button class="button" href="herancaafricana.php">Ver tema</button></a>
          </div>
        </div>

      </div>
    </div>

    <div class="swiper-button-next swiper-navBtn"></div>
    <div class="swiper-button-prev swiper-navBtn"></div>
    <div class="swiper-pagination"></div>
  </div>

</div>
</main>

</body>

<!-- Swiper JS -->
<script src="swiper-bundle.min.js"></script>

<!-- JavaScript -->
<script src="scripttemas.js"></script>

</html>