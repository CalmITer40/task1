<div data-name="create-product" class="popup">
    <div class="popup-header">
        <p class="title">Добавить продукт</p>
        <button class="close" data-target="create-product"></button>
    </div>
    <div class="popup-form">
        <form id="create-product-form">
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

            <label>
                <span>Статус</span>
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
                <span class="error" data-field="status"></span>
                <input type="hidden" name="status" value="available">
            </label>

            <div class="attributes">
                <p>Атрибуты</p>
                <div class="attributes-list"></div>
                <button class="add">+ Добавить атрибут</button>
            </div>
            <button class="btn btn-blue save" data-method="create-product">Добавить</button>
        </form>
    </div>
</div>
