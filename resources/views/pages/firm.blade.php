@extends('layouts.pages')

@section('content')
    <main class="c-legal _service-detail _partners">
        <section class="c-legal__order-form">
            <div class="c-legal__order-form content-center">
                <div class="b-order-form _reset-form">
                    @include('forms.policy_request_form', [
                        'product' => ['id' => 1],
                        'form' => ['id' => 1]
                    ]);
                </div>
            </div>
        </section>
    </main>
@endsection
