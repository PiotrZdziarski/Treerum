@extends('layouts.app0nav')
@section('title') Treerum - Report @endsection
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
                               <div class="categorydiv">Report</div>
                               <div class="post" style="padding: 30px; padding-bottom:15px;">
                                   <form method="POST" action="{{ route('reportingmethod') }}">
                                       @csrf
                                        <input type="hidden" value="{{$textreply}}" name="textofreporting">
                                        <input type="hidden" value="{{$authorid}}" name="authorid">
                                       <div class="form-group row" style="border-bottom: 1px solid lightgray; padding-bottom: 20px;">
                                           <label for="password" class="col-md-4 col-form-label text-md-right"></label>

                                           <div class="col-md-6">
                                               {{$textreply}}
                                           </div>
                                       </div>


                                       <div class="form-group row">
                                           <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                           <div class="col-md-6">
                                               <select name="category" id="category"  class="form-control" required>
                                                   <option value="" disabled selected>Select Category</option>
                                                   <option value="Spam">Spam</option>
                                                   <option value="Pornography">Pornography</option>
                                                   <option value="Violation of privacy">Violation of privacy</option>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                                           <div class="col-md-6">
                                               <textarea id="password" rows="3"  class="form-control" name="reason" required></textarea>

                                           </div>
                                       </div>


                                       <div class="form-group row mb-0" style="height: 26px;">

                                               <button type="submit" class="btn btn-primary" style="position: absolute; right: 5%;">
                                                   {{ __('Report') }}
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
