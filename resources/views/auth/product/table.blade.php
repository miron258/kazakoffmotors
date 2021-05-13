<table class="table table-bordered table-responsive table-striped table-hover w-100">


    <thead>
    <tr>
        <th>
            <input ng-change="selectAllRecords(checkboxRecordsAll)" value="@{{checkboxRecordsAll}}"
                   ng-model="checkboxRecordsAll" class="checked_all" type="checkbox">
        </th>
        <th>
            Имя
            <a href="#" ng-click="sort('name')" class="sortDir" ng-class="{ active: isSorted('name') }">&#x25B2;</a>
            <a href="#" ng-click="sort('-name')" class="sortDir" ng-class="{ active: isSorted('-name') }">&#x25BC;</a>
        </th>
        <th>Ссылка</th>

        <th>Изображение</th>
        <th>Каталог</th>
        <th>Цена
            <a href="#" ng-click="sort('price')" class="sortDir" ng-class="{ active: isSorted('price') }">&#x25B2;</a>
            <a href="#" ng-click="sort('-price')" class="sortDir" ng-class="{ active: isSorted('-price') }">&#x25BC;</a>
        </th>
        <th>Цена $</th>
        <th>Накрутка %</th>
        <th>Остаток</th>
        <th>Артикул</th>
        <th>Позиция
            <a href="#" ng-click="sort('position')" class="sortDir" ng-class="{ active: isSorted('position') }">&#x25B2;</a>
            <a href="#" ng-click="sort('-position')" class="sortDir" ng-class="{ active: isSorted('-position') }">&#x25BC;</a>
        </th>
        <th>В индексе</th>
        <th>Видимость</th>
        <th>Дата создания</th>
        <th></th>
    </tr>
    </thead>


    <tbody>
    <tr ng-class="options[$index] || checkboxRecordsAll ? 'table-active' : ''"
        ng-repeat="product in products| orderBy:predicate:reverse"
    ">
    <td>
        <input ng-checked="checkboxRecordsAll" value="@{{product.id}}" ng-model="options[$index]"
               class='checkbox-record' name="productId[]" ng-value="@{{product.id}}" type="checkbox">
    </td>
    <td ng-bind-html="product.name"></td>
    <td>
        <a target="_blank" href="/product/@{{product.url}}">Перейти на страницу продукта</a>
    </td>
    <td>
        <img ng-if="product.pathImgThumbnail != ''" class="d-block img-fluid" style="width: 50px;" alt="@{{ product.name}}"
             src="@{{ product.pathImgThumbnail}}">
    </td>
    <td ng-bind-html="product.name_catalog"></td>
    <td style="width:320px">
        <input class="form-control input-sm" id="price-@{{product.id}}" ng-model=price ng-change="updatePrice()" name="price" ng-value="@{{product.price}}" type="number">
    </td>

    <td style="width:320px">
        <input step="any" class="form-control input-sm" ng-model=priceUsd ng-change="updatePriceUsd()" name="price_usd" ng-value="@{{product.price_usd}}" type="number">
    </td>
    <td>
        <input class="form-control input-sm" ng-model=wrapping ng-change="updateWrapping()" name="wrapping" ng-value="@{{product.wrapping}}" type="number">
    </td>
    <td style="width:220px">
        <input class="form-control input-sm" ng-model=countStock ng-change="updateCountStock()" name="count_stock" ng-value="@{{product.count_stock}}" type="number">
    </td>
    <td>@{{product.art}}</td>
    <td>
     <input class="form-control input-sm" ng-model=idPosition ng-change="updatePosition()" name="position" ng-value="@{{product.position}}" type="number">
        </td>
    <td>
        <i ng-class="product.index ? 'fas fa-search' : 'fas fa-search-minus'"></i>
    </td>
    <td>
        <i ng-class="product.hidden ? 'far fa-eye' : 'far fa-eye-slash'"></i>
    </td>
    <td>@{{ product.created_at}}</td>
    <td>
        <a class="btn btn-primary btn-sm" href="/admin/product/@{{product.id}}/edit">
            <i class="far fa-edit"></i>
            Редактировать</a>
    </td>
    </tr>
    </tbody>

</table>


