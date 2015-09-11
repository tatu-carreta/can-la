angular.module('plunker', ['ui.bootstrap']);

function DialogDemoCtrl($scope, $dialog){

  $scope.configureDialog = function(type) {
        var dialog = $dialog.dialog({modalFade: false, resolve: {items: function(){ return ['foo', 'bar']; } }});
        dialog.open('dashboard-config.html', 'MyController');
  };
 
}

// the dialog is injected in the specified controller
function MyController($scope, dialog, items){
  $scope.items = items;
  $scope.close = function(result){
    dialog.close(result);
  };
}
