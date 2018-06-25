@extends('layouts.app0nav')

@section('title') Treerum - Reset password @endsection
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
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0" style="margin-top: 15px;">
                                        <div class="col-md-6 offset-md-4">
                                            <a href="{{url('/login')}}" style="color: #888a85;">Return to login</a>
                                        </div>
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
