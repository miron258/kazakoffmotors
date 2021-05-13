ngApp.controller('productCtrl', ['$scope', '$rootScope', '$compile', '$timeout', '$http', 'productSrv', '$httpParamSerializer',
    function ($scope, $rootScope, $compile, $timeout, $http, productSrv, $httpParamSerializer) {

        $scope.deleteButton = false;
        $scope.checkboxRecordsAll = false;
        $scope.checkboxRecord = 0; //По умолчанию чекоксы не отмечены
        $scope.options = [];

        $scope.products = [];
        $scope.totalPages = 0;
        $scope.loader = false;
        $scope.currentPage = 1;
        $scope.idPosition = "";
        $scope.price = "";
        $scope.priceUsd = "";
        $scope.wrapping = "";
        $scope.countStock = "";

        $scope.range = [];

///По умолчанию создаем фильтра с пустыми значениями
        $scope.filter = {
            "art": "",
            "idCatalog": "",
            "name": "",
            "price": ""
        };
        $scope.predicate = 'id';
        $scope.sort = function (predicate) {
            $scope.predicate = predicate;
        };

        $scope.isSorted = function (predicate) {
            return ($scope.predicate == predicate)
        };


        $scope.submitForm = function () {
            $scope.getProducts();
        };


        $scope.updatePosition = function () {
            var data = {
                'id_product': this.product.id,
                'position': this.idPosition
            };
            $scope.loader = true;
            productSrv.updatePosition(data)
                .then(
                    //Функция в случае успеха получения данных
                    function (res) {

                        console.log(res);
                        var success = res['success'];

                        $scope.loader = false;

                        if (success) {
                            var response = res.response.data.products;
                            $scope.message = res.response.data.message;
                            // $scope.products = response;

                        } else {
                            $scope.message = res.response.data.message;
                        }

                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        console.error(data);
                        console.error('Error update position product.');
                        $scope.loader = false;
                    });


        };




        $scope.updatePrice = function () {
            var data = {
                'id_product': this.product.id,
                'price': this.price
            };

            console.log("data");
            console.log(data);
            $scope.loader = true;
            productSrv.updatePrice(data)
                .then(
                    //Функция в случае успеха получения данных
                    function (res) {
                        $scope.loader = false;
                        console.log(res);
                        var success = res['success'];
                        if (success) {
                            var response = res.response.data.products;
                            $scope.message = res.response.data.message;
                            // $scope.products = response;

                        } else {
                            $scope.message = res.response.data.message;
                        }

                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        $scope.loader = false;
                        console.error(data);
                        console.error('Error update price product.');
                    });


        };


        $scope.updatePriceUsd = function () {
            var data = {
                'id_product': this.product.id,
                'price_usd': this.priceUsd
            };
            console.log("data");
            console.log(data);
            $scope.loader = true;
            productSrv.updatePriceUsd(data)
                .then(
                    //Функция в случае успеха получения данных
                    function (res) {
                        $scope.loader = false;
                        console.log(res);
                        var success = res['success'];
                        if (success) {
                            var response = res.response.data.products;
                            var product = res.response.data.product;
                            var price  = res.response.data.price;

                            let elementInputPrice = document.getElementById('price-'+product.id);

                            console.log("elementInputPrice");
                            console.log(elementInputPrice);

                            elementInputPrice.value = price;

                            $scope.message = res.response.data.message;
                            // $scope.products = response;

                        } else {
                            $scope.message = res.response.data.message;
                        }

                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        $scope.loader = false;
                        console.error(data);
                        console.error('Error update price usd product.');
                    });


        };



        $scope.updateWrapping = function () {
            var data = {
                'id_product': this.product.id,
                'wrapping': this.wrapping
            };
            console.log("data");
            console.log(data);
            $scope.loader = true;
            productSrv.updateWrapping(data)
                .then(
                    //Функция в случае успеха получения данных
                    function (res) {
                        $scope.loader = false;
                        console.log(res);
                        var success = res['success'];
                        if (success) {
                            var response = res.response.data.products;
                            var product = res.response.data.product;
                            var price  = res.response.data.price;

                            let elementInputPrice = document.getElementById('price-'+product.id);



                            elementInputPrice.value = price;



                            $scope.message = res.response.data.message;
                            // $scope.products = response;

                        } else {
                            $scope.message = res.response.data.message;
                        }

                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        console.error(data);
                        $scope.loader = false;
                        console.error('Error update wrapping product.');
                    });


        };


        $scope.updateCountStock = function () {
            var data = {
                'id_product': this.product.id,
                'count_stock': this.countStock
            };
            console.log("data");
            console.log(data);
            $scope.loader = true;
            productSrv.updateCountStock(data)
                .then(
                    //Функция в случае успеха получения данных
                    function (res) {

                        console.log(res);
                        var success = res['success'];
                        $scope.loader = false;
                        if (success) {
                            var response = res.response.data.products;
                            $scope.message = res.response.data.message;
                            // $scope.products = response;

                        } else {
                            $scope.message = res.response.data.message;
                        }

                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        console.error(data);
                        $scope.loader = false;
                        console.error('Error update count stock product.');
                    });


        };

        $scope.deleteProducts = function () {
            var isDelete = confirm("Вы действительно хотите удалить товар(ы)?");
            $scope.idRecords = $scope.getCheckedRecords();

            console.log($scope.idRecords);

            if (isDelete) {
                $scope.loader = true;
                productSrv.deleteProducts($scope.idRecords)
                    .then(
                        //Функция в случае успеха получения данных
                        function (res) {

                            console.log(res);
                            var success = res['success'];
                            $scope.loader = false;
                            if (success) {
                                var response = res.response.data.products;
                                $scope.message = res.response.data.message;
                                $scope.checkboxRecordsAll = false;


                                $scope.products = response.data;
                                $scope.totalPages = response.last_page;
                                $scope.currentPage = response.current_page;

                                // Pagination Range
                                var pages = [];
                                for (var i = 1; i <= response.last_page; i++) {
                                    pages.push(i);
                                }
                                $scope.range = pages;
                            } else {
                                $scope.message = res.response.data.message;
                            }

                        },
                        //Фукнция в случае ошибки
                        function (data) {
                            $scope.loader = false;
                            console.error(data);
                            console.error('Error get products.');
                        });

            }

        };


        $scope.getProducts = function (pageNumber) {
            if (pageNumber === undefined) {
                pageNumber = '1';
            }
            $scope.loader = true;
            productSrv.getProducts(pageNumber, $scope.filter)
                .then(
                    //Функция в случае успеха получения данных
                    function (response) {
                        $scope.loader = false;
                        console.log(response);
                        var success = response['success'];
                        if (success) {
                            $scope.products = response.response.data.data;


                            $scope.totalPages = response.response.data.last_page;
                            $scope.currentPage = response.response.data.current_page;

                            // Pagination Range
                            var pages = [];
                            for (var i = 1; i <= response.response.data.last_page; i++) {
                                pages.push(i);
                            }
                            $scope.range = pages;
                        }


                    },
                    //Фукнция в случае ошибки
                    function (data) {
                        console.error(data);
                        $scope.loader = false;
                        console.error('Error get products.');
                    });
        };


//Количество отмеченных файлов
        $scope.countCheckedRecords = function () {
            var recordsArray = angular.element.find('.checkbox-record');
            var count = 0;
            angular.forEach(recordsArray, function (elementInput, index) {
                var statusChecked = elementInput.checked;
                if (statusChecked) {
                    count++;
                }
            });
            return count;
        };
//Конец Количество отмеченных файлов
        $scope.$watch('countCheckedRecords()', function (newValue, oldValue) {
            if (newValue > 0) {
                $scope.deleteButton = false;

            } else {
                $scope.deleteButton = true;
            }
        });
        $scope.getCheckedRecords = function () {
            //Собираем названия всех отмеченных файлов гостем
            var recordsArray = angular.element.find('.checkbox-record');
            var idRecordsArray = [];
            angular.forEach(recordsArray, function (elementInput, index) {
                var statusChecked = elementInput.checked;
                if (statusChecked) {
                    idRecordsArray.push(angular.element(elementInput).val());
                }
            });
            return idRecordsArray;
        };
        $scope.selectAllRecords = function (status) {
            $scope.deleteButton = false;
            var checked = $scope.checkboxRecordsAll;
            for (var i = 0; i < $scope.products.length; i++) {
                $scope.options[i] = checked;
            }

        };


    }]);


