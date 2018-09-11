<!-- OVERVIEW STYLE -->
@extends('admin.about.base')
@section('action-content')


    <!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-8">
            <div class="box box-widget">
                <div class="box-header with-border">
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                    @endif
                    <h3 class="box-title">{{ $detailAbout['title'] }}</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mask">
                                <img class="img-responsive pad" src="{{ asset('storage/app/about/'. $detailAbout['image']) }}" alt="Photo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>{{ $detailAbout['description'] }}</h3>
                            {!! $detailAbout['content'] !!}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-primary" href="{{ route('about.edit', ['id' => $detailAbout['id']]) }}" role="button">Edit</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">

            <!-- SERVICES BOX -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Services</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordionService">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordionService" href="#serviceOne">
                                        Service #1
                                    </a>
                                </h4>
                            </div>
                            <div id="serviceOne" class="panel-collapse collapse">
                                <div class="box-body">
                                    <div class="mask">
                                        <img class="img-responsive pad" src="#" alt="Photo">
                                    </div>

                                    <h3>Service #1</h3>
                                    <h4>Subtitle Service #1</h4>

                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordionService" href="#serviceTwo">
                                        Service #2
                                    </a>
                                </h4>
                            </div>
                            <div id="serviceTwo" class="panel-collapse collapse">
                                <div class="box-body">
                                    <i class="fa fa-3x fa-truck" aria-hidden="true"></i>

                                    <h3>Service #2</h3>
                                    <h4>Subtitle Service #2</h4>

                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordionService" href="#serviceThree">
                                        Service #3
                                    </a>
                                </h4>
                            </div>
                            <div id="serviceThree" class="panel-collapse collapse">
                                <div class="box-body">
                                    <h3>Service #3</h3>
                                    <h4>Subtitle Service #3</h4>

                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-primary" href="#" role="button">Edit</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

            <!-- TEAM BOX -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Team</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordionTeam">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        @foreach($teams as $key => $value)
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordionTeam" href="#team_{{ $value['id'] }}">
                                        {{ $value['title'] }}
                                    </a>
                                </h4>
                            </div>
                            <div id="team_{{ $value['id'] }}" class="panel-collapse collapse">
                                <div class="box-body">
                                    <div class="mask">
                                        <img class="img-responsive pad" src="{{ asset('storage/app/teams/' .$value['image']) }}" alt="Photo">
                                    </div>
                                    <h4>{{ $value['position'] }}</h4>

                                    <p>{{ $value['description'] }}</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('teams.edit', ['team' => $value['id']]) }}" role="button">Edit</a>
                            
                            </div>

                        </div>

                        @endforeach
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-primary" href="{{ route('teams.create') }}" role="button">Thêm Mới</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

            <!-- TESTINOMIAL -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <h3 class="box-title">Testinomial</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Name</td>
                                <td>Comment</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Name Name</td>
                                <td>Great!</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Name Name</td>
                                <td>Great!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-primary" href="#" role="button">Edit</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END ACCORDION & CAROUSEL-->
</section>


@endsection