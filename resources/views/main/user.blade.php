@extends('main/semantic')

@section('content')

    <div id="dv_main_cnt">


        <section class="no-box">

            <div class="heading-title heading-dotted">
                <h3>هيئة التحرير</h3>
            </div>
            <div class="row">
                <div class="col-md-12 size-15">
                </div>
            </div>
            <div class="row">

                @foreach($users as $value)
                    <div class="col-md-12">
                        <div class="well well-sm edb_min_height" style="background: white;">
                            <div class="row">

                                <div class="col-sm-6 col-md-2 text-center">
                                    <a href="javascript:loadModal('{{$value->name}}', 'https://jces.journals.ekb.eg/data/jces/avatar/portrait.png')">
                                        <img src="https://jces.journals.ekb.eg/data/jces/avatar/portrait.png" alt="{{$value->name}}"
                                             class="radius-3 img-responsive img-fullwidth edb_img">
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 class="role_name" id="edb19053">
                                        {{$role_id[$value->role_id]}} </h4>
                                    <h4><span title="{{$value->name}}"> <i class="glyphicon glyphicon-user"></i>
                         {{$value->name}}</span></h4>

                                    <cite class="block margin-bottom-10" title=""> </cite>

                                    <small><i class="glyphicon glyphicon-map-marker">
                                        </i> <cite title="جامعة غزة - فلسطين">
                                            جامعة غزة - فلسطين </cite></small>
                                    <p></p>

                                    <i class="glyphicon glyphicon-envelope"></i> {{$value->email}}<i
                                        class="fa fa-at nomargin size-12" aria-hidden="true"></i>
                                    <br>


                                    <br>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach


            </div>


            <script type="text/javascript">
                $('.collapse').on('shown.bs.collapse', function () {
                    $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
                }).on('hidden.bs.collapse', function () {
                    $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
                });
            </script>
        </section>


    </div>


@endsection
