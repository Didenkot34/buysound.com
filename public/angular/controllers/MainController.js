(function(){

  angular
       .module('app')
       .controller('MainController', [
          '$scope','navService', '$mdSidenav', '$mdBottomSheet', '$log', '$q', '$state', '$mdToast',
          MainController
       ]);

  function MainController($scope, navService, $mdSidenav, $mdBottomSheet, $log, $q, $state, $mdToast) {


    $scope.menuItems = [ ];
    $scope.selectItem = selectItem;
    $scope.toggleItemsList = toggleItemsList;
    $scope.showActions = showActions;
    $scope.title = $state.current.data.title;
    $scope.showSimpleToast = showSimpleToast;
    $scope.toggleRightSidebar = toggleRightSidebar;

    navService
      .loadAllItems()
      .then(function(menuItems) {
        $scope.menuItems = [].concat(menuItems);
      });

    function toggleRightSidebar() {
        $mdSidenav('right').toggle();
    }

    function toggleItemsList() {
      var pending = $mdBottomSheet.hide() || $q.when(true);

      pending.then(function(){
        $mdSidenav('left').toggle();
      });
    }

    function selectItem (item) {
      $scope.title = item.name;
      $scope.toggleItemsList();
      $scope.showSimpleToast($scope.title);
    }

    function showActions($event) {
        $mdBottomSheet.show({
          parent: angular.element(document.getElementById('content')),
          templateUrl: '/views/app/partials/bottomSheet.html',
          controller: [ '$mdBottomSheet', SheetController],
          controllerAs: "vm",
          bindToController : true,
          targetEvent: $event
        }).then(function(clickedItem) {
          clickedItem && $log.debug( clickedItem.name + ' clicked!');
        });

        function SheetController( $mdBottomSheet ) {
          var vm = this;

          vm.actions = [
            { name: 'Share', icon: 'share', url: 'https://twitter.com/intent/tweet?text=Angular%20Material%20Dashboard%20https://github.com/flatlogic/angular-material-dashboard%20via%20@flatlogicinc' },
            { name: 'Star', icon: 'star', url: 'https://github.com/flatlogic/angular-material-dashboard/stargazers' }
          ];

          vm.performAction = function(action) {
            $mdBottomSheet.hide(action);
          };
          
        }
    }

    function showSimpleToast(title) {
      $mdToast.show(
        $mdToast.simple()
          .content(title)
          .hideDelay(2000)
          .position('bottom right')
      );
    }
  }

})();
