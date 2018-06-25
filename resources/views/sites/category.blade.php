@extends('layouts.app0nav')
@section('title') Treerum - {{$category}} @endsection
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
                          <div class="col-lg-10 col-xs-12 col-md-8">
                              @if($previouspage != false)
                                  <div class="pull-left"><a href='{{url("/$previouspage")}}' class="prevnext"><i class="fa fa-angle-left"></i></a></div>
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
                              <div class="pull-left"><a href='{{url("/$nextpage")}}' class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                              <div class="clearfix"></div>
                          </div>
                      </div>
                  </div>

                  <div class="container">
                      <div class="row">
                          <div class="col-lg-8 col-md-8">
                              <!-- POST -->
                              <div class="categorydiv">Category: {{$category}}</div>
                            @foreach($DBposts as $post)
                                  @php
                                      $DBusers = DB::table('users')->select('profilepicture', 'name', 'status')->where('id', $post->authorid)->get();
                                      foreach ($DBusers as $user) {
                                          $namepicture = $user->profilepicture;
                                          $username = $user->name;
                                          $status  = $user->status;
                                      }
                                  @endphp
                              <div class="post">
                                  <div class="wrap-ut pull-left">
                                      <div class="userinfo pull-left">
                                          <div class="avatar">
                                              @if($namepicture != 'noperson.jpg')
                                                  <img class="profileimageloader" src='{{asset("storage/images/$username/$namepicture")}}' style="width: 40px; height: 40px; display: none" alt="" />
                                              @endif
                                              @if($namepicture == 'noperson.jpg')
                                                  <img class="profileimageloader" src='{{asset("storage/images/$namepicture")}}' style="width: 40px; height: 40px;display: none" alt="" />
                                              @endif

                                              @if($status == false)
                                                   <div class="status red">&nbsp;</div>
                                              @else
                                                   <div class="status green">&nbsp;</div>
                                              @endif
                                          </div>

                                          <div class="icons">
                                              <img src="images/icon1.jpg" alt="" /><img src="images/icon4.jpg" alt="" />
                                          </div>
                                      </div>
                                      <div class="posttext pull-left">
                                          <h2><a href='{{url("/post/$post->id")}}'>{{$post->title}}</a></h2>
                                          <p>{{substr($post->textpost, 0, 120)}}...</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  <div class="postinfo pull-left">
                                      <div class="comments">
                                          <div class="commentbg">
                                             {{$post->comments}}
                                              <div class="mark"></div>
                                          </div>

                                      </div>
                                      <div class="views"><i class="fa fa-eye"></i> {{$post->viewed}}</div>
                                      <div class="time"><i class="fa fa-clock-o"></i>
                                        @php
                                          $date =$post->created_at;
                                          $date = strtotime($date);
                                          $datenow = time();
                                          $roznica = $datenow - $date;

                                          //RUNNIC HELPER METHOD
                                          $date = timecompute($roznica);
                                          echo "$date";
                                        @endphp
                                      </div>
                                  </div>
                                  <div class="clearfix"></div>
                              </div><!-- POST -->
                            @endforeach



                          </div>
                          @include('layouts.sidebar')
                      </div>
                  </div>



                  <div class="container">
                      <div class="row">
                          <div class="col-lg-8 col-xs-12">
                              @if($previouspage != false)
                                  <div class="pull-left"><a href='{{url("/$previouspage")}}' class="prevnext"><i class="fa fa-angle-left"></i></a></div>
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
                              <div class="pull-left"><a href='{{url("/$nextpage")}}' class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                              <div class="clearfix"></div>
                          </div>
                      </div>
                  </div>


              </section>
          </div>




          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
