'use strict';

angular.module('angularMaterialAdmin', ['ngAnimate', 'ui.router', 'ui.bootstrap','ngMaterial', 'app'])

  .config(function ($stateProvider, $urlRouterProvider, $mdThemingProvider,
                    $mdIconProvider) {
    $stateProvider
      .state('home', {
        url: '',
        templateUrl: '/views/app/main.html',
        controller: 'MainController',
        controllerAs: 'vm',
        abstract: true
      })
      .state('home.dashboard', {
        url: '/dashboard',
        templateUrl: '/views/app/dashboard.html',
        data: {
          title: 'Dashboard'
        }
      })
      .state('home.profile', {
        url: '/profile',
        templateUrl: '/views/app/profile.html',
        controller: 'ProfileController',
        controllerAs: 'vm',
        data: {
          title: 'Profile'
        }
      })
      .state('home.table', {
        url: '/table',
        controller: 'groupAdminCtrl',
        controllerAs: 'vm',
        templateUrl: '/views/app/table.html',
        data: {
          title: 'Table'
        }
      }) 
        .state('test', {
        url: '',
        templateUrl: '/views/app/test/index.html',
        //controller: 'AdminController',
        //controllerAs: 'vm',
        abstract: true
    })
        .state('test.groups', {
            url: '/test-groups',
            templateUrl: '/views/app/test/groups/groups.html',
            //controller: 'AdminGroupController',
            data: {
                title: 'Admin Groups'
            }
        });

    $urlRouterProvider.otherwise('/dashboard');

    $mdThemingProvider
      .theme('default')
        .primaryPalette('indigo', {
          'default': '600'
        })
        .accentPalette('teal', {
          'default': '500'
        })
        .warnPalette('defaultPrimary');

    $mdThemingProvider.theme('dark', 'default')
      .primaryPalette('defaultPrimary')
      .dark();

    $mdThemingProvider.theme('grey', 'default')
      .primaryPalette('grey');

    $mdThemingProvider.theme('custom', 'default')
      .primaryPalette('defaultPrimary', {
        'hue-1': '50'
    });

    $mdThemingProvider.definePalette('defaultPrimary', {
      '50':  '#FFFFFF',
      '100': 'rgb(255, 198, 197)',
      '200': '#E75753',
      '300': '#E75753',
      '400': '#E75753',
      '500': '#E75753',
      '600': '#E75753',
      '700': '#E75753',
      '800': '#E75753',
      '900': '#E75753',
      'A100': '#E75753',
      'A200': '#E75753',
      'A400': '#E75753',
      'A700': '#E75753'
    });

    $mdIconProvider.icon('user', '/img/icons/user.svg', 64);
  });
