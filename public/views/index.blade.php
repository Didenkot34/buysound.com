<!doctype html>
<html class="no-js" ng-app="angularMaterialAdmin">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/myStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="/angular/node_modules/angular-material/angular-material.min.css">
    <link rel="stylesheet" href="/angular/node_modules/lf-ng-md-file-input/dist/lf-ng-md-file-input.min.css">
    <!-- Compiled and minified CSS materialize -->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- build:css({.tmp/serve,src}) styles/vendor.css -->
    <!-- bower:css -->
    <!-- run `gulp wiredep` to automaticaly populate bower styles dependencies -->
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:css({.tmp/serve,src}) styles/app.css -->
    <!-- inject:css -->
    <!-- css files will be automaticaly insert here -->
    <!-- endinject -->
    <!-- endbuild -->
</head>
<body>
<!--[if lt IE 10]>
<p>You are using an <strong>outdated</strong> browser. Please
    <a href="http://browsehappy.com/">upgrade your browser</a>
    to improve your experience.</p>
<![endif]-->

<div ui-view layout="row" layout-fill></div>

<script src="/js/app.js"></script>
<script src="/js/lodash/lodash.min.js"></script>
<script src="/angular/node_modules/angular/angular.min.js"></script>
<script src="/angular/node_modules/angular-animate/angular-animate.min.js"></script>
<script src="/angular/node_modules/angular-aria/angular-aria.min.js"></script>
<script src="/angular/node_modules/angular-messages/angular-messages.min.js"></script>
<script src="/angular/node_modules/angular-material/angular-material.min.js"></script>
<script src="/angular/node_modules/ui-router/angular-ui-router.min.js"></script>
<script src="/angular/node_modules/ui-bootstrap/ui-bootstrap-tpls-2.2.0.min.js"></script>
<script src="/angular/node_modules/lf-ng-md-file-input/dist/lf-ng-md-file-input.min.js"></script>
<script src="/angular/app.js"></script>
<script src="/angular/index.js"></script>
<!--<script src="/angular/routes.js"></script>-->
<script src="/angular/components/services/NavService.js"></script>
<script src="/angular/models/CRUD.js"></script>
<script src="/angular/components/directives/fileInputDirective.js"></script>
<script src="/angular/components/directives/messagesSection.js"></script>
<script src="/angular/components/directives/panelWidget.js"></script>
<script src="/angular/controllers/admin/groups/groupAdminController.js"></script>
<script src="/angular/controllers/admin/groups/modal/ModalGroupController.js"></script>
<script src="/angular/controllers/admin/songs/songsAdminCtrl.js"></script>
<script src="/angular/controllers/admin/songs/modals/ModalSongCtrl.js"></script>
<script src="/angular/controllers/MainController.js"></script>
<script src="/angular/controllers/home/HomeCtrl.js"></script>
</body>
</html>
