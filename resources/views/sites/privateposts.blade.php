@extends('layouts.app0nav')
@section('title') Treerum @endsection
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
                              <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                              <div class="pull-left">
                                  <ul class="paginationforum">
                                      <li class="hidden-xs"><a href="#" class="active">1</a></li>
                                      <li class="hidden-xs"><a href="#">2</a></li>
                                      <li class="hidden-xs"><a href="#">3</a></li>
                                      <li class="hidden-xs"><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">6</a></li>
                                      <li><a href="#">7</a></li>
                                      <li><a href="#">8</a></li>
                                      <li class="hidden-xs"><a href="#">9</a></li>
                                      <li class="hidden-xs"><a href="#">10</a></li>
                                      <li class="hidden-xs hidden-md"><a href="#">11</a></li>
                                      <li class="hidden-xs hidden-md"><a href="#">12</a></li>
                                      <li class="hidden-xs hidden-sm hidden-md"><a href="#">13</a></li>
                                      <li><a href="#">1586</a></li>
                                  </ul>
                              </div>
                              <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                              <div class="clearfix"></div>
                          </div>
                      </div>
                  </div>


                  <div class="container">
                      <div class="row">
                          <div class="col-lg-8 col-md-8">
                              <!-- POST -->
                            @foreach($DBposts as $post)
                                  @php
                                      $DBusers = DB::table('users')->where('id', $post->authorid)->get();
                                      foreach ($DBusers as $user) {
                                          $namepicture = $user->profilepicture;
                                          $username = $user->name;
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
                                                  <div class="status green">&nbsp;</div>
                                          </div>

                                          <div class="icons">
                                              <img src="images/icon1.jpg" alt="" /><img src="images/icon4.jpg" alt="" />
                                          </div>
                                      </div>
                                      <div class="posttext pull-left">
                                          <h2>{{$post->title}}</h2>
                                          <p>{{$post->textpost}}</p>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  <div class="postinfo pull-left">
                                      <div class="comments">
                                          <div class="commentbg">
                                              -
                                              <div class="mark"></div>
                                          </div>

                                      </div>
                                      <div class="views"><i class="fa fa-eye"></i> ---</div>
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
                              <div class="pull-left"><a href="#" class="prevnext"><i class="fa fa-angle-left"></i></a></div>
                              <div class="pull-left">
                                  <ul class="paginationforum">
                                      <li class="hidden-xs"><a href="#">1</a></li>
                                      <li class="hidden-xs"><a href="#">2</a></li>
                                      <li class="hidden-xs"><a href="#">3</a></li>
                                      <li class="hidden-xs"><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">6</a></li>
                                      <li><a href="#" class="active">7</a></li>
                                      <li><a href="#">8</a></li>
                                      <li class="hidden-xs"><a href="#">9</a></li>
                                      <li class="hidden-xs"><a href="#">10</a></li>
                                      <li class="hidden-xs hidden-md"><a href="#">11</a></li>
                                      <li class="hidden-xs hidden-md"><a href="#">12</a></li>
                                      <li class="hidden-xs hidden-sm hidden-md"><a href="#">13</a></li>
                                      <li><a href="#">1586</a></li>
                                  </ul>
                              </div>
                              <div class="pull-left"><a href="#" class="prevnext last"><i class="fa fa-angle-right"></i></a></div>
                              <div class="clearfix"></div>
                          </div>
                      </div>
                  </div>
              </section>
          </div>




          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
