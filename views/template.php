<!doctype html>
<?php
  session_start();
  function normalizeTemplateAccessLevel($value) {
    $allowed = ['Full', 'View', 'Restricted'];
    return in_array($value, $allowed) ? $value : 'Full';
  }
?>
<html
    lang="en"
    class=" layout-navbar-fixed layout-menu-fixed layout-compact "
    dir="ltr"
    data-skin="default"
    data-bs-theme="light"
    data-assets-path="views/assets/"
    data-template="vertical-menu-template">
    <head>
      <meta charset="utf-8" />
      <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <meta name="robots" content="noindex, nofollow" />
      <title>LABTRIX</title>

      <meta name="description" content="" />
      <link rel="icon" type="image/x-icon" href="views/assets/img/favicon/favicon.ico" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

      <link rel="stylesheet" href="views/assets/vendor/fonts/iconify-icons.css" />
      <script src="views/assets/vendor/libs/@algolia/autocomplete-js.js"></script>
      <link rel="stylesheet" href="views/assets/vendor/libs/node-waves/node-waves.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/pickr/pickr-themes.css" />
      <link rel="stylesheet" href="views/assets/vendor/css/core.css" />
      <link rel="stylesheet" href="views/assets/css/demo.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/apex-charts/apex-charts.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/swiper/swiper.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
      <link rel="stylesheet" href="views/assets/vendor/fonts/flag-icons.css" />

      <link rel="stylesheet" href="views/assets/vendor/css/pages/cards-advance.css" />
      <script src="views/assets/vendor/js/helpers.js"></script>
      <script src="views/assets/vendor/js/template-customizer.js"></script>
      <script src="views/assets/js/config.js"></script>

      <!-- LOGIN -->
      <link rel="stylesheet" href="views/assets/vendor/libs/@form-validation/form-validation.css" />
      <link rel="stylesheet" href="views/assets/vendor/css/pages/page-auth.css"/>

      <!-- SELECT TAG -->
      <link rel="stylesheet" href="views/assets/vendor/libs/select2/select2.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/tagify/tagify.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/typeahead-js/typeahead.css"/>

      <!-- PICKERS -->
      <link rel="stylesheet" href="views/assets/vendor/libs/flatpickr/flatpickr.css"/>
      <link rel="stylesheet" href="views/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/jquery-timepicker/jquery-timepicker.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/pickr/pickr-themes.css"/>

      <!-- SWEET ALERT -->
      <link rel="stylesheet" href="views/assets/vendor/libs/animate-css/animate.css" />
      <link rel="stylesheet" href="views/assets/vendor/libs/sweetalert2/sweetalert2.css" />

      <!-- FORM VALIDATION -->
      <link rel="stylesheet" href="views/assets/vendor/libs/@form-validation/form-validation.css" />

      <!-- STICKY ACTIONS -->
       <script src="views/assets/vendor/libs/cleave-zen/cleave-zen.js"></script>
       <script src="views/assets/js/form-layouts.js"></script>
    </head>
  <body
    data-access-level="<?php
      $defaultAccessLevel = 'Full';
      if (isset($_GET['route'])) {
        $previewRoute = basename($_GET['route']);
        $routeAccessPreview = [
          'diagnostics' => 'diagnostics',
          'staffclinic' => 'clinicstaff',
          'patientregistry' => 'patientregistry',
          'labassays' => 'laboratoryassays',
          'reports1' => 'reports',
          'reports2' => 'reports',
          'accessprivelege' => 'accessprivelege',
          "reset" => "resetting.js"
        ];
        if (array_key_exists($previewRoute, $routeAccessPreview)) {
          $sessionKey = $routeAccessPreview[$previewRoute];
          $defaultAccessLevel = normalizeTemplateAccessLevel($_SESSION[$sessionKey] ?? 'Full');
        }
      }
      echo htmlspecialchars($defaultAccessLevel);
    ?>">
    <!-- Layout wrapper -->
    <?php 
      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "ok"){
        echo '<div class="layout-wrapper layout-content-navbar">';
          echo '<div class="layout-container">';
            include "modules/sidebar.php";
            echo '<div class="menu-mobile-toggler d-xl-none rounded-1">';
              echo '<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">';
              echo '<i class="ti tabler-menu icon-base"></i>';
              echo '<i class="ti tabler-chevron-right icon-base"></i>';
            echo '</a>';
            echo '</div>';

            echo '<div class="layout-page">';
              include "modules/navbar.php";
              echo '<div class="content-wrapper">';
              if(isset($_GET["route"])){
                $route = basename($_GET["route"]);
                $allowedRoutes = [
                    'home',
                    'diagnostics',
                    'staffclinic',
                    'patientregistry',
                    'labassays',
                    'reports1',
                    'reports2',
                    'accessprivelege',
                    'logout',
                    'reset'
                    
                ];
                $routeAccessMap = [
                    'diagnostics' => 'diagnostics',
                    'staffclinic' => 'clinicstaff',
                    'patientregistry' => 'patientregistry',
                    'labassays' => 'laboratoryassays',
                    'reports1' => 'reports',
                    'reports2' => 'reports',
                    'accessprivelege' => 'accessprivelege',
                    "reset" => "resetting"
                ];

                if (in_array($route, $allowedRoutes)) {
                    if (array_key_exists($route, $routeAccessMap)) {
                        $accessKey = $routeAccessMap[$route];
                        $accessLevel = normalizeTemplateAccessLevel($_SESSION[$accessKey] ?? 'Full');

                        if ($accessLevel === 'Restricted') {
                            include "modules/404.php";
                        } else {
                            include "modules/" . $route . ".php";
                        }
                    } else {
                        include "modules/" . $route . ".php";
                    }
                } else {
                    include "modules/404.php";
                }
              }else{
                $route = "home";
                include "modules/home.php"; 
              }
              echo '</div>';
              echo '<div class="layout-overlay layout-menu-toggle"></div>';
              echo '<div class="drag-target"></div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }else{
        include "modules/login.php";
      }
    ?>
    <!-- Overlay -->
    <script src="views/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="views/assets/vendor/libs/popper/popper.js"></script>
    <script src="views/assets/vendor/js/bootstrap.js"></script>
    <script src="views/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="views/assets/vendor/libs/pickr/pickr.js"></script>
    <script src="views/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="views/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="views/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="views/assets/vendor/js/menu.js"></script>

    <script src="views/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="views/assets/vendor/libs/swiper/swiper.js"></script>
    <script src="views/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="views/assets/js/main.js"></script>
    <script src="views/assets/js/dashboards-analytics.js"></script>

    <!-- FORM BASIC INPUT -->
    <script src="views/assets/js/form-basic-inputs.js"></script>

    <!-- LOGIN / FORM VALIDATION -->
    <script src="views/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="views/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="views/assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="views/assets/js/main.js"></script>
    <script src="views/assets/js/pages-auth.js"></script>
    <script src="views/assets/js/form-validation.js"></script>
    <script src="views/assets/js/form-layouts.js"></script>

    <!-- SELECT TAG -->
    <script src="views/assets/vendor/libs/select2/select2.js"></script>
    <script src="views/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="views/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="views/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="views/assets/vendor/libs/bloodhound/bloodhound.js"></script>

    <script src="views/assets/js/forms-selects.js"></script>
    <script src="views/assets/js/forms-tagify.js"></script>
    <script src="views/assets/js/forms-typeahead.js"></script>

    <!-- PICKERS -->   
    <script src="views/assets/vendor/libs/moment/moment.js"></script>
    <script src="views/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="views/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
    <script src="views/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>
    <script src="views/assets/vendor/libs/pickr/pickr.js"></script>

    <script src="views/assets/js/forms-pickers.js"></script>

    <!-- SWEET ALERT -->  
    <script src="views/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="views/assets/js/extended-ui-sweetalert2.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/jquery.inputmask.min.js"></script>

      <?php
      if (isset($route)) {
        $routeScripts = [
          "home" => ["home.js"],
          "staffclinic" => ["staffclinic.js","med.js"],
          "patientregistry" => ["patientregistry.js"],
          "labassays" => ["labassays.js"],
          "accessprivelege" => ["accessprivelege.js"],
          "reset" => ["resetting.js"]
        ];

        if (array_key_exists($route, $routeScripts)) {
          foreach ($routeScripts[$route] as $script) {
            $scriptPath = "views/js/" . $script;
            if (file_exists($scriptPath)) {
              echo '<script src="' . $scriptPath . '"></script>';
            }
          }
        }
      }
      ?>

      <?php
      $globalScriptPath = "views/js/access-control.js";
      if (file_exists($globalScriptPath)) {
        echo '<script src="' . $globalScriptPath . '"></script>';
      }
      ?>
