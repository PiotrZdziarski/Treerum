@extends('layouts.app0nav')

@section('content')
  <div class="container-fluid">
    <script>
    $(document).ready(function(){
      $('#mainimage').fadeIn(1500);
      $('#logoimg').fadeIn(1500);
      $('.profileimageloader').fadeIn(500);
    });
    </script>
              @include('layouts.topnav')

              <section class="content">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-10 breadcrumbf">
                            <a href="{{url('/')}}">Treerum</a> <span class="diviver">&gt;</span> <a href="#">General Discussion</a> <span class="diviver">&gt;</span> <a href="#">Topic Details</a>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">


                            <!-- POST -->
                          @foreach($DBposts as $post)
                              @php
                                $DBusers = DB::table('users')->where('id', $post->authorid)->select('name', 'profilepicture', 'status')->get();
                                foreach ($DBusers as $user) {
                                    $namepicture = $user->profilepicture;
                                    $username = $user->name;
                                    $status = $user->status;
                                }
                              @endphp
                            @section('title')Treerum - {{$post->title}} @endsection
                            <div class="post beforepagination">
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            @if($namepicture != 'noperson.jpg')
                                                <img data-toggle="tooltip" title="{{$username}}" class="profileimageloader red-tooltip" src='{{asset("storage/images/$username/$namepicture")}}' style="width: 40px; height: 40px; display: none" alt="" />
                                            @endif
                                            @if($namepicture == 'noperson.jpg')
                                                <img data-toggle="tooltip" title="{{$username}}" class="profileimageloader red-tooltip" src='{{asset("storage/images/$namepicture")}}' style="width: 40px; height: 40px;display: none" alt="" />
                                            @endif

                                            @if($status == false)
                                                  <div class="status red">&nbsp;</div>
                                            @else
                                                  <div class="status green">&nbsp;</div>
                                            @endif
                                        </div>

                                        <div class="icons">
                                            <img src="images/icon1.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                        <h2>{{$post->title}}</h2>
                                        <p>{{$post->textpost}}</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfobot">

                                    <div class="likeblock pull-left">
                                        <a  data-postid="{{$post->id}}" id="likepost{{$post->id}}" class="up likedislike"><i id="thumbuppost{{$post->id}}" class="fa @php
                                                $likecount = 0;
                                                $DBpostlikecheck = DB::table('likes')->where('authorip', $authorip)->where('postid', $post->id)->get();
                                                foreach($DBpostlikecheck as $postlikecheck){
                                                    $likecount += 1;
                                                }
                                                if($likecount ==0) {
                                                    echo 'fa-thumbs-o-up';
                                                } else echo 'fa-thumbs-up';@endphp"></i><span id="likespanpost{{$post->id}}">{{$post->likes}}</span></a>
                                        <a  data-postid="{{$post->id}}" id="dislikepost{{$post->id}}" class="down likedislike"><i id="thumbdownpost{{$post->id}}" class="fa @php
                                                $likecount = 0;
                                                $DBpostlikecheck = DB::table('dislikes')->where('authorip', $authorip)->where('postid', $post->id)->get();
                                                foreach($DBpostlikecheck as $postlikecheck){
                                                    $likecount += 1;
                                                }
                                                if($likecount ==0) {
                                                    echo 'fa-thumbs-o-down';
                                                } else echo 'fa-thumbs-down';@endphp"></i><span id="dislikespanpost{{$post->id}}">{{$post->dislikes}}</span></a>
                                    </div>

                                    <script>
                                        $(document).ready(function() {

                                            $("#likepost{{$post->id}}").on('click', function(){
                                                var replyid = $(this).data('postid');
                                                var thumbupclass = $("#thumbuppost{{$post->id}}").attr('class');
                                                var thumbdownclass =  $("#thumbdownpost{{$post->id}}").attr('class');

                                                if(thumbupclass == "fa fa-thumbs-o-up" && thumbdownclass == "fa fa-thumbs-o-down") {
                                                    $("#thumbuppost{{$post->id}}").attr('class', "fa fa-thumbs-up");
                                                    var likeval = $('#likespanpost{{$post->id}}').text()
                                                    likeval =  parseInt(likeval);
                                                    likeval += 1;
                                                    $('#likespanpost{{$post->id}}').text(likeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postlikingnodislike',
                                                        type: 'post',
                                                        data: {'replyid': replyid},
                                                    });
                                                }

                                                if(thumbupclass == "fa fa-thumbs-o-up" && thumbdownclass == "fa fa-thumbs-down") {
                                                    $("#thumbuppost{{$post->id}}").attr('class', "fa fa-thumbs-up");
                                                    $("#thumbdownpost{{$post->id}}").attr('class', "fa fa-thumbs-o-down");
                                                    var likeval = $('#likespanpost{{$post->id}}').text();
                                                    var dislikeval = $('#dislikespanpost{{$post->id}}').text();
                                                    dislikeval =  parseInt(dislikeval);
                                                    dislikeval -= 1;
                                                    likeval =  parseInt(likeval);
                                                    likeval += 1;
                                                    $('#dislikespanpost{{$post->id}}').text(dislikeval);
                                                    $('#likespanpost{{$post->id}}').text(likeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postlikinganddislike',
                                                        type: 'post',
                                                        data: {'replyid': replyid}
                                                    });
                                                }

                                                if(thumbupclass == "fa fa-thumbs-up") {
                                                    $("#thumbuppost{{$post->id}}").attr('class', "fa fa-thumbs-o-up");
                                                    var likeval = $('#likespanpost{{$post->id}}').text()
                                                    likeval =  parseInt(likeval);
                                                    likeval -= 1;
                                                    $('#likespanpost{{$post->id}}').text(likeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postnoliking',
                                                        type: 'post',
                                                        data: {'replyid': replyid}
                                                    });
                                                }

                                            });


                                            $("#dislikepost{{$post->id}}").on('click', function(){
                                                var replyid = $(this).data('postid');
                                                var thumbupclass = $("#thumbuppost{{$post->id}}").attr('class');
                                                var thumbdownclass =  $("#thumbdownpost{{$post->id}}").attr('class');

                                                if(thumbdownclass == "fa fa-thumbs-o-down" && thumbupclass == "fa fa-thumbs-o-up") {
                                                    $("#thumbdownpost{{$post->id}}").attr('class', "fa fa-thumbs-down");
                                                    var dislikeval = $('#dislikespanpost{{$post->id}}').text()
                                                    dislikeval =  parseInt(dislikeval);
                                                    dislikeval += 1;
                                                    $('#dislikespanpost{{$post->id}}').text(dislikeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postdislikenolike',
                                                        type: 'post',
                                                        data: {'replyid': replyid}
                                                    });
                                                }

                                                if(thumbdownclass == "fa fa-thumbs-o-down" && thumbupclass == "fa fa-thumbs-up") {
                                                    $("#thumbdownpost{{$post->id}}").attr('class', "fa fa-thumbs-down");
                                                    $("#thumbuppost{{$post->id}}").attr('class', "fa fa-thumbs-o-up");
                                                    var dislikeval = $('#dislikespanpost{{$post->id}}').text();
                                                    var likeval = $('#likespanpost{{$post->id}}').text();
                                                    dislikeval =  parseInt(dislikeval);
                                                    dislikeval += 1;
                                                    likeval = parseInt(likeval);
                                                    likeval -= 1;
                                                    $('#dislikespanpost{{$post->id}}').text(dislikeval);
                                                    $('#likespanpost{{$post->id}}').text(likeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postdislikeandlike',
                                                        type: 'post',
                                                        data: {'replyid': replyid}
                                                    });

                                                }

                                                if(thumbdownclass == "fa fa-thumbs-down") {
                                                    $("#thumbdownpost{{$post->id}}").attr('class', "fa fa-thumbs-o-down");
                                                    var dislikeval = $('#dislikespanpost{{$post->id}}').text()
                                                    dislikeval =  parseInt(dislikeval);
                                                    dislikeval -= 1;
                                                    $('#dislikespanpost{{$post->id}}').text(dislikeval);

                                                    $.ajax({
                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                        url: '/postnodisliking',
                                                        type: 'post',
                                                        data: {'replyid': replyid}
                                                    });
                                                }

                                            });
                                        });
                                    </script>

                                    <div class="prev pull-left">
                                        <a data-toggle="tooltip" class="red-tooltip" title="Reply" href="#mainreply" id="postreplydelete"><i class="fa fa-reply"></i></a>
                                    </div>

                                    <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted: {{$date}}</div>

                                    <div class="next pull-right">
                                        <form method="post" action="{{route('report')}}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="textreply" value="{{$post->textpost}}">
                                            <input type="hidden" name="authorid" value="{{$post->authorid}}">
                                            <button id="submitreportpost{{$post->id}}" type="submit"></button>
                                        </form>
                                        <label for="submitreportpost{{$post->id}}">
                                            <a class="red-tooltip" data-toggle="tooltip" title="Report" style="cursor: pointer;"><i class="fa fa-flag"></i></a>
                                        </label>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                          @endforeach
                            <!-- POST -->

                            <div class="paginationf">
                                @if($previouspage != false)
                                    <div class="pull-left"><a href='{{url("/post/$postid/$previouspage")}}' class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                                @endif
                                @if($previouspage == false)
                                    <div class="pull-left"><a class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                                @endif
                                <div class="pull-left">
                                    <ul class="paginationforum">
                                        <?php for($i = 1; $i <= $pagecount; $i++): ?>
                                        <li><a href="#" <?php if($page == $i) echo 'class="active"'?>><?php echo "$i"; ?></a></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                                    <div class="pull-left"><a href='{{url("/post/$postid/$nextpage")}}' class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                                <div class="clearfix"></div>
                            </div>




                            <!-- REPLIES -->
                            @foreach($DBreplies as $reply)
                                @php
                                if($reply->authorid != 0) {
                                    $DBusers = DB::table('users')->where('id', $reply->authorid)->get();
                                    foreach ($DBusers as $user) {
                                        $namepicture = $user->profilepicture;
                                        $username = $user->name;
                                    }
                                } else {
                                    $namepicture = 'noperson.jpg';
                                    $username = 'Guest';
                                }
                                @endphp
                            <div class="post">
                                <div class="topwrap">
                                    <div class="userinfo pull-left">
                                        <div class="avatar">
                                            @if($namepicture != 'noperson.jpg')
                                                <img data-toggle="tooltip" title="{{$username}}" class="profileimageloader red-tooltip" src='{{asset("storage/images/$username/$namepicture")}}' style="width: 40px; height: 40px; display: none" alt="" />
                                            @endif
                                            @if($namepicture == 'noperson.jpg')
                                                <img data-toggle="tooltip" title="{{$username}}" class="profileimageloader red-tooltip" src='{{asset("storage/images/$namepicture")}}' style="width: 40px; height: 40px;display: none" alt="" />
                                            @endif

                                            @if($reply->authorid == 0)
                                                <div class="status gray statusgray">&nbsp;</div>
                                            @elseif($status == false)
                                                <div class="status red"></div>
                                            @elseif($status == true)
                                                <div class="status green"></div>
                                            @endif
                                        </div>

                                        <div class="icons">
                                            <img src="images/icon3.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="posttext pull-left">
                                      @php
                                      $DBtowhoreplies;
                                        $DBtowhoreplies = DB::table('towhoreplies')->where('replyid', $reply->id)->get();

                                      @endphp
                                      @foreach($DBtowhoreplies as $towhoreply)
                                        <blockquote>
                                            <span class="original">Original posted by - <b>{{$towhoreply->towhoreplyname}}</b></span>
                                            {{$towhoreply->towhotextreply}}
                                        </blockquote>
                                      @endforeach
                                        @php $text = $reply->textreply;$breaks = array("<br />","<br>","<br/>");$text = str_ireplace($breaks, "\r\n", $text);$text = nl2br($text);echo $text;@endphp
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="postinfobot">

                                    <div class="likeblock pull-left">
                                        <a  data-replyid="{{$reply->id}}" id="like{{$reply->id}}" class="up likedislike"><i id="thumbup{{$reply->id}}" class="fa @php
                                                $likecount = 0;
                                                $DBpostlikecheck = DB::table('likes')->where('authorip', $authorip)->where('replyid', $reply->id)->get();
                                                foreach($DBpostlikecheck as $postlikecheck){
                                                    $likecount += 1;
                                                }
                                                if($likecount ==0) {
                                                    echo 'fa-thumbs-o-up';
                                                } else echo 'fa-thumbs-up';@endphp"></i><span id="likespan{{$reply->id}}">{{$reply->likes}}</span></a>
                                        <a  data-replyid="{{$reply->id}}" id="dislike{{$reply->id}}" class="down likedislike"><i id="thumbdown{{$reply->id}}" class="fa @php
                                                $likecount = 0;
                                                $DBpostlikecheck = DB::table('dislikes')->where('authorip', $authorip)->where('replyid', $reply->id)->get();
                                                foreach($DBpostlikecheck as $postlikecheck){
                                                    $likecount += 1;
                                                }
                                                if($likecount ==0) {
                                                    echo 'fa-thumbs-o-down';
                                                } else echo 'fa-thumbs-down';@endphp"></i><span id="dislikespan{{$reply->id}}">{{$reply->dislikes}}</span></a>
                                    </div>

                                    <script>
                                    $(document).ready(function() {

                                      $("#like{{$reply->id}}").on('click', function(){
                                        var replyid = $(this).data('replyid');
                                        var thumbupclass = $("#thumbup{{$reply->id}}").attr('class');
                                        var thumbdownclass =  $("#thumbdown{{$reply->id}}").attr('class');

                                        if(thumbupclass == "fa fa-thumbs-o-up" && thumbdownclass == "fa fa-thumbs-o-down") {
                                          $("#thumbup{{$reply->id}}").attr('class', "fa fa-thumbs-up");
                                          var likeval = $('#likespan{{$reply->id}}').text()
                                          likeval =  parseInt(likeval);

                                          likeval += 1;
                                          $('#likespan{{$reply->id}}').text(likeval);

                                          $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/likingnodislike',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });
                                        }

                                        if(thumbupclass == "fa fa-thumbs-o-up" && thumbdownclass == "fa fa-thumbs-down") {
                                          $("#thumbup{{$reply->id}}").attr('class', "fa fa-thumbs-up");
                                          $("#thumbdown{{$reply->id}}").attr('class', "fa fa-thumbs-o-down");
                                          var likeval = $('#likespan{{$reply->id}}').text();
                                          var dislikeval = $('#dislikespan{{$reply->id}}').text();
                                          dislikeval =  parseInt(dislikeval);
                                          dislikeval -= 1;
                                          likeval =  parseInt(likeval);
                                          likeval += 1;
                                          $('#dislikespan{{$reply->id}}').text(dislikeval);
                                          $('#likespan{{$reply->id}}').text(likeval);

                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/likinganddislike',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });
                                        }

                                        if(thumbupclass == "fa fa-thumbs-up") {
                                          $("#thumbup{{$reply->id}}").attr('class', "fa fa-thumbs-o-up");
                                          var likeval = $('#likespan{{$reply->id}}').text()
                                          likeval =  parseInt(likeval);
                                          likeval -= 1;
                                          $('#likespan{{$reply->id}}').text(likeval);

                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/noliking',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });
                                        }

                                      });


                                      $("#dislike{{$reply->id}}").on('click', function(){
                                          var replyid = $(this).data('replyid');
                                        var thumbupclass = $("#thumbup{{$reply->id}}").attr('class');
                                        var thumbdownclass =  $("#thumbdown{{$reply->id}}").attr('class');

                                        if(thumbdownclass == "fa fa-thumbs-o-down" && thumbupclass == "fa fa-thumbs-o-up") {
                                          $("#thumbdown{{$reply->id}}").attr('class', "fa fa-thumbs-down");
                                          var dislikeval = $('#dislikespan{{$reply->id}}').text()
                                          dislikeval =  parseInt(dislikeval);
                                          dislikeval += 1;
                                          $('#dislikespan{{$reply->id}}').text(dislikeval);

                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/dislikenolike',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });
                                        }

                                        if(thumbdownclass == "fa fa-thumbs-o-down" && thumbupclass == "fa fa-thumbs-up") {
                                          $("#thumbdown{{$reply->id}}").attr('class', "fa fa-thumbs-down");
                                          $("#thumbup{{$reply->id}}").attr('class', "fa fa-thumbs-o-up");
                                          var dislikeval = $('#dislikespan{{$reply->id}}').text();
                                          var likeval = $('#likespan{{$reply->id}}').text();
                                          dislikeval =  parseInt(dislikeval);
                                          dislikeval += 1;
                                          likeval = parseInt(likeval);
                                          likeval -= 1;
                                          $('#dislikespan{{$reply->id}}').text(dislikeval);
                                          $('#likespan{{$reply->id}}').text(likeval);

                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/dislikeandlike',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });

                                        }

                                        if(thumbdownclass == "fa fa-thumbs-down") {
                                          $("#thumbdown{{$reply->id}}").attr('class', "fa fa-thumbs-o-down");
                                          var dislikeval = $('#dislikespan{{$reply->id}}').text()
                                          dislikeval =  parseInt(dislikeval);
                                          dislikeval -= 1;
                                          $('#dislikespan{{$reply->id}}').text(dislikeval);

                                            $.ajax({
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  },
                                                url: '/nodisliking',
                                                type: 'post',
                                                data: {'replyid': replyid}
                                            });
                                        }

                                      });
                                    });
                                    </script>

                                    <div class="prev pull-left">
                                      @php
                                        $authorid = $reply->authorid;if($reply->authorid != 0) {$DBusers = DB::table('users')->where('id', $authorid)->get();foreach($DBusers as $user){$authorname = $user->name;}}else {$authorname = "Guest";}
                                      @endphp
                                        <a  href="#posttext" class="red-tooltip" data-toggle="tooltip" title="Reply" id="replyhref{{$reply->id}}" data-authorname="{{$authorname}}" data-replytext = "{{$reply->textreply}}"><i class="fa fa-reply"></i></a>

                                        <script>
                                          $(document).ready(function(){
                                            $("#replyhref{{$reply->id}}").on('click', function(){
                                              var authorname = $(this).data('authorname');
                                              var replytext = $(this).data('replytext');
                                              $('#spanwithtextreply').html(replytext);
                                              $('#authoreply').html(authorname);
                                              $('.visiblereply').show();
                                              $('input[name="towhoreplyname"]').val(authorname);
                                              $('input[name="towhoreplytext"]').val(replytext);
                                              $('#divwithtextarea').addClass('textareainreply');
                                            });
                                          });
                                        </script>
                                    </div>

                                    <div class="posted pull-left"><i class="fa fa-clock-o"></i> Posted:
                                      @php
                                        $date =$reply->created_at;
                                        $date = strtotime($date);
                                        $datenow = time();
                                        $roznica = $datenow - $date;

                                        //RUNNIC HELPER METHOD
                                        $date = timecompute($roznica);
                                        echo "$date";
                                      @endphp
                                    </div>

                                    <div class="next pull-right">
                                        <form method="post" action="{{route('report')}}" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="textreply" value="{{$reply->textreply}}">
                                            <input type="hidden" name="authorid" value="{{$reply->authorid}}">
                                            <button id="submitreport{{$reply->id}}" type="submit"></button>
                                        </form>
                                        <label for="submitreport{{$reply->id}}">
                                            <a class="red-tooltip" data-toggle="tooltip" title="Report" style="cursor: pointer;"><i class="fa fa-flag"></i></a>
                                        </label>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                          @endforeach
                            <!-- REPLIES -->



                            <!-- ADDREPLY-->
                            <div class="post" id="mainreply">
                                <form action="{{route('addreply')}}" class="form" method="post">
                                  @csrf
                                  <input type="hidden" value="{{$postid}}" name="postid">
                                  <input type="hidden" value="0" name="towhoreplyname">
                                  <input type="hidden" value="0" name="towhoreplytext">
                                    <div class="topwrap">

                                        <div class="userinfo pull-left">
                                            <div class="avatar">
                                                @guest
                                                    <img src='{{asset("storage/images/noperson.jpg")}}' style="height:37px; width: 37px;" alt="" />
                                                @else
                                                    <img src='{{asset("storage/images/".Auth::user()->name.'/'.Auth::user()->profilepicture)}}' style="height:37px; width: 37px;" alt="" />
                                                @endguest
                                              @if(Auth::check())
                                                    <div class="status green">&nbsp;</div>
                                              @else
                                                   <div class="status  gray statusgray"></div>
                                              @endif
                                            </div>

                                            <div class="icons">
                                                <img src="images/icon3.jpg" alt="" /><img src="images/icon4.jpg" alt="" /><img src="images/icon5.jpg" alt="" /><img src="images/icon6.jpg" alt="" />
                                            </div>
                                        </div>
                                        <div class="posttext pull-left visiblereply" id="posttext" style="display:none;">
                                            <blockquote>
                                                <a id="replydelete"><i class="fa fa-times replydelete"></i></a>
                                                <span class="original">Reply to -    <b id="authoreply"></b></span>
                                                <span id="spanwithtextreply"></span>
                                            </blockquote>
                                        </div>
                                        <div class="clearfix visiblereply" style="display:none;"></div>
                                        <div class="posttext pull-left" id="divwithtextarea">
                                            <div class="textwraper">
                                                <div class="postreply">Post a Reply</div>
                                                <textarea maxlength="5000" name="textreply" id="reply" rows="5" placeholder="Type your message here" required></textarea>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="postinfobot">


                                        <div class="pull-right postreply">
                                            <div class="pull-left dropup">

                                                  <div class="dropdown-toggle smile pull-left" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                      <a class="dropdown-toggle hoverpointerphp">
                                                        <i class="fa fa-smile-o"></i>
                                                     </a>
                                                  </div>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownemotes" role="menu" style="position: absolute; min-height: 100px; margin-bottom: -80px !important; margin-left: -37vh !important;  width: 200px;font-family: 'Roboto', sans-serif; padding-top: 0; padding-left: 10px; padding-right:10px; font-weight: bold; z-index: 400; font-size: 20px; color: #555555;">
                                                        <a id="emote1" class="emote">😊</a>
                                                        <a id="emote2" class="emote">😛</a>
                                                        <a id="emote3" class="emote">😉</a>
                                                        <a id="emote4" class="emote">😢</a>
                                                        <a id="emote5" class="emote">😮</a>
                                                        <a id="emote6" class="emote">😯</a>
                                                        <a id="emote7" class="emote">😧</a>
                                                        <a id="emote8" class="emote">😫</a>
                                                        <a id="emote9" class="emote">😭</a>
                                                        <a id="emote10" class="emote">😠</a>
                                                    </ul>
                                            </div>
                                            <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                                            <div class="clearfix"></div>
                                        </div>


                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div><!-- POST -->


                        </div>
                        @include('layouts.sidebar')
                    </div>
                </div>



                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            @if($previouspage != false)
                            <div class="pull-left"><a href='{{url("/post/$postid/$previouspage")}}' class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                            @endif
                            @if($previouspage == false)
                                    <div class="pull-left"><a class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                            @endif
                            <div class="pull-left">
                                <ul class="paginationforum">
                                    <?php for($i = 1; $i <= $pagecount; $i++): ?>
                                    <li><a href="#" <?php if($page == $i) echo 'class="active"'?>><?php echo "$i"; ?></a></li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="pull-left"><a href='{{url("/post/$postid/$nextpage")}}' class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </section>
          </div>



          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
