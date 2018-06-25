@extends('layouts.app0nav')
@section('title') Treerum - Add post @endsection
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
                        <div class="col-md-8 col-lg-10 breadcrumbf" style="margin-left: 0;">
                            <a href="{{url('/')}}">Treerum</a> <span class="diviver">&gt;</span> <a href="#">Add post</a>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">

                          <!-- FORM -->
                          <div class="post">
                              <form action="{{Route('addingpostmethod')}}" class="form newtopic" method="post">
                                @CSRF
                                  <div class="topwrap">
                                      <div class="userinfo pull-left">
                                          <div class="avatar">
                                              @if(Auth::user()->profilepictre == 'noperson.jpg')
                                                    <img class="profileimageloader" src='{{asset("storage/images/noperson.jpg")}}' style="height:37px; width: 37px; display: none;" alt="" />
                                              @else
                                                    <img class="profileimageloader" src='{{asset("storage/images/".Auth::user()->name.'/'.Auth::user()->profilepicture)}}' style="height:37px; width: 37px; display: none;" alt="" />
                                              @endif
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
                                      <div class="posttext pull-left">

                                          <div>
                                              <input type="text" maxlength="200" name="title" placeholder="Enter Topic Title" class="form-control" required/>
                                          </div>

                                          <div class="row">
                                              <div class="col-lg-6 col-md-6">
                                                  <select name="category" id="category"  class="form-control" required>
                                                      <option value="" disabled selected>Select Category</option>
                                                      @foreach($DBcategories as $category)
                                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                          <div>
                                              <textarea name="description" maxlength="5000" id="reply" placeholder="Description"  class="form-control" required></textarea>
                                          </div>
                                          <div class="row newtopcheckbox">
                                              <div class="col-lg-6 col-md-6">
                                                  <div><p>Who can see this?</p></div>
                                                  <div class="row">
                                                      <div class="col-lg-6 col-md-6" style="padding-left:0;">
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="radio" value="Everyone" name="whocanseethis" id="everyone" required/> Everyone
                                                              </label>
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 col-md-6" style="padding-left:0;">
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="radio" value="Only Me" name="whocanseethis" id="friends"  /> Only Me
                                                              </label>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
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
                                          <div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
                                          <div class="clearfix"></div>
                                      </div>


                                      <div class="clearfix"></div>
                                  </div>
                              </form>
                          </div>

                        <!-- END OF FORM -->
                        </div>
                        @include('layouts.sidebar')
                    </div>
                </div>


            </section>
          </div>




          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
