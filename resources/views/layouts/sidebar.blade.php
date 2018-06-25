<div class="col-lg-4 col-md-4">

    <!-- -->
    <div class="sidebarblock">
        <h3 style="color: #666666; font-weight: 700;">Categories</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <ul class="cats">
              @foreach($DBcategories as $category)
                <li><a href="/category/{{$category->name}}">{{$category->name}} <span class="badge pull-right">{{$category->posts}}</span></a></li>
              @endforeach
            </ul>
        </div>
    </div>

    <!-- -->
    <div class="sidebarblock">
        <h3 style="color: #666666; font-weight: 700;">Poll of the Week</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <p>Which game of those do you prefer?</p>
            <form action="#" method="post" class="form">
                <table class="poll">
                    @php
                        $userip =  Request::ip();
                        $DBpollchecker = DB::table('pollvotes')->where('authorip', $userip)->select('vote')->get();
                        $usercount = 0;
                        foreach($DBpollchecker as $pollchecker) {
                            $usercount++;
                            $forvote = $pollchecker->vote;
                        }
                       if($usercount > 0) {
                            $alreadyvoted = true;
                        } else $alreadyvoted = false;
                    @endphp
                    @foreach($DBpoll as $poll)
                        <tr>
                            <td>
                                <div class="progress nocolorproggres">
                                    <div class="progress-bar color{{$poll->id}} polloption{{$poll->option}}" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"@php $percentage = $poll->votes / $allvotes *100;echo "style='width: $percentage%;'"; @endphp>
                                        <span style="position: absolute;">{{$poll->option}}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="chbox">
                                <input id="opt{{$poll->option}}" class="radiochecker" type="radio" name="opt" value="{{$poll->option}}" required @php if($alreadyvoted) echo'disabled'; @endphp @php if($alreadyvoted){if($forvote == $poll->option) echo 'checked';}@endphp>
                                <label for="opt{{$poll->option}}"></label>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <button class="btnnormal btnhover @php if($alreadyvoted) echo'btnchecked'; @endphp" @php if($alreadyvoted) echo'disabled'; @endphp>Vote</button>
            </form>
            <p class="smal">Voting ends on 19th of October</p>
        </div>
    </div>

    <!-- -->
    @guest
    <div class="sidebarblock">
        <h3 >My Active Threads</h3>
        <div class="divline"></div>
        <div class="blocktxt">
            <a href="{{url('/login')}}" style="color: #555555;"><b>Log in to have easy access to your latest activities!</b></a>
        </div>
    </div>
    @else
        <div class="sidebarblock">
            <h3 style="color: #666666; font-weight: 700;">My Active Threads</h3>
            @foreach($DBactivethreads as $activethread)
            <div class="divline"></div>
            <div class="blocktxt">
                <a href='{{url("/post/$activethread->id")}}'>{{$activethread->title}}</a>
            </div>
            @endforeach
        </div>
     @endguest


</div>
