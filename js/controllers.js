var SortableCTRL = function($scope) {
     var sortableEle;
    
    $scope.sortableArray = [
        'One', 'Two', 'Three'
    ];
    /*
    $scope.add = function() {
        $scope.sortableArray.push('Item: '+$scope.sortableArray.length);
        
        sortableEle.refresh();
    }
    */
    $scope.dragStart = function(e, ui) {
        ui.item.data('start', ui.item.index());
    }
    $scope.dragEnd = function(e, ui) {
        var start = ui.item.data('start'),
            end = ui.item.index();
        
        $scope.dataArray.splice(end, 0, 
            $scope.dataArray.splice(start, 1)[0]);
        
        $scope.$apply();
    }
        
    sortableEle = $('#sortable').sortable({
        start: $scope.dragStart,
        update: $scope.dragEnd
    });
}


var imgController = function($scope, $fileUploader, $modalInstance, $http, $sce) {

    

    $scope.form = {};
    $scope.form.imageVideo = false;
    $scope.formImagen = {};
    $scope.subirImagen = false;
    $scope.filterExp = false;

    function youtubeFeedCallback(data) {
        console.log("aaasdasd");
    }
    $scope.destacar = function() {
        if ($scope.form.destacado != '')
        {
            $scope.form.destacado = "";
        }
        else
        {
            $scope.form.destacado = 't';
        }

        console.log($scope.form.destacado);
    };

    $scope.fetchVideo = function()
    {
        var reg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
        //get matches found for the regular expression
        var matches = reg.exec($scope.form.video);
        //check if we have found a match for a YouTube video
        //will support legacy code, shortened urls and
        if (matches) {
            //found a video so get the video id
            var videoId = matches[1];
            $scope.form.imageVideo = "http://img.youtube.com/vi/" + videoId + "/0.jpg";
            $http({method: 'GET', url: "http://gdata.youtube.com/feeds/api/videos/" + videoId + "?v=2&amp;alt=json-in-script&amp;callback=youtubeFeedCallback"}).
                    success(function(data, status, headers, config) {
                $scope.form.videoTitle = $(data).find("title").text();
            }).
                    error(function(data, status, headers, config) {
                console.log("ouch");
            });



        }
        else {
            $scope.form.imageVideo = false;//no match was returned so we run error feedback to the user
        }


        //alert($scope.form.video);
    }
    $scope.init = function(urlImage)
    {
        uploader.queue.push({
            default: {url: urlImage}, // your data here
            isUploaded: true
        });
    }
    $scope.submitOrdenSecretariado = function(url, dataArray){

        var arrayPost = {};
        arrayPost.orden = dataArray;
        arrayPost.section = "ordenarSecretariado";
        console.log(arrayPost);
        $http.post(url, $.param(arrayPost),
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
            
            if (data.estado == 1)
            {
                if (typeof (data.href) !== 'undefined')
                {
                    $modalInstance.dismiss('ok');
                    window.setTimeout(function() {
                        window.location.replace(data.href);
                    }); //RECARGAR DESPUES DE 2 SEGUNDOS
                }
                else
                {
                    $modalInstance.dismiss('ok');
                    window.setTimeout(function() {
                        window.location.reload();
                    }); //RECARGAR DESPUES DE 2 SEGUNDOS

                }
            }
            else
            {
                alert(data.texto);
            }

        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            alert("Ha habido un error. Inténtelo nuevamente.");
        });
    };

    $scope.submitForm = function(url, dataArray)
    {
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

            if (data.estado == 1)
            {
                if (typeof (data.href) !== 'undefined')
                {
                    $modalInstance.dismiss('ok');
                    window.setTimeout(function() {
                        window.location.replace(data.href);
                    }); //RECARGAR DESPUES DE 2 SEGUNDOS
                }
                else
                {
                    $modalInstance.dismiss('ok');
                    window.setTimeout(function() {
                        window.location.reload();
                    }); //RECARGAR DESPUES DE 2 SEGUNDOS

                }
            }
            else
            {
                alert(data.texto);
            }

        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            alert("Ha habido un error. Inténtelo nuevamente.");
        });
    }


    $scope.fetchTags = function() {

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
            $scope.form.tags = [];
            console.log(data);
            data.forEach(function(index) {
                $scope.form.tags.push(index.nombreEtiqueta);
            });



            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });


    };

    $scope.guardarEtiquetas = function() {
        $http.post(controladorModel, $.param({"section": etiquetas}),
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

            $scope.form.tags = data;
            console.log($scope.form.tags);
            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });
    };


    $scope.loadTags = function(query) {
        return $http.get('../../admin/etiquetas/buscarEtiqueta.php?tag=' + query);
    };

    $scope.eliminarDinamico = function(url, dataArray)
    {
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
            if (data.estado == false)
            {
                $scope.stopPropagation = true;
                $scope.alertError = data.texto;
            }
            else
            {
                $scope.subirImagen = true;
            }
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            $modalInstance.dismiss('ok');
        });
    }






    $scope.deleteFile = function() {
        console.log("eliminar");
        $scope.uploader.removeFromQueue(0); //eliminar un archivo que ya se ha subido automaticamente
        $scope.imageLoaded = false; //flag para mostrar el boton eliminar
    }

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    // Creates a uploader
    var uploader = $scope.uploader = $fileUploader.create({
        scope: $scope,
        url: urlUploadImage,
        modal: $modalInstance, //le paso por parametro al uploader el modal que tiene que cerrar cuando termine

    });

    // ADDING FILTERS

    // Images only
    uploader.filters.push(function(item /*{File|HTMLInputElement}*/) {
        var type = uploader.isHTML5 ? item.type : '/' + item.value.slice(item.value.lastIndexOf('.') + 1);
        type = '|' + type.toLowerCase().slice(type.lastIndexOf('/') + 1) + '|';
        return '|jpg|png|jpeg|bmp|gif'.indexOf(type) !== -1;
    });

    // only one file in the queue
    uploader.filters.push(function() {
        return uploader.queue.length !== 1;
    });

    //archivo por defecto
    $scope.edit = function(urlImage)
    {
        uploader.queue.push({
            default: {url: urlImage}, // your data here
            isUploaded: true
        });
    }

    // REGISTER HANDLERS

    uploader.bind('afteraddingfile', function(event, item) {
        console.info('After adding a file', item);
        this.uploadAll();
        $scope.imageLoaded = true;
    });

    uploader.bind('afteraddingall', function(event, items) {
        console.info('After adding all files', items);
    });

    uploader.bind('beforeupload', function(event, item) {
        console.info('Before upload', item);
    });

    uploader.bind('progress', function(event, item, progress) {
        console.info('Progress: ' + progress, item);
    });

    uploader.bind('success', function(event, xhr, item, response) {
        console.info('Success', xhr, item, response);
        $scope.form.archivo = response.imagen;

        $scope.alertSuccess = response.texto;

    });

    uploader.bind('cancel', function(event, xhr, item) {
        console.info('Cancel', xhr, item);
    });

    uploader.bind('error', function(event, xhr, item, response) {
        console.info('Error', xhr, item, response);
        $scope.alertError = response.texto;
    });

    uploader.bind('complete', function(event, xhr, item, response) {
        console.info('Complete', xhr, item, response);
    });

    uploader.bind('progressall', function(event, progress) {
        console.info('Total progress: ' + progress);

    });

    uploader.bind('completeall', function(event, items, xhr) {
        console.info('Complete all', items);
        var modal = this.modal;

        //window.setTimeout(function(){modal.dismiss('cancel')},2000); CERRAR MODAL DESPUES DE 2 SEGUNDOS
    });
};


var pdfController = function($scope, $fileUploader, $modalInstance, $http) {
    $scope.form = {};
    $scope.formImagen = {};
    $scope.subirImagen = false;


    $scope.destacar = function() {
        alert("hey");
    };

    $scope.init = function(urlImage)
    {
        uploader.queue.push({
            default: {url: urlImage}, // your data here
            isUploaded: true
        });
    }

    $scope.submitForm = function(url, dataArray)
    {
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
            //console.log(data);

            if (data.estado == 1)
            {
                $modalInstance.dismiss('ok');
                window.setTimeout(function() {
                    window.location.reload();
                }); //RECARGAR DESPUES DE 2 SEGUNDOS
            }
            else
            {
                alert(data.texto);
            }

        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            alert("Ha habido un error. Inténtelo nuevamente.");
        });
    }


    $scope.fetchTags = function() {

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
            $scope.form.tags = [];
            console.log(data);
            data.forEach(function(index) {
                $scope.form.tags.push(index.nombreEtiqueta);
            });



            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });


    };

    $scope.guardarEtiquetas = function() {
        $http.post(controladorModel, $.param({"section": etiquetas}),
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

            $scope.form.tags = data;
            console.log($scope.form.tags);
            $scope.load = false;
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.log("ha habido un error.");
            $scope.load = false;
        });
    };


    $scope.loadTags = function(query) {
        return $http.get('../../admin/etiquetas/buscarEtiqueta.php?tag=' + query);
    };


    $scope.eliminarDinamico = function(url, dataArray)
    {
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
            if (data.estado == false)
            {
                $scope.stopPropagation = true;
                $scope.alertError = data.texto;
            }
            else
            {
                $scope.subirImagen = true;
            }
        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            $modalInstance.dismiss('ok');
        });
    }




    $scope.deleteFile = function() {
        console.log("eliminar");
        $scope.uploader.removeFromQueue(0); //eliminar un archivo que ya se ha subido automaticamente
        $scope.imageLoaded = false; //flag para mostrar el boton eliminar
    }

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    // Creates a uploader
    var uploader = $scope.uploader = $fileUploader.create({
        scope: $scope,
        url: urlUploadImage,
        modal: $modalInstance, //le paso por parametro al uploader el modal que tiene que cerrar cuando termine

    });
    // ADDING FILTERS

    // only one file in the queue
    uploader.filters.push(function() {
        return uploader.queue.length !== 1;
    });

    uploader.filters.push(function(item /*{File|HTMLInputElement}*/) {
        var type = uploader.isHTML5 ? item.type : '/' + item.value.slice(item.value.lastIndexOf('.') + 1);
        type = '|' + type.toLowerCase().slice(type.lastIndexOf('/') + 1) + '|';
        return '|pdf|doc'.indexOf(type) !== -1;
    });
    // REGISTER HANDLERS

    uploader.bind('afteraddingfile', function(event, item) {
        console.info('After adding a file', item);
        this.uploadAll();
        $scope.imageLoaded = true;
    });

    uploader.bind('afteraddingall', function(event, items) {
        console.info('After adding all files', items);
    });

    uploader.bind('beforeupload', function(event, item) {
        console.info('Before upload', item);
    });

    uploader.bind('progress', function(event, item, progress) {
        console.info('Progress: ' + progress, item);
    });

    uploader.bind('success', function(event, xhr, item, response) {
        console.info('Success', xhr, item, response);
        $scope.form.archivo = response.imagen;

        $scope.alertSuccess = response.texto;


    });

    uploader.bind('cancel', function(event, xhr, item) {
        console.info('Cancel', xhr, item);
    });

    uploader.bind('error', function(event, xhr, item, response) {
        console.info('Error', xhr, item, response);
        $scope.alertError = response.texto;
    });

    uploader.bind('complete', function(event, xhr, item, response) {
        console.info('Complete', xhr, item, response);
    });

    uploader.bind('progressall', function(event, progress) {
        console.info('Total progress: ' + progress);

    });

    uploader.bind('completeall', function(event, items, xhr) {
        console.info('Complete all', items);
        var modal = this.modal;

        //window.setTimeout(function(){modal.dismiss('cancel')},2000); CERRAR MODAL DESPUES DE 2 SEGUNDOS
    });
};

var imagesController = function($scope, $fileUploader, $modalInstance, $http) {
    $scope.form = {};
    $scope.form.archivo = [];

    $scope.borrarArreglo = function()
    {
        $scope.form.archivo = [];
    }

    $scope.deleteFile = function() {
        console.log("eliminar");
        $scope.uploader.removeFromQueue(0); //eliminar un archivo que ya se ha subido automaticamente
        $scope.imageLoaded = false; //flag para mostrar el boton eliminar
    }

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    // Creates a uploader
    var uploader = $scope.uploader = $fileUploader.create({
        scope: $scope,
        url: urlUploadImage,
        modal: $modalInstance, //le paso por parametro al uploader el modal que tiene que cerrar cuando termine

    });

    $scope.submitForm = function(url, dataArray)
    {
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
            //console.log(data);

            if (data.estado == 1)
            {
                $modalInstance.dismiss('ok');
                window.setTimeout(function() {
                    window.location.reload();
                }); //RECARGAR DESPUES DE 2 SEGUNDOS
            }
            else
            {
                alert(data.texto);
            }

        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            alert("Ha habido un error. Inténtelo nuevamente.");
        });
    }


    // ADDING FILTERS

    // Images only
    uploader.filters.push(function(item /*{File|HTMLInputElement}*/) {
        var type = uploader.isHTML5 ? item.type : '/' + item.value.slice(item.value.lastIndexOf('.') + 1);
        type = '|' + type.toLowerCase().slice(type.lastIndexOf('/') + 1) + '|';
        return '|jpg|png|jpeg|bmp|gif'.indexOf(type) !== -1;
    });



    // REGISTER HANDLERS

    uploader.bind('afteraddingfile', function(event, item) {
        console.info('After adding a file', item);
        this.uploadAll();
        $scope.imageLoaded = true;
    });

    uploader.bind('afteraddingall', function(event, items) {
        console.info('After adding all files', items);
    });

    uploader.bind('beforeupload', function(event, item) {
        console.info('Before upload', item);
    });

    uploader.bind('progress', function(event, item, progress) {
        console.info('Progress: ' + progress, item);
    });

    uploader.bind('success', function(event, xhr, item, response) {
        console.info('Success', xhr, item, response);
        $scope.form.archivo.push(response.imagen);
        console.log($scope.form.archivo);
        $scope.alertSuccess = response.texto;

    });

    uploader.bind('cancel', function(event, xhr, item) {
        console.info('Cancel', xhr, item);
    });

    uploader.bind('error', function(event, xhr, item, response) {
        console.info('Error', xhr, item, response);
        $scope.alertError = response.texto;
    });

    uploader.bind('complete', function(event, xhr, item, response) {
        console.info('Complete', xhr, item, response);
    });

    uploader.bind('progressall', function(event, progress) {
        console.info('Total progress: ' + progress);

    });

    uploader.bind('completeall', function(event, items, xhr) {
        console.info('Complete all', items);
        var modal = this.modal;

        //window.setTimeout(function(){modal.dismiss('cancel')},2000); CERRAR MODAL DESPUES DE 2 SEGUNDOS
    });
};

var pdfsController = function($scope, $fileUploader, $modalInstance, $http) {
    $scope.form = {};
    $scope.form.archivo = [];

    $scope.borrarArreglo = function()
    {
        $scope.form.archivo = [];
    }

    $scope.deleteFile = function() {
        console.log("eliminar");
        $scope.uploader.removeFromQueue(0); //eliminar un archivo que ya se ha subido automaticamente
        $scope.imageLoaded = false; //flag para mostrar el boton eliminar
    }

    $scope.cancel = function() {
        $modalInstance.dismiss('cancel');
    };
    // Creates a uploader
    var uploader = $scope.uploader = $fileUploader.create({
        scope: $scope,
        url: urlUploadImage,
        modal: $modalInstance, //le paso por parametro al uploader el modal que tiene que cerrar cuando termine

    });

    $scope.submitForm = function(url, dataArray)
    {
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
            //console.log(data);

            if (data.estado == 1)
            {
                $modalInstance.dismiss('ok');
                window.setTimeout(function() {
                    window.location.reload();
                }); //RECARGAR DESPUES DE 2 SEGUNDOS
            }
            else
            {
                alert(data.texto);
            }

        }).
                error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            alert("Ha habido un error. Inténtelo nuevamente.");
        });
    }
    
    // ADDING FILTERS

    // only one file in the queue
    uploader.filters.push(function() {
        return uploader.queue.length !== 1;
    });

    uploader.filters.push(function(item /*{File|HTMLInputElement}*/) {
        var type = uploader.isHTML5 ? item.type : '/' + item.value.slice(item.value.lastIndexOf('.') + 1);
        type = '|' + type.toLowerCase().slice(type.lastIndexOf('/') + 1) + '|';
        return '|pdf|doc'.indexOf(type) !== -1;
    });


    // REGISTER HANDLERS

    uploader.bind('afteraddingfile', function(event, item) {
        console.info('After adding a file', item);
        this.uploadAll();
        $scope.imageLoaded = true;
    });

    uploader.bind('afteraddingall', function(event, items) {
        console.info('After adding all files', items);
    });

    uploader.bind('beforeupload', function(event, item) {
        console.info('Before upload', item);
    });

    uploader.bind('progress', function(event, item, progress) {
        console.info('Progress: ' + progress, item);
    });

    uploader.bind('success', function(event, xhr, item, response) {
        console.info('Success', xhr, item, response);
        $scope.form.archivo.push(response.imagen);
        console.log($scope.form.archivo);
        $scope.alertSuccess = response.texto;

    });

    uploader.bind('cancel', function(event, xhr, item) {
        console.info('Cancel', xhr, item);
    });

    uploader.bind('error', function(event, xhr, item, response) {
        console.info('Error', xhr, item, response);
        $scope.alertError = response.texto;
    });

    uploader.bind('complete', function(event, xhr, item, response) {
        console.info('Complete', xhr, item, response);
    });

    uploader.bind('progressall', function(event, progress) {
        console.info('Total progress: ' + progress);

    });

    uploader.bind('completeall', function(event, items, xhr) {
        console.info('Complete all', items);
        var modal = this.modal;

        //window.setTimeout(function(){modal.dismiss('cancel')},2000); CERRAR MODAL DESPUES DE 2 SEGUNDOS
    });
};