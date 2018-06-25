
@extends('layouts.app0nav')
@section('title') Treerum - Register @endsection
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
                            <div class="post" style="padding: 30px; padding-bottom:15px;">
                              <form method="POST" action="{{ route('register') }}">
                                  @csrf

                                  <div class="form-group row">
                                      <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                      <div class="col-md-6">
                                          <input id="name" maxlength="30" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                          @if ($errors->has('name'))
                                              <span class="invalid-feedback">
                                                  <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                      <div class="col-md-6">
                                          <input id="email" maxlength="100"  type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                          @if ($errors->has('email'))
                                              <span class="invalid-feedback">
                                                  <strong>{{ $errors->first('email') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                      <div class="col-md-6">
                                          <input id="password" maxlength="50" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                          @if ($errors->has('password'))
                                              <span class="invalid-feedback">
                                                  <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                      <div class="col-md-6">
                                          <input id="password-confirm" maxlength="50" type="password" class="form-control" name="password_confirmation" required>
                                      </div>
                                  </div>

                                  <div class="form-group row mb-0">
                                      <div class="col-md-6 offset-md-4">
                                          <button type="submit" class="btn btn-primary">
                                              {{ __('Register') }}
                                          </button>
                                      </div>
                                  </div>

                                  <a href="{{url('/login')}}" style="color: #666666">Already have an account?</a>
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
