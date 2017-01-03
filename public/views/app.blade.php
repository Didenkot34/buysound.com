<!DOCTYPE html>
<html lang="en" ng-app="app" ng-cloak class="ng-cloak">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/angular/node_modules/angular-material/angular-material.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
                {{--<md-fab-toolbar md-open="false" count="0"--}}
                {{--md-direction="left">--}}
                {{--<md-fab-trigger class="align-with-text">--}}
                {{--<md-button aria-label="menu" class="md-fab md-primary">--}}
                {{--<md-icon md-svg-src="img/icons/menu-wite.svg"></md-icon>--}}
                {{--</md-button>--}}
                {{--</md-fab-trigger>--}}

                {{--<md-toolbar>--}}
                {{--<md-fab-actions class="md-toolbar-tools">--}}
                {{--<md-button aria-label="comment" class="md-icon-button">--}}
                {{--<a ui-sref='home'> <md-icon md-svg-src="/img/icons/favorite.svg"></md-icon></a>--}}
                {{--</md-button>--}}
                {{--<md-button aria-label="label" class="md-icon-button">--}}
                {{--<a ui-sref='about'><md-icon md-svg-src="/img/icons/list.svg"></md-icon></a>--}}
                {{--</md-button>--}}
                {{--<md-button aria-label="photo" class="md-icon-button">--}}
                {{--<md-icon md-svg-src="/img/icons/share.svg"></md-icon>--}}
                {{--</md-button>--}}
                {{--</md-fab-actions>--}}
                {{--</md-toolbar>--}}
                {{--</md-fab-toolbar>--}}


                <md-fab-speed-dial md-direction="right" md-open="false"
                                   class="md-fling">
                    <md-fab-trigger>
                        <md-button aria-label="menu" class="md-fab md-primary">
                            <md-tooltip md-direction="down">
                                Меню
                            </md-tooltip>
                            <md-icon md-svg-src="/img/icons/menu-wite.svg"></md-icon>
                        </md-button>
                    </md-fab-trigger>

                    <md-fab-actions>
                        <a ui-sref='home' ui-sref-active="md-primary" aria-label="Главная" class="md-button md-fab md-raised md-mini">
                            <md-tooltip md-direction="down">
                                Главная
                            </md-tooltip>
                            <md-icon md-svg-src="/img/icons/home-icon-84E4FA.svg"></md-icon>
                        </a>
                        <a ui-sref='admin' ui-sref-active="md-primary" aria-label="Admin" class="md-button md-fab md-raised md-mini">
                            <md-tooltip md-direction="down">
                                Admin
                            </md-tooltip>
                            <md-icon md-svg-src="/img/icons/admin.svg"></md-icon>
                        </a>
                        <a ui-sref='about' ui-sref-active="md-primary" aria-label="Google Hangout" class=" md-button md-fab md-raised md-mini">
                            <md-tooltip md-direction="down">
                                О нас
                            </md-tooltip>
                            <md-icon md-svg-src="/img/icons/share-84E4FA.svg"></md-icon>
                        </a>
                    </md-fab-actions>
                </md-fab-speed-dial>
        <div class="container">
            <ui-view>

            </ui-view>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/angular/node_modules/angular/angular.min.js"></script>
    <script src="/angular/node_modules/angular-animate/angular-animate.min.js"></script>
    <script src="/angular/node_modules/angular-aria/angular-aria.min.js"></script>
    <script src="/angular/node_modules/angular-messages/angular-messages.min.js"></script>
    <script src="/angular/node_modules/angular-material/angular-material.min.js"></script>
    <script src="/angular/node_modules/ui-router/angular-ui-router.min.js"></script>
    <script src="/angular/node_modules/ui-bootstrap/ui-bootstrap-tpls-2.2.0.min.js"></script>
    <script src="/angular/app.js"></script>
    <script src="/angular/routes.js"></script>
    <script src="/angular/services/groupService.js"></script>
    <script src="/angular/controllers/groupAdminController.js"></script>
</body>
</html>
