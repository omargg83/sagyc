<?php
	require_once("db_.php");
	if(!isset($_SESSION['idusuario']) or strlen($_SESSION['idusuario'])==0 or $_SESSION['autoriza']==0){
		header("location: login/");
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="img/favicon.ico">
    <title>SAGYC POS</title>

    <link rel="icon" type="image/png" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">


    <link rel="stylesheet" href="demo.css" />
    <link rel="stylesheet" href="lib/load/css-loader.css">
    <!-- <link rel="stylesheet" type="text/css" href="lib/modulos.css"/>-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="chat/chat.css" />
    <link href="lib/animate.min.css" rel="stylesheet"/>
    

  </head>
  <body>
    <div class="loader loader-double is-active" id='cargando_div'>
      <h2><span style='font-color:white'></span></h2>
    </div>


  <div class="grid">
      <header class="header">
        <i class="fas fa-bars header__menu"></i>
        <div class="header__search">
          <input class="header__input" placeholder="Search..." />
        </div>
        <div class="header__avatar">
          <div class="dropdown">
            <ul class="dropdown__list">
              <li class="dropdown__list-item">
                <span class="dropdown__icon"><i class="far fa-user"></i></span>
                <span class="dropdown__title">my profile</span>
              </li>
              <li class="dropdown__list-item">
                <span class="dropdown__icon"><i class="fas fa-clipboard-list"></i></span>
                <span class="dropdown__title">my account</span>
              </li>
              <li class="dropdown__list-item">
                <span class="dropdown__icon"><i class="fas fa-sign-out-alt"></i></span>
                <span class="dropdown__title">log out</span>
              </li>
            </ul>
          </div>
        </div>
      </header>

      <aside class="sidenav">
        <div class="sidenav__brand">
          <i class="fas fa-feather-alt sidenav__brand-icon"></i>
          <a class="sidenav__brand-link" href="#">SAGyC</span></a>
          <i class="fas fa-times sidenav__brand-close"></i>
        </div>
        <div class="sidenav__profile">
          <div class="sidenav__profile-avatar"></div>
          <div class="sidenav__profile-title text-light">Matthew H</div>
        </div>
        <div class="row row--align-v-center row--align-h-center">
          <ul class="navList">
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-home"></i></span>
                <span class="navList__subheading-title"> <a href='#dash/index' is='menu-link' class='activeside'>Inicio</a></span>
              
              </div>
            </li>

            <li class="navList__heading">documents<i class="far fa-file-alt"></i></li>
              <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-briefcase-medical"></i></span>
                <span class="navList__subheading-title">insurance</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">medical</li>
                <li class="subList__item">vision</li>
                <li class="subList__item">dental</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-plane-departure"></i></span>
                <span class="navList__subheading-title">travel</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">domestic</li>
                <li class="subList__item">foreign</li>
                <li class="subList__item">misc</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="far fa-angry"></i></span>
                <span class="navList__subheading-title">taxes</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">current</li>
                <li class="subList__item">archives</li>
              </ul>
            </li>

            <li class="navList__heading">messages<i class="far fa-envelope"></i></li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-envelope"></i></span>
                <span class="navList__subheading-title">inbox</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">primary</li>
                <li class="subList__item">social</li>
                <li class="subList__item">promotional</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-eye"></i></span>
                <span class="navList__subheading-title">unread</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">primary</li>
                <li class="subList__item">social</li>
                <li class="subList__item">promotional</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-book-open"></i></span>
                <span class="navList__subheading-title">archives</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">primary</li>
                <li class="subList__item">social</li>
                <li class="subList__item">promotional</li>
              </ul>
            </li>

            <li class="navList__heading">photo album<i class="far fa-image"></i></li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-mountain"></i></span>
                <span class="navList__subheading-title">vacation</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">cambodia</li>
                <li class="subList__item">new york</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-wine-glass-alt"></i></span>
                <span class="navList__subheading-title">anniversary</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">dive trip</li>
                <li class="subList__item">hikathon</li>
                <li class="subList__item">buffalo river</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="navList__subheading-title">university</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">wild horse saloon</li>
                <li class="subList__item">service corps</li>
                <li class="subList__item">graduation</li>
                <li class="subList__item">internships</li>
              </ul>
            </li>

            <li class="navList__heading">statistics<i class="fas fa-chart-bar"></i></li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-credit-card"></i></span>
                <span class="navList__subheading-title">finances</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">mortgage</li>
                <li class="subList__item">investments</li>
                <li class="subList__item">spend log</li>
                <li class="subList__item">owed</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-phone"></i></span>
                <span class="navList__subheading-title">call stats</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">last month</li>
                <li class="subList__item">bi-weekly</li>
                <li class="subList__item">yesterday</li>
                <li class="subList__item">today</li>
              </ul>
            </li>
            <li>
              <div class="navList__subheading row row--align-v-center">
                <span class="navList__subheading-icon"><i class="fas fa-plane"></i></span>
                <span class="navList__subheading-title">trip logs</span>
              </div>
              <ul class="subList subList--hidden">
                <li class="subList__item">amsterdam</li>
                <li class="subList__item">buenos aires</li>
                <li class="subList__item">cambodia</li>
                <li class="subList__item">greenland</li>
              </ul>
            </li>
          </ul>
        </div>
      </aside>

      <main class="main" id='contenido'>
        <div class="main-header">
          <div class="main-header__intro-wrapper">
            <div class="main-header__welcome">
              <div class="main-header__welcome-title text-light">Welcome, <strong>Matthew</strong></div>
              <div class="main-header__welcome-subtitle text-light">How are you today?</div>
            </div>
            <div class="quickview">
              <div class="quickview__item">
                <div class="quickview__item-total">41</div>
                <div class="quickview__item-description">
                  <i class="far fa-calendar-alt"></i>
                  <span class="text-light">Events</span>
                </div>
              </div>
              <div class="quickview__item">
                <div class="quickview__item-total">64</div>
                <div class="quickview__item-description">
                  <i class="far fa-comment"></i>
                  <span class="text-light">Messages</span>
                </div>
              </div>
              <div class="quickview__item">
                <div class="quickview__item-total">27&deg;</div>
                <div class="quickview__item-description">
                  <i class="fas fa-map-marker-alt"></i>
                  <span class="text-light">Austin</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="main-overview">
          <div class="overviewCard">
            <div class="overviewCard-icon overviewCard-icon--document">
              <i class="far fa-file-alt"></i>
            </div>
            <div class="overviewCard-description">
              <h3 class="overviewCard-title text-light">New <strong>Document</strong></h3>
              <p class="overviewCard-subtitle">Europe Trip</p>
            </div>
          </div>
          <div class="overviewCard">
            <div class="overviewCard-icon overviewCard-icon--calendar">
              <i class="far fa-calendar-check"></i>
            </div>
            <div class="overviewCard-description">
              <h3 class="overviewCard-title text-light">Upcoming <strong>Event</strong></h3>
              <p class="overviewCard-subtitle">Chili Cookoff</p>
            </div>
          </div>
          <div class="overviewCard">
            <div class="overviewCard-icon overviewCard-icon--mail">
              <i class="far fa-envelope"></i>
            </div>
            <div class="overviewCard-description">
              <h3 class="overviewCard-title text-light">Recent <strong>Emails</strong></h3>
              <p class="overviewCard-subtitle">+10</p>
            </div>
          </div>
          <div class="overviewCard">
            <div class="overviewCard-icon overviewCard-icon--photo">
              <i class="far fa-file-image"></i>
            </div>
            <div class="overviewCard-description">
              <h3 class="overviewCard-title text-light">New <strong>Album</strong></h3>
              <p class="overviewCard-subtitle">House Concert</p>
            </div>
          </div>
        </div> <!-- /.main__overview -->
        <div class="main__cards">
          <div class="card">
            <div class="card__header">
              <div class="card__header-title text-light">Your <strong>Events</strong>
                <a href="#" class="card__header-link text-bold">View All</a>
              </div>
              <div class="settings">
                <div class="settings__block"><i class="fas fa-edit"></i></div>
                <div class="settings__block"><i class="fas fa-cog"></i></div>
              </div>
            </div>
            <div class="card__main">
              <div class="card__row">
                <div class="card__icon"><i class="fas fa-gift"></i></div>
                <div class="card__time">
                  <div>today</div>
                </div>
                <div class="card__detail">
                  <div class="card__source text-bold">Jonathan G</div>
                  <div class="card__description">Going away party at 8:30pm. Bring a friend!</div>
                  <div class="card__note">1404 Gibson St</div>
                </div>
              </div>
              <div class="card__row">
                <div class="card__icon"><i class="fas fa-plane"></i></div>
                <div class="card__time">
                  <div>Tuesday</div>
                </div>
                <div class="card__detail">
                  <div class="card__source text-bold">Matthew H</div>
                  <div class="card__description">Flying to Bora Bora at 4:30pm</div>
                  <div class="card__note">Delta, Gate 27B</div>
                </div>
              </div>
              <div class="card__row">
                <div class="card__icon"><i class="fas fa-book"></i></div>
                <div class="card__time">
                  <div>Thursday</div>
                </div>
                <div class="card__detail">
                  <div class="card__source text-bold">National Institute of Science</div>
                  <div class="card__description">Join the institute for an in-depth look at Stephen Hawking</div>
                  <div class="card__note">7:30pm, Carnegie Center for Science</div>
                </div>
              </div>
              <div class="card__row">
                <div class="card__icon"><i class="fas fa-heart"></i></div>
                <div class="card__time">
                  <div>Friday</div>
                </div>
                <div class="card__detail">
                  <div class="card__source text-bold">24th Annual Heart Ball</div>
                  <div class="card__description">Join us and contribute to your favorite local charity.</div>
                  <div class="card__note">6:45pm, Austin Convention Ctr</div>
                </div>
              </div>
              <div class="card__row">
                <div class="card__icon"><i class="fas fa-heart"></i></div>
                <div class="card__time">
                  <div>Saturday</div>
                </div>
                <div class="card__detail">
                  <div class="card__source text-bold">Little Rock Air Show</div>
                  <div class="card__description">See the Blue Angels fly with roaring thunder</div>
                  <div class="card__note">11:00pm, Jacksonville Airforce Base</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card__header">
              <div class="card__header-title text-light">Recent <strong>Documents</strong>
                <a href="#" class="card__header-link text-bold">View All</a>
              </div>
              <div class="settings">
                <div class="settings__block"><i class="fas fa-edit"></i></div>
                <div class="settings__block"><i class="fas fa-cog"></i></div>
              </div>
            </div>
            <div class="card">
              <div class="documents">
                <div class="document">
                  <div class="document__img"></div>
                  <div class="document__title">tesla-patents</div>
                  <div class="document__date">07/16/2018</div>
                </div>
                <div class="document">
                  <div class="document__img"></div>
                  <div class="document__title">yearly-budget</div>
                  <div class="document__date">09/04/2018</div>
                </div>
                <div class="document">
                  <div class="document__img"></div>
                  <div class="document__title">top-movies</div>
                  <div class="document__date">10/10/2018</div>
                </div>
                <div class="document">
                  <div class="document__img"></div>
                  <div class="document__title">trip-itinerary</div>
                  <div class="document__date">11/01/2018</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card card--finance">
            <div class="card__header">
              <div class="card__header-title text-light">Monthly <strong>Spending</strong>
                <a href="#" class="card__header-link text-bold">View All</a>
              </div>
              <div class="settings">
                <div class="settings__block"><i class="fas fa-edit"></i></div>
                <div class="settings__block"><i class="fas fa-cog"></i></div>
              </div>
            </div>
            <div id="chartdiv"></div>
          </div>
        </div> <!-- /.main-cards -->
      </main>

      <footer class="footer">
        <p><span class="footer__copyright">&copy;</span> 2020 SAGYC</p>
        <p>Crafted with <i class="fas fa-heart footer__icon"></i> by <a href="https://www.linkedin.com/in/matt-holland/" target="_blank" class="footer__signature">Matt H</a></p>
      </footer>
  </div>

 <!--   Core JS Files   -->
	<script src="lib/jquery-3.5.1.js" type="text/javascript"></script>

	<!--   url   -->
	<script src="lib/jquery/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/jquery/jquery-ui.min.css" />



	<!--   Alertas   -->
	<script src="lib/swal/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="lib/swal/dist/sweetalert2.min.css">

	<!--   para imprimir   -->
	<script src="lib/VentanaCentrada.js" type="text/javascript"></script>

	<!--   Cuadros de confirmación y dialogo   -->
	<link rel="stylesheet" href="lib/jqueryconfirm/css/jquery-confirm.css">
	<script src="lib/jqueryconfirm/js/jquery-confirm.js"></script>

	<!--   iconos   -->
	<link rel="stylesheet" href="lib/fontawesome-free-5.12.1-web/css/all.css">

	<script src="lib/popper.min.js"></script>
	<script src="lib/tooltip.js"></script>

	<!--   Propios   -->
	<script src="chat/chat.js"></script>
	<script src="sagyc.js"></script>
	<script src="vainilla.js"></script>


	<link rel="stylesheet" type="text/css" href="lib/modulos.css"/>

	<!--- calendario -->
	<link href='lib/fullcalendar-4.0.1/packages/core/main.css' rel='stylesheet' />
	<link href='lib/fullcalendar-4.0.1/packages/daygrid/main.css' rel='stylesheet' />
	<link href='lib/fullcalendar-4.0.1/packages/timegrid/main.css' rel='stylesheet' />

	<script src='lib/fullcalendar-4.0.1/packages/core/main.js'></script>
	<script src='lib/fullcalendar-4.0.1/packages/interaction/main.js'></script>
	<script src='lib/fullcalendar-4.0.1/packages/daygrid/main.js'></script>
	<script src='lib/fullcalendar-4.0.1/packages/timegrid/main.js'></script>
	<script src='lib/fullcalendar-4.0.1/packages/core/locales/es.js'></script>

  <!--   Boostrap   -->
  
	<link rel="stylesheet" href="lib/boostrap/css/bootstrap.css">
	<script src="lib/boostrap/js/bootstrap.js"></script>


    <script>
    /* Scripts for css grid dashboard */

      $(document).ready(() => {
        addResizeListeners();
        setSidenavListeners();
        setUserDropdownListener();

        setMenuClickListener();
        setSidenavCloseListener();
      });

      // Set constants and grab needed elements
      const sidenavEl = $('.sidenav');
      const gridEl = $('.grid');
      const SIDENAV_ACTIVE_CLASS = 'sidenav--active';
      const GRID_NO_SCROLL_CLASS = 'grid--noscroll';

      function toggleClass(el, className) {
        if (el.hasClass(className)) {
          el.removeClass(className);
        } else {
          el.addClass(className);
        }
      }

      // User avatar dropdown functionality
      function setUserDropdownListener() {
        const userAvatar = $('.header__avatar');

        userAvatar.on('click', function(e) {
          const dropdown = $(this).children('.dropdown');
          toggleClass(dropdown, 'dropdown--active');
        });
      }

      // Sidenav list sliding functionality
      function setSidenavListeners() {
        const subHeadings = $('.navList__subheading'); 
        //console.log('subHeadings: ', subHeadings);
        const SUBHEADING_OPEN_CLASS = 'navList__subheading--open';
        const SUBLIST_HIDDEN_CLASS = 'subList--hidden';

        subHeadings.each((i, subHeadingEl) => {
          $(subHeadingEl).on('click', (e) => {
            const subListEl = $(subHeadingEl).siblings();

            // Add/remove selected styles to list category heading
            if (subHeadingEl) {
              toggleClass($(subHeadingEl), SUBHEADING_OPEN_CLASS);
            }

            // Reveal/hide the sublist
            if (subListEl && subListEl.length === 1) {
              toggleClass($(subListEl), SUBLIST_HIDDEN_CLASS);
            }
          });
        });
      }

      function toggleClass(el, className) {
        if (el.hasClass(className)) {
          el.removeClass(className);
        } else {
          el.addClass(className);
        }
      }

      // If user opens the menu and then expands the viewport from mobile size without closing the menu,
      // make sure scrolling is enabled again and that sidenav active class is removed
      function addResizeListeners() {
        $(window).resize(function(e) {
          const width = window.innerWidth; 
          //console.log('width: ', width);

          if (width > 750) {
            sidenavEl.removeClass(SIDENAV_ACTIVE_CLASS);
            gridEl.removeClass(GRID_NO_SCROLL_CLASS);
          }
        });
      }

      // Menu open sidenav icon, shown only on mobile
      function setMenuClickListener() {
        $('.header__menu').on('click', function(e) { 
          //console.log('clicked menu icon');
          toggleClass(sidenavEl, SIDENAV_ACTIVE_CLASS);
          toggleClass(gridEl, GRID_NO_SCROLL_CLASS);
        });
      }

      // Sidenav close icon
      function setSidenavCloseListener() {
        $('.sidenav__brand-close').on('click', function(e) {
          toggleClass(sidenavEl, SIDENAV_ACTIVE_CLASS);
          toggleClass(gridEl, GRID_NO_SCROLL_CLASS);
        });
      }

    </script>
  </body>
</html>
