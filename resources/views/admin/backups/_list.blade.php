@php
    /** @var \App\Models\Application $application */
@endphp
<div class="col-xs-12">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
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
        });
    </script>
@endpush
