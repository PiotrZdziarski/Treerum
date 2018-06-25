<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use DB;
use Auth;
use DateTime;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Support\Facades\Validator;

class SitesController extends Controller
{
  public function post($id, $page = 1)
  {
      if(!is_numeric($id)) {
          $DBposts  = DB::table('posts')->where('whocanseethis', 'Everyone')->where('title', $id)->get();
          foreach($DBposts as $poster) {
              $id =$poster->id;
          }
      } else {
          $DBposts = DB::table('posts')->where('whocanseethis', 'Everyone')->where('id', $id)->get();
      }
      $postcount = 0;
      foreach($DBposts as $post) {
          $postcount++;
      }
      if($postcount == 0) {
          return redirect('/error');
      }
    DB::table('posts')->where('id', $id)->where('whocanseethis', 'Everyone')->increment('viewed');
    $postid = $id;
    $DBcategories = DB::table('categories')->get();
    $DBrepliescheck = DB::table('replies')->select('id')->where('postid', $id)->get();
    ////
      $postcount = 0;
      if($page > 1) {
          $previouspage = $page - 1;
      } else {
          $previouspage = false;
      }
      $nextpage = $page + 1;
      $pageminus = $page  - 1;
      $toskip = $pageminus * 20;
      foreach($DBrepliescheck as $reply) {
          $postcount++;
      }
      $pagecount = ceil($postcount / 20);

      $DBreplies = DB::table('replies')->where('postid', $id)->take(20)->skip($toskip)->get();
    ////
    $authorip = Request::ip();

      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end

    foreach ($DBposts as $post) {
      $date = $post->created_at;
    }
    $date = strtotime($date);
    $datenow = time();
    $roznica = $datenow - $date;

    //RUNNIC HELPER METHOD
    $date = timecompute($roznica);

      if(isset(Auth::user()->name)) {
          $loggedid = Auth::user()->id;
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads  = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->take(6)->groupBy('title')->get();
          return view('sites.post', ['DBposts' => $DBposts, 'date' => $date, 'postid' => $postid, 'DBcategories' => $DBcategories, 'page' => $page, 'pagecount' => $pagecount,
              'DBreplies' => $DBreplies, 'nextpage' => $nextpage, 'previouspage' => $previouspage, 'authorip' => $authorip, 'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
      }

    return view('sites.post', ['DBposts' => $DBposts, 'date' => $date, 'postid' => $postid, 'DBcategories' => $DBcategories,
    'DBreplies' => $DBreplies,'nextpage' => $nextpage, 'previouspage' => $previouspage, 'authorip' => $authorip, 'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'page' => $page, 'pagecount' => $pagecount]);
  }

  public function addpost()
  {
    $DBcategories = DB::table('categories')->get();
      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end
      if(isset(Auth::user()->name)) {
          $loggedid = Auth::user()->id;
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads  = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->groupBy('title')->take(6)->get();
          return view('sites.addpost', ['DBcategories' => $DBcategories, 'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
      }
    return view('sites.addpost', ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
  }


  public function category($category, $page = 1)
  {
      $DBpostscheck= DB::table('posts')->where('whocanseethis', 'Everyone')->where('category', $category)->select('id')->get();
      $postcount = 0;
      $pageminus = $page  - 1;
      $toskip = $pageminus * 20;
      foreach($DBpostscheck as $post) {
          $postcount++;
      }
      $pagecount = ceil($postcount / 20);
      if($page > 1) {
          $previouspage = $page - 1;
      } else {
          $previouspage = false;
      }
      $nextpage = $page + 1;

      $DBposts = DB::table('posts')->where('whocanseethis', 'Everyone')->where('category', $category)->take(20)->skip($toskip)->get();
      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end
    $DBcategories = DB::table('categories')->get();
      if(isset(Auth::user()->name)) {
          $loggedid = Auth::user()->id;
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads  = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->groupBy('title')->take(6)->get();
          return view('sites.category', ['DBcategories' => $DBcategories, 'nextpage' => $nextpage, 'previouspage' => $previouspage,'DBposts' => $DBposts, 'category' => $category,
              'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'DBactivethreads' => $DBactivethreads,'page' => $page, 'pagecount' => $pagecount]);
      }

    return view('sites.category', ['DBcategories' => $DBcategories, 'DBposts' => $DBposts, 'DBpoll' => $DBpoll,'allvotes' => $allvotes,
        'category' => $category,'page' => $page,'nextpage' => $nextpage, 'previouspage' => $previouspage, 'pagecount' => $pagecount,]);
  }

  public function  myprofile() {
      $DBcategories = DB::table('categories')->get();
      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end
      $username = Auth::user()->name;
      $useremail = Auth::user()->email;
      $profilepicture = Auth::user()->profilepicture;
      if(isset(Auth::user()->name)) {
          $loggedid = Auth::user()->id;
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads  = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->groupBy('title')->take(6)->get();
          return view('sites.myprofile', ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'username' => $username, 'profilepicture' => $profilepicture, 'useremail' => $useremail, 'DBactivethreads' => $DBactivethreads]);
      }
      return view('sites.myprofile', ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'username' => $username, 'profilepicture' => $profilepicture, 'useremail' => $useremail]);
  }

  public  function error() {
      $DBcategories = DB::table('categories')->get();
      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end
      if(isset(Auth::user()->name)) {
          $loggedid = Auth::user()->id;
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->groupBy('title')->take(6)->get();
          return view('sites.error', ['DBcategories' => $DBcategories,'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
      }
      return view('sites.error', ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
  }

  public function privateposts() {
      $DBcategories = DB::table('categories')->get();
      $loggedid = Auth::user()->id;
      $DBposts = DB::table('posts')->where('authorid', $loggedid)->where('whocanseethis', 'Only Me')->get();
      //need for poll
      $allvotes = 0;
      $DBpoll = DB::table('poll')->get();
      $DBvotes = DB::table('pollvotes')->select('id')->get();
      foreach ($DBvotes as $vote) {
          $allvotes++;
      }
      //end
      if(isset(Auth::user()->name)) {
          $DBrepliesthreads = DB::table('replies')->where('authorid', $loggedid)->get();
          array_set($array, 'arraycreator45236125312', 69);
          foreach ($DBrepliesthreads as $replythreads) {
              array_push($array, $replythreads->postid);
          }
          array_forget($array, 'arraycreator45236125312');
          $DBactivethreads = DB::table('posts')->where('authorid', $loggedid)->orWhereIn('id', $array)->orderBy('updated_at', 'desc')->select('title', 'id')->groupBy('title')->take(6)->get();
          return view('sites.privateposts', ['DBcategories' => $DBcategories,'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'DBposts' => $DBposts]);
      }
      return view('sites.privateposts', ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll,'allvotes' => $allvotes, 'DBposts' => $DBposts]);
  }
}
