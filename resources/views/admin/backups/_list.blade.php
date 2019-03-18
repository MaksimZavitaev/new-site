@php
    /** @var \App\Models\Application $application */
@endphp
<div class="col-xs-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
                    <button id="createButton" class="btn btn-xs btn-block btn-success">Создать</button>
                    <div class="list-group list-group-unbordered">
                        @foreach($files as $file)
                            @php /** @var SplFileInfo $file */ @endphp
                            <div class="list-group-item clearfix">
                                <i class="fa fa-file-archive-o"></i>
                                {{ $file->getBasename('.zip') }}
                                <small>({{ bytesToHuman($file->getSize()) }})</small>
                                <div class="btn-group btn-group-xs pull-right" data-name="{{$file->getBasename()}}">
                                    <button class="btn btn-warning restore"
                                            data-toggle="tooltip"
                                            title="Восстановить">
                                        <i class="fa fa-repeat"></i>
                                    </button>
                                    <button class="btn btn-danger destroy"
                                            data-toggle="tooltip"
                                            title="Удалить">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.restore').click(function (e) {
                var $t = $(e.currentTarget);
                var $icon = $t.children();
                var $buttons = $('.fa-repeat, .fa-remove').parent()

                $icon.toggleClass('fa-spin');
                $buttons.toggleClass('disabled');
                axios.get('/admin/backups/restore', {params: {name: $t.parent().data('name')}})
                    .then(function (res) {
                        $icon.toggleClass('fa-spin');
                        $buttons.toggleClass('disabled');
                    });
            });

            $('.destroy').click(function (e) {
                var $t = $(e.currentTarget);
                var $buttons = $('.fa-repeat, .fa-remove').parent();

                if (confirm('Delete backup?')) {
                    $buttons.toggleClass('disabled');
                    axios.get('/admin/backups/destroy', {params: {name: $t.parent().data('name')}})
                        .then(function (res) {
                            $buttons.toggleClass('disabled');
                            if (res.data.status === 'ok') {
                                $t.parents('.list-group-item').remove();
                            }
                        });
                }
            });

            $('#createButton').click(function (e) {
                var $t = $(e.currentTarget);
                $t.toggleClass('disabled');
                $t.html('<i class="fa fa-spinner fa-spin"></i>');
                axios.get('/admin/backups/create')
                    .then(function (res) {
                        window.location.reload();
                    });
            });
        });
    </script>
@endpush
