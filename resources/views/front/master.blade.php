<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>{{isset($dataArray["postDetail"]->meta_title)?$dataArray["postDetail"]->meta_title : (isset($dataArray["data_static"])?$dataArray["data_static"]["meta_title"]:'')}}</title>
        <!--------------Meta Tag------------------->
        <meta name="description" content='{{ isset($dataArray["postDetail"]->meta_description)?$dataArray["postDetail"]->meta_description:(isset($dataArray["data_static"])?$dataArray["data_static"]["meta_description"]:'')}}'>
        <meta name="keywords" content='{{ isset($dataArray["postDetail"]->meta_keywords)?$dataArray["postDetail"]->meta_keywords:(isset($dataArray["data_static"])?$dataArray["data_static"]["meta_keywords"]:'')}}'>
        <!--------------Meta Tag------------------->
        @include('front.css')
        @include('front.js')
    </head>

    <body>
        <header class="ds-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 ds-logo-outer">
                        <figure><a href="{{url('home')}}"><img src="{{url('uploads/systemImg/'.$systemData["systemConfig"]["main_logo"]["image"])}}" alt="<?php echo $systemData["systemConfig"]["main_logo"]["value"]; ?>" /></a> </figure>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 ds-nav-outer">
                        <nav class="navbar megamenu">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed"><i class="fa fa-bars" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav" id="header_menu">
                                    @if(count($systemData["headerMenu"])>0)
                                    @foreach($systemData["headerMenu"] as $key => $val)
                                    <?php $link = isset($val['postDetail']->custom_slug) && !empty($val['postDetail']->custom_slug) ? $val['postDetail']->custom_slug : $val['postDetail']->post_slug; ?>
                                    <?php
                                    if ($val['postDetail']->post_slug == 'services') {
                                        ?>
                                        <li class="dropdown megamenu-fw">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$val['name']}}</a>
                                            <ul class="dropdown-menu megamenu-content" role="menu">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-4">
                                                            @if(count($systemData["footerMenu"]["first_section"])>0)
                                                            <?php $total_records = count($systemData["footerMenu"]["first_section"]); ?>
                                                            @foreach($systemData["footerMenu"]["first_section"] as $key => $val)
                                                            @if($key==0)
                                                            <h3 class="title"><a href="{{url($val['parentPostDetail']->post_slug)}}">{{$val['parentPostDetail']->title}}</a></h3>
                                                            <ul class="media-list">
                                                                @endif

                                                                <li class="media"><a class="pull-right" href="#"></a>
                                                                    <div class="media-body">
                                                                        <p><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></p>
                                                                    </div>
                                                                </li>
                                                                <?php if ($key + 1 == $total_records) { ?>
                                                                </ul>
                                                            <?php } ?>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            @if(count($systemData["footerMenu"]["second_section"])>0)
                                                            <?php $total_records = count($systemData["footerMenu"]["second_section"]); ?>
                                                            @foreach($systemData["footerMenu"]["second_section"] as $key => $val)
                                                            @if($key==0)
                                                            <h3 class="title"><a href="{{url($val['parentPostDetail']->post_slug)}}">{{$val['parentPostDetail']->title}}</a></h3>
                                                            <ul class="media-list">
                                                                @endif

                                                                <li class="media"><a class="pull-right" href="#"></a>
                                                                    <div class="media-body">
                                                                        <p><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></p>
                                                                    </div>
                                                                </li>
                                                                <?php if ($key + 1 == $total_records) { ?>
                                                                </ul>
                                                            <?php } ?>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            @if(count($systemData["footerMenu"]["third_section"])>0)
                                                            <?php $total_records = count($systemData["footerMenu"]["third_section"]); ?>
                                                            @foreach($systemData["footerMenu"]["third_section"] as $key => $val)
                                                            @if($key==0)
                                                            <h3 class="title"><a href="{{url($val['parentPostDetail']->post_slug)}}">{{$val['parentPostDetail']->title}}</a></h3>
                                                            <ul class="media-list">
                                                                @endif

                                                                <li class="media"><a class="pull-right" href="#"></a>
                                                                    <div class="media-body">
                                                                        <p><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></p>
                                                                    </div>
                                                                </li>
                                                                <?php if ($key + 1 == $total_records) { ?>
                                                                </ul>
                                                            <?php } ?>
                                                            @endforeach
                                                            @endif
                                                        </div>
<!--                                                        <div class="col-xs-12 col-sm-4">
                                                            @if(count($systemData["footerMenu"]["fourth_section"])>0)
                                                            <?php $total_records = count($systemData["footerMenu"]["fourth_section"]); ?>
                                                            @foreach($systemData["footerMenu"]["fourth_section"] as $key => $val)
                                                            @if($key==0)
                                                            <h3 class="title"><a href="#">{{$val['section_title']}}</a></h3>
                                                            <ul class="media-list">
                                                                @endif

                                                                <li class="media"><a class="pull-right" href="#"></a>
                                                                    <div class="media-body">
                                                                        <p><a href="<?php echo !empty($val['postDetail']->post_slug) ? $val['postDetail']->post_slug : 'javascript:void(0);' ?>">{{$val['name']}}</a></p>
                                                                    </div>
                                                                </li>
                                                                <?php if ($key + 1 == $total_records) { ?>
                                                                </ul>
                                                            <?php } ?>
                                                            @endforeach
                                                            @endif
                                                        </div>-->
                                                    </div><!-- end row -->
                                                </li>
                                            </ul>
                                        </li>

                                        <?php
                                    } else {
                                        ?>
                                        <li><a href="{{url($link)}}">{{$val['name']}}</a></li>
                                        <?php
                                    }
                                    ?>





                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </nav> 

                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 ds-ycomp-outer">
                        <h3><?php echo $systemData["systemConfig"]["right_logo_value"]["value"]; ?><small><?php echo $systemData["systemConfig"]["right_logo_slot"]["value"]; ?></small></h3>
                    </div>
                </div>
            </div>
        </header>
        <!----------Main Page Content -------------->
        @yield('content')
        <!----------Main Page Content -------------->

        <!----------Footer -------------->
        @include('front.footer')
        <!----------Footer -------------->

        <script>
            jQuery(document).ready(function () {
                $(".dropdown").hover(
                        function () {
                            $('.dropdown-menu', this).fadeIn("fast");
                        },
                        function () {
                            $('.dropdown-menu', this).fadeOut("fast");
                        });
            });
        </script>

    </body>
</html>


