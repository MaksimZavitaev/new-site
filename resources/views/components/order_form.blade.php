<div class="b-order-form _reset-form">
    <div class="b-order-form__plate">
        <form name="ib_34" action="{{route('form')}}"
              class="use_form_ajax add-form u-mask-scope" method="post">
            @if($page)
                <input type="hidden" name="page_id" id="ib_34_session" value="{{$page['id']}}">
            @endif
            <input type="hidden" name="form_id" value="{{$form['id']}}">
            <input type="hidden" name="g-recaptcha-response">
            <div class="b-order-form__caption">{{$title}}</div>
            <div class="b-order-form__fields-holder">
                <div class="b-order-form__cols">
                    {{$slot}}

                    <div class="b-calc-form__field b-order-form__col b-order-form__col_full u-mask-field _personal">
                        <label class="b-checkbox">
                            <input class="b-checkbox__input" type="checkbox" name="test" data-required="">
                            <span class="b-checkbox__icon"></span>
                            <span class="b-checkbox__content">
                                <span class="b-checkbox__text">
                                    Подтверждаю <a href="/upload/Terms_of_use.pdf" target="_blank">согласие на обработку моих персональных данных</a>
                                </span>
                            </span>
                        </label>
                        <div class="b-calc-form__field-error">Согласие обязательно</div>
                    </div>
                </div>
            </div>

            <div class="b-order-form__submit-holder">
                <button class="b-order-form__submit button-filled" type="submit">
                    ОТПРАВИТЬ
                </button>
            </div>
        </form>
    </div>

    <div class="b-form-notes _right">
        This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank"
                                                              class="b-form-notes__link">Privacy Policy</a> and <a
            href="https://policies.google.com/terms" target="_blank" class="b-form-notes__link">Terms of Service</a>
        apply
    </div>

    <div class="b-order-form__confirm-message">
        <div class="b-request-confirm">
            <div class="b-request-confirm__plate">
                <div class="b-request-confirm__caption">Спасибо!</div>
                <div class="b-request-confirm__text">Ваши данные успешно отправлены!</div>
            </div>
        </div>
    </div>
</div>
