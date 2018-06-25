<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
      $DBpostscheck= DB::table('posts')->where('whocanseethis', 'Everyone')->select('id')->get();
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

      $DBposts = DB::table('posts')->where('whocanseethis', 'Everyone')->take(20)->skip($toskip)->get();
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
          return view('home', ['DBposts' => $DBposts, 'page' => $page, 'pagecount' => $pagecount,'nextpage' => $nextpage, 'previouspage' => $previouspage,
              'DBcategories' => $DBcategories, 'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
      }
      return view('home', ['DBposts' => $DBposts, 'page' => $page, 'pagecount' => $pagecount,'nextpage' => $nextpage, 'previouspage' => $previouspage,
          'DBcategories' => $DBcategories,  'DBpoll' => $DBpoll, 'allvotes' => $allvotes]);
    }
}
