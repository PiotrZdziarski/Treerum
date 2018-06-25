<div class="scalingtopdiv clearfix" style="padding-bottom: 24%;">
  <img src="{{Asset('storage/images/forrestspring.jpg')}}" id="mainimage" style="display: none; position: absolute;width: 100%;"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
</div>
<div class="headernav" id="navmainid">
    <div class="container">
        <div class="row">

          <div class="col-lg-1 col-xs-2 col-sm-2 col-md-2 logo" style="position:relative;  padding-right:20px; z-index: 10;">
            <a href="{{Url('/')}}">
              <img id="logoimg" style="display:none;" src="{{asset('storage/images/logo.jpg')}}" alt=""  />
            </a>
          </div>

            <div class="col-lg-3 col-xs-6 col-sm-5 col-md-3 selecttopic" style="position:relative; z-index: 10; padding-left:30px;">
                <a href="{{Url('/')}}" class="maintitle">Treerum</a>
            </div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="margin-bottom:0;">
              <div class="navbar-header">
                <button class="navbar-toggler visible-xs" id="buttonnavbartoggle" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
              </div>
              <div class="collapse navbar-collapse" id="navbarmain" style="border-top: 1px solid #eeeeee;">
                <div class="col-lg-4 search  col-md-3">

                        <form action="{{route('searchingredirect')}}" method="post" class="form">
                            @csrf
                            <div class="pull-left txt">
                                <div class="searchingresult">

                                </div>
                                <input type="text" class="form-control searcher" name="searchtext" placeholder="Search Topics" required>
                            </div>
                            <div class="pull-right"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></div>
                            <div class="clearfix"></div>
                        </form>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                    <div class="stnt pull-left" style="margin-right: 30px;">
                            <a href="{{Route('addpost')}}"><button class="btn btn-primary">Start New Topic</button></a>
                    </div>

                    @guest
                      <div class="avatar pull-left dropdown">
                          <a data-toggle="dropdown" href="#">
                                <img data-toggle="tooltip" title="Guest" class="red-tooltip" src='{{asset("storage/images/noperson.jpg")}}' style="height:37px; width: 37px;" alt="" />
                              <div class="status gray statusgray">&nbsp;</div>
                              <b class="caret"></b>
                          <ul class="dropdown-menu" role="menu">
                              <li role="presentation"><a role="menuitem" tabindex="-3" href="{{url('/login')}}">Log In</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-4" href="{{url('/register')}}">Create account</a></li>
                          </ul>
                          </a>
                      </div>

                    @else
                        @if(Auth::user()->profilepicture == 'noperson.jpg')
                      <div class="avatar pull-left dropdown">
                          <a data-toggle="dropdown" href="#"><img data-toggle="tooltip" title="{{Auth::user()->name}}" class="red-tooltip" src='{{asset("storage/images/".Auth::user()->profilepicture)}}' style="height:37px; width: 37px;" alt="" /><b class="caret"></b>
                                  <div class="status green">&nbsp;</div>
                          <ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 400;">
                              <li role="presentation"><a role="menuitem" tabindex="-3" href="{{route('myprofile')}}">My Profile</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-3" href="{{route('privateposts')}}">Private posts</a></li>
                              <li role="presentation">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a role="menuitem" tabindex="-3" style="padding:0;">
                                      <button role="menuitem" id="logoutbuttonpls"><a>Log out</a></button>
                                    </a>
                                </form>
                              </li>
                          </ul>
                          </a>
                      </div>
                        @else
                            <div class="avatar pull-left dropdown">
                          <a data-toggle="dropdown" href="#"><img src='{{asset("storage/images/".Auth::user()->name.'/'.Auth::user()->profilepicture)}}' style="height:37px; width: 37px;" alt="" /><b class="caret"></b>
                                  <div class="status green">&nbsp;</div>
                          <ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 400;">
                              <li role="presentation"><a role="menuitem" tabindex="-3" href="{{route('myprofile')}}">My Profile</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-3" href="{{route('privateposts')}}">Private posts</a></li>
                              <li role="presentation">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a role="menuitem" tabindex="-3" style="padding:0;">
                                      <button role="menuitem" id="logoutbuttonpls"><a>Log out</a></button>
                                    </a>
                                </form>
                              </li>
                          </ul>
                          </a>
                      </div>
                      @endif
                    @endguest

                    <div class="clearfix"></div>
                </div>
              </div>
            </nav>
        </div>
    </div>
</div>
