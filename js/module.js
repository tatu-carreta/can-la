angular.module('app', ['ui.bootstrap', 'angularFileUpload', 'ui', 'ngTagsInput'])
        .filter('tagFilter', function() {
    return function(tags, id)
    {
        var tempTags = [];
        angular.forEach(tags, function(tag)
        {
            if (tag.id == id)
            {
                angular.forEach(tag.data, function(texto) {
                    tempTags.push(texto);
                });

            }
        });

        return tempTags;
    }

}).directive('ckEditor', [function() {
        return {
            require: '?ngModel',
            link: function($scope, elm, attr, ngModel) {

                var ck = CKEDITOR.replace(elm[0]);

                ck.on('pasteState', function() {
                    $scope.$apply(function() {
                        ngModel.$setViewValue(ck.getData());
                    });
                });

                ngModel.$render = function(value) {
                    ck.setData(ngModel.$modelValue);
                };
            }
        };

    }]).filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});

var paginador = function($scope) {

}


var modalDefault = function($scope, $modal, $log) {


    $scope.init = function(template, chosenController) {
        $scope.template = template; //El template que va a mostrar el modal, se incializa usando init del lado de la vista
        $scope.chosenController = chosenController; //el controlador que utilizara el modal
    };


    $scope.open = function() {
        var modalInstance = $modal.open({
            templateUrl: $scope.template,
            controller: $scope.chosenController
        });

        modalInstance.result.then(function() {
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
};


function CollapseDemoCtrl($scope) {
    $scope.isCollapsed = true;
}
;



var mainController = function($scope, $http) {
    $scope.search = {nombreMiembro: '', nombrePais: ''};
    $scope.tags = [];
    $scope.dataArray = {};
    var tmpList = [];
    $scope.paises = {};


//PAGINACION
    $scope.currentPage = 0;
    $scope.pageSize = 5;
    $scope.numberOfPages = function(dataArrayLength) {
        return Math.ceil(dataArrayLength / $scope.pageSize);
    }

/////////////////
    $scope.sortableSecretariado = {
      stop: function(e, ui) 
      {
          // this callback has the changed model
          var logEntry = tmpList.map(function(i){
            return i.idSecretariado;
          }).join(',');
         
          $scope.ordenar("secretariado", logEntry);
      },
      revert: true,
      tolerance: "pointer"
    };

    $scope.sortableAreas = {
      stop: function(e, ui) 
      {
          // this callback has the changed model
          var logEntry = tmpList.map(function(i){
            return i.idArea;
          }).join(',');
      
          $scope.ordenar("areas", logEntry);

      },
    };

    $scope.ordenar = function(carpeta, dataArray){
        $http.post("../../php/ordenar.php?carpeta="+carpeta,  $.param(dataArray),
        {
            headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
            cache: false
        }).
        success(function(data, status, headers, config) {
            console.log(data);
        });
    };

    $scope.reiniciarPaginador = function() {
        $scope.currentPage = 0;
    }

    $scope.allowNullValue = function(expected, actual) {
        if (actual === null) {
            return true;
        } else {
            // angular's default (non-strict) internal comparator
            var text = ('' + actual).toLowerCase();
            return ('' + expected).toLowerCase().indexOf(text) > -1;
        }
    };

    $scope.erase = [
        'Erase', "una", "vez", "en", "mejico"
    ];
    $scope.paises = function()
    {
        $http.post(controladorModel + "?language=" + lang, $.param({"section": "paises"}),
        {
            headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
            cache: false
        }).
                success(function(data, status, headers, config) {

            $scope.paises = data;
            console.log($scope.paises);

        });
    }
    $scope.init = function()
    {

        $http.post(controladorModel + "?language=" + lang, $.param({"section": section}),
        {
            headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
            cache: false
        }).
                success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available

            tmpList = data;
            $scope.dataArray = data;
            console.log($scope.dataArray);
            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });

    }

    $scope.verMasArea = function(idArea) {
        $http.post(controladorModel + "?language=" + lang, $.param({"section": "verMasArea", "idArea": idArea}),
        {
            headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
            cache: false
        }).
                success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available

            $scope.dataArray = data;
            console.log($scope.dataArray);
            //$scope.verMas = data;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });
    };


    $scope.fetchTags = function(id) {

        $http.post(controladorModel, $.param({"section": etiquetas, "id": id}),
        {
            headers:
                    {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
            cache: false
        }).
                success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available

            $scope.tags.push({"id": id, "data": data});
            console.log($scope.tags);
            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });


    };

    $scope.eliminarVideoImagenGenerico = function(id, carpeta, url, section, message)
    {
        if (confirm(message))
        {
            var dataArray = {"section": section, "id": id, "carpeta": carpeta};
            console.log(dataArray);
            $http.post(url, $.param(dataArray),
                    {
                        headers:
                                {
                                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                                },
                        cache: false
                    }).
                    success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                console.log(data);
                $scope.alertSuccess = data.texto;
                window.setTimeout(function() {
                    window.location.reload();
                }, 1000); //RECARGAR DESPUES DE 2 SEGUNDOS
            }).
                    error(function(data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                console.log(data);
                $scope.alertError = data.texto;
            });
        }
    }

    $scope.eliminarGenerico = function(id, url, section, message)
    {
        if (confirm(message))
        {
            var dataArray = {"section": section, "id": id};
            console.log(dataArray);
            $http.post(url, $.param(dataArray),
                    {
                        headers:
                                {
                                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                                },
                        cache: false
                    }).
                    success(function(data, status, headers, config) {
                // this callback will be called asynchronously
                // when the response is available
                console.log(data);
                $scope.alertSuccess = data.texto;
                window.setTimeout(function() {
                    window.location.reload();
                }, 1000); //RECARGAR DESPUES DE 2 SEGUNDOS
            }).
                    error(function(data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                console.log(data);
                $scope.alertError = data.texto;
            });
        }
    }


    $scope.agregar = 'Agregar persona';
    $scope.templateAgregar = '';
    $scope.agregarPersona = function() {
        if ($scope.agregar == "Agregar persona")
        {
            $scope.agregar = 'Cancelar';
            $scope.templateAgregar = 'agregarPersona.html';
        }
        else if ($scope.agregar == 'Cancelar')
        {
            $scope.agregar = 'Agregar persona';
            $scope.templateAgregar = '';
        }
    };





}



// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.

