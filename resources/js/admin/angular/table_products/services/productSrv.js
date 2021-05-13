ngApp.service('productSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {


        this.getProducts = function (pageNumber, filter) {


//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: "list_products?page=" + pageNumber,
                params: filter,
//                data: $.param(formData),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
            function fulfilled(response) {
                def.resolve({success: true, response: response});
            }
            //В слачае ошибки ответа от сервера регистрируем функцию
            function rejected(error) {
                def.resolve({success: false, response: error});
                console.error(error.status);
            }
            return def.promise;
        };






        this.deleteProducts = function (ids) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: "product/" + ids,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
            function fulfilled(response) {
                def.resolve({success: true, response: response});
            }
            //В случае ошибки ответа от сервера регистрируем функцию
            function rejected(error) {
                def.resolve({success: false, response: error});
                console.error(error.status);
            }
            return def.promise;
        };



    this.updatePosition = function (data) {
//Формируем пост данные для запроса на сервер
        var def = $q.defer();
        var request = {
            method: 'POST',
            responseType: 'json',
            cache: true,
            data: data,
            url: "/api/v1/product/update-position",
        };
        promise = $http(request);
        promise.then(fulfilled, rejected);

        //В случае успеха ответа сервера регистрируем функцию
        function fulfilled(response) {
            def.resolve({success: true, response: response});
        }
        //В случае ошибки ответа от сервера регистрируем функцию
        function rejected(error) {
            def.resolve({success: false, response: error});
            console.error(error.status);
        }
        return def.promise;
    };


    this.updateCountStock = function (data) {
//Формируем пост данные для запроса на сервер
        var def = $q.defer();
        var request = {
            method: 'POST',
            responseType: 'json',
            cache: true,
            data: data,
            url: "/api/v1/product/update-count-stock",
        };
        promise = $http(request);
        promise.then(fulfilled, rejected);

        //В случае успеха ответа сервера регистрируем функцию
        function fulfilled(response) {
            def.resolve({success: true, response: response});
        }
        //В случае ошибки ответа от сервера регистрируем функцию
        function rejected(error) {
            def.resolve({success: false, response: error});
            console.error(error.status);
        }
        return def.promise;
    };


    this.updatePrice = function (data) {
//Формируем пост данные для запроса на сервер
        var def = $q.defer();
        var request = {
            method: 'POST',
            responseType: 'json',
            cache: true,
            data: data,
            url: "/api/v1/product/update-price",
        };
        promise = $http(request);
        promise.then(fulfilled, rejected);

        //В случае успеха ответа сервера регистрируем функцию
        function fulfilled(response) {
            def.resolve({success: true, response: response});
        }
        //В случае ошибки ответа от сервера регистрируем функцию
        function rejected(error) {
            def.resolve({success: false, response: error});
            console.error(error.status);
        }
        return def.promise;
    };

    this.updatePriceUsd = function (data) {
//Формируем пост данные для запроса на сервер
        var def = $q.defer();
        var request = {
            method: 'POST',
            responseType: 'json',
            cache: true,
            data: data,
            url: "/api/v1/product/update-price-usd",
        };
        promise = $http(request);
        promise.then(fulfilled, rejected);

        //В случае успеха ответа сервера регистрируем функцию
        function fulfilled(response) {
            def.resolve({success: true, response: response});
        }
        //В случае ошибки ответа от сервера регистрируем функцию
        function rejected(error) {
            def.resolve({success: false, response: error});
            console.error(error.status);
        }
        return def.promise;
    };

    this.updateWrapping = function (data) {
//Формируем пост данные для запроса на сервер
        var def = $q.defer();
        var request = {
            method: 'POST',
            responseType: 'json',
            cache: true,
            data: data,
            url: "/api/v1/product/update-wrapping",
        };
        promise = $http(request);
        promise.then(fulfilled, rejected);

        //В случае успеха ответа сервера регистрируем функцию
        function fulfilled(response) {
            def.resolve({success: true, response: response});
        }
        //В случае ошибки ответа от сервера регистрируем функцию
        function rejected(error) {
            def.resolve({success: false, response: error});
            console.error(error.status);
        }
        return def.promise;
    };




    }]);
