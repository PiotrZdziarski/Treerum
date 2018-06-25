@extends('layouts.app0nav')
@section('title') Treerum - Error @endsection
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


                  <div class="container" style="margin-top: 30px;">
                      <div class="row">
                          <div class="col-lg-8 col-md-8">
                              <!-- POST -->
                              <div class="categorydiv">Oops! It looks like you've lost ;/</div>




                          </div>
                          @include('layouts.sidebar')
                      </div>
                  </div>




              </section>
          </div>




          <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
@endsection
