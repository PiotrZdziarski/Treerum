@extends('layouts.app0nav')
@section('title') Treerum - My profile @endsection
@section('content')
  <div class="container-fluid">
    <script>
    $(document).ready(function(){
      $('#mainimage').fadeIn(1500);
      $('#logoimg').fadeIn(1500);
    });
    </script>
              @include('layouts.topnav')
               <section class="content">
                   <div class="container" style="height: 30px;">
                   </div>

                   <div class="container">
                       <div class="row">
                           <div class="col-lg-8 col-md-8">
                               <div class="categorydiv">My profile</div>
                               <div class="post divemyprofile">
                                       <div class="form-group row">
                                           <label for="btnopenpicturemodal" class="col-md-4 col-sm-4 col-xs-5 col-form-label text-md-right">
                                               @if($profilepicture != 'noperson.jpg')
                                                   <img class="img-circle imgmyprofile" src='{{asset("storage/images/$username/$profilepicture")}}'>
                                               @else
                                                   <img class="img-circle imgmyprofile" src='{{asset("storage/images/$profilepicture")}}'>
                                               @endif
                                           </label>
                                           <form method="POST" action="{{ route('changepicture') }}" enctype="multipart/form-data">
                                               @csrf
                                               <div class="col-md-6" style="padding-top: 80px;">
                                                   <input type="file" name="profilepicture" class="form-control" required>
                                               </div>
                                                   <button type="submit" class="btn btn-primary btnsavepicture">
                                                       {{ __('Save picture') }}
                                                   </button>
                                           </form>
                                       </div>
                                    <form method="post" action="{{Route('editprofile')}}">
                                        @csrf
                                        <input type="hidden" value="{{$username}}" name="beforeusername">
                                        <input type="hidden" value="{{$useremail}}" name="beforeuseremail">
                                       <div class="form-group row" style="border-bottom: 1px solid lightgray; padding-bottom: 20px;">
                                           <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                                           <div class="col-md-6">

                                           </div>
                                       </div>


                                       <div class="form-group row">
                                           <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                           <div class="col-md-6">
                                               <input type="text" maxlength="30" name="username" value="{{$username}}" required class="form-control">
                                               @if (session('usernamesession'))
                                                   <span class="invalid-feedback">
                                                        <strong>{{ session('usernamesession') }}</strong>
                                                    </span>
                                               @endif
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                           <div class="col-md-6">
                                               <input type="email" maxlength="200"  rows="3" value="{{$useremail}}"  class="form-control" name="email" required>
                                               @if (session('emailsession'))
                                                   <span class="invalid-feedback">
                                                        <strong>{{ session('emailsession') }}</strong>
                                                    </span>
                                               @endif
                                           </div>
                                       </div>


                                       <div class="form-group row mb-0" style="height: 26px;">
                                               <button type="submit" class="btn btn-primary" style="position: absolute; right: 5%;">
                                                   {{ __('Save profile') }}
                                               </button>

                                       </div>
                                    </form>
                               </div>



                           </div>
                           @include('layouts.sidebar')
                       </div>
                   </div>

              </section>
          </div>




          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
