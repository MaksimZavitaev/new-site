@extends('layouts.pages')

@section('content')
    <main class="c-legal _service-detail _partners">
        <section class="c-legal__service-intro">
            <div class="b-promo-intro">
                <div class="b-promo-intro__bg-holder">
                    <div class="b-insurance-programs__bg"
                         style="background-image: url('{{ $variables['image']['url'] }}')"></div>
                    <div class="b-insurance-programs__bg _2x"
                         style="background-image: url('/upload/iblock/4bf/4bf8fcd0b9236625eba17055d8a1b871.jpg')"></div>
                </div>
                <div class="b-promo-intro__content-holder content-center">
                    <h1 class="b-promo-intro__caption">{{$variables['promoCaption']['value']}}</h1>
                    <div
                        class="b-promo-intro__description content-area">{{$variables['promoDescription']['value']}}</div>
                    <div class="b-promo-intro__offer">

                        <a class="button js-slowscroll" href="#order-form">Заполнить заявку</a>

                    </div>
                </div>
            </div>
        </section>

        <section class="c-legal__service-detail _padding-bottom">
            <div class="c-legal__cols content-center">
                <div class="">
                    <div class="c-legal__service-detail content-area">
                        {!! $variables['serviceDetail']['value'] !!}
                    </div>
                </div>
            </div>
        </section>

        @include('includes.additional_services')

        <section class="c-legal__order-form" id="order-form">
            <div class="c-legal__order-form content-center">
                <div class="b-order-form _reset-form">
                    @include('forms.policy_request_form', [
                        'product' => ['id' => 1],
                        'form' => ['id' => 1]
                    ])
                </div>
            </div>
        </section>
    </main>
@endsection
