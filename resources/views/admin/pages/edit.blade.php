@extends('admin.wrapper')

@section('content')
    <div class="nav-tabs-custom tab-warning">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#data" data-toggle="tab">Основное</a></li>
            <li><a href="#variables" data-toggle="tab">Переменные</a></li>
            {{--<li><a href="#history" data-toggle="tab">История</a></li>--}}
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="data">
                {!! Form::model($page, ['route' => ['admin.pages.update', $page], 'method' =>'PUT']) !!}
                @include('admin.pages._form')
                {!! Form::close() !!}
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="variables">
                <variable-list page-id="{{ $page->id }}"></variable-list>
                {{-- <media-modal> --}}
                    {{-- <media-manager></media-manager> --}}
                {{-- </media-modal> --}}
                {{--@foreach($page->variables as $key => $variable)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ $variable['name'] }}</h3>
                        </div>
                        <div class="box-content">
                            <textarea type="text">{{ $variable['type'] === 'text' ? $variable['value'] :'' }}</textarea>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="tab-pane" id="history">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                          {{ now()->format('d M. Y') }}
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                            <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">Read more</a>
                                <a class="btn btn-danger btn-xs">Delete</a>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-user bg-aqua"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your
                                friend request
                            </h3>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-comments bg-yellow"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                            <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-camera bg-purple"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                            <div class="timeline-body">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
@stop

@push('scripts')
@endpush
