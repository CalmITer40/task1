<div data-name="update-product" class="popup">
    <div class="popup-header">
        <p class="title">Редактировать <span></span></p>
        <button class="close" data-target="update-product"></button>
    </div>
    <div class="popup-form">
        <form id="update-product-form">
            {{ csrf_field() }}
            <label>
                <span>Артикул</span>
                <input type="text" name="article">
                <span class="error" data-field="article"></span>
            </label>

            <label>
                <span>Название</span>
                <input type="text" name="name">
                <span class="error" data-field="name"></span>
            </label>

            <label for="status_add">Статус</label>
            <div class="selector">
                <div class="selector-main">
                    <div class="selector-value">
                        Доступен
                    </div>
                    <div class="selector-arrow"></div>
                </div>
                <div class="selector-list">
                    <div class="selector-item" data-item="available">Доступен</div>
                    <div class="selector-item" data-item="unavailable">Не доступен</div>
                </div>
            </div>
            <input id="status_add" type="hidden" name="status" value="Доступен">

            <div class="attributes">
                <p>Атрибуты</p>
                <div class="attributes-list"></div>
                <button class="add">+ Добавить атрибут</button>
            </div>
            <button class="btn btn-blue save" data-id="" data-method="update-product">Сохранить</button>
        </form>
    </div>
</div>
