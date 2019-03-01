@component('components.order_form', [
'title' => 'Заявка на оформление полиса для частных лиц',
'form' => $form,
'product' =>$product,
'page' => $page,
])
    <div class="b-order-form__col individual">
        <label class="b-order-form__field u-mask-field">
            <span class="b-order-form__field-label">ВАШЕ ИМЯ</span>
            <span class="b-order-form__field-inputs">
                <input
                    class="b-order-form__field-input u-mask"
                    type="text"
                    name="ib_34[NAME][0][VALUE]"
                    value="" data-mask="onlyRus"
                    data-required="data-required">
                <div class="b-order-form__field-none">
                    Пожалуйста, укажите ваше имя
                </div>
                <div class="b-calc-form__field-error-keyboard">
                    Переключите раскладку клавиатуры
                </div>
            </span>
        </label>
    </div>
    <div class="b-order-form__col individual">
        <label class="b-order-form__field u-mask-field">
            <span class="b-order-form__field-label">Телефон</span>
            <span class="b-order-form__field-inputs">
                <input
                    class="b-order-form__field-input u-mask"
                    type="text"
                    name="ib_34[7][0][VALUE]" value=""
                    data-mask="phoneMask"
                    data-placeholder="X"
                    data-required="data-required">
                <div class="b-order-form__field-none">
                    Пожалуйста, укажите ваш телефон
                </div>
            </span>
        </label>
    </div>
    <div class="b-order-form__col individual">
        <label class="b-order-form__field u-mask-field">
            <span class="b-order-form__field-label">E-mail</span>
            <span class="b-order-form__field-inputs">
                <input
                    class="b-order-form__field-input u-mask"
                    type="email"
                    name="ib_34[8][0][VALUE]" value=""
                    data-mask="emailMask"
                    data-required="data-required">
                <div class="b-order-form__field-none">
                    Пожалуйста, укажите ваш e-mail
                </div>
            </span>
        </label>
    </div>
    <div class="b-order-form__col individual">
        <label class="b-order-form__field u-mask-field">
            <span class="b-order-form__field-label">Город</span>
            <span class="b-order-form__field-inputs">
                <div class="b-autocomplete-address-request-fom iblock">
                    <div class="b-autocomplete-address__input-wrap">
                        <input
                            class="b-autocomplete-address__input b-order-form__field-input ui-autocomplete-input"
                            type="text"
                            placeholder="Введите ваш город"
                            name="ib_34[10][0][VALUE]"
                            data-required="data-required"
                            autocomplete="off">
                        <div class="b-order-form__field-none">
                            Пожалуйста, укажите ваш регион
                        </div>
                        <div class="b-calc-form__field-error-keyboard">
                            Переключите раскладку клавиатуры
                        </div>
                    </div>
                    <ul
                        id="ui-id-1" tabindex="0"
                        class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front"
                        style="display: none;"></ul>
                </div>
            </span>
        </label>
    </div>
    <input
        class="b-autocomplete-address__kladr_code"
        type="hidden" name="ib_34[387][0][VALUE]">
    <div class="b-order-form__col _full">
        <label class="b-order-form__field u-mask-field">
            <span class="b-order-form__field-label">ПРИМЕЧАНИЕ</span>
            <span class="b-order-form__field-inputs">
                <textarea
                    class="b-order-form__field-input"
                    name="ib_34[PREVIEW_TEXT][0][VALUE]"></textarea>
                <div class="b-order-form__field-none">
                    Пожалуйста, укажите примечание
                </div>
            </span>
        </label>
    </div>
    <div style="display: none;">
        <select name="ib_34[6][][VALUE]">
            <option value="">-</option>
            <option value="162">КАСКО РАССРОЧКА</option>
            <option value="167">Комплексное ипотечное страхование</option>
            <option value="289">ОСАГО</option>
            <option value="168">Страхование квартиры</option>
            <option value="307">Страхование от несчастных случаев</option>
            <option value="39520" selected="selected">Страхование спортсменов "Мультиспортсмен"
            </option>
            <option value="290">КАСКО</option>
            <option value="164">100 за 50</option>
            <option value="161">Зеленая карта</option>
            <option value="172">Страхование дома</option>
            <option value="332">Страхование от клещевого энцефалита</option>
            <option value="169">Страхование гражданской ответственности</option>
            <option value="14020">КАСКОснова</option>
            <option value="15002">Медицинская страховка для шенгенской визы</option>
            <option value="44220">Правила страхования транспортных средств</option>
            <option value="55325">Страхование КАСКО для Audi</option>
            <option value="311">Страхование маломерных судов</option>
            <option value="59621">Страхование от онкологии и критических заболеваний</option>
            <option value="53549">Страхование школьников</option>
            <option value="171">Региональные программы страхования</option>
        </select>
    </div>
    <input class="trap-text" type="text" name="email" value="">
@endcomponent
