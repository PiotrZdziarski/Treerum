<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class UIcontroller extends Controller
{
    public function addingpostmethod(Request $request)
    {
      $title = $request->input('title');
      $category = $request->input('category');
      $description = $request->input('description');
      $whocanseethis = $request->input('whocanseethis');
      $userid = Auth::user()->id;
      $date = now();
      if($whocanseethis == 'Everyone') {
          DB::table('categories')->where('name', $category)->increment('posts');
      }
      DB::table('posts')->insert(['title' => $title, 'category' => $category, 'textpost' => $description, 'whocanseethis' => $whocanseethis,
      'likes' => 0, 'dislikes' => 0, 'comments' => 0, 'authorid' => $userid, 'viewed' => 0, 'created_at' => $date]);

      $addedone = DB::table('posts')->take(1)->orderBy('id', 'desc')->get();
      foreach($addedone as $iteration) {
        $id = $iteration->id;
      }

      return redirect("/post/$id");
    }

    public function addreply(Request $request)
    {
      $textreply = $request->input('textreply');
      $postid = $request->input('postid');
      $towhoreplytext = $request->input('towhoreplytext');
      $date = now();
      $towhoreplyname = $request->input('towhoreplyname');

      if($towhoreplytext != "0") {
         $DBreplies = DB::table('replies')->take(1)->orderBy('id', 'desc')->get();
        foreach ($DBreplies as $reply) {
          $gettedid = $reply->id;
          $gettedid += 1;
        }
        DB::table('towhoreplies')->insert(['towhotextreply' => $towhoreplytext, 'towhoreplyname' => $towhoreplyname, 'replyid' => $gettedid]);
      }
      $created_at = now();

      if(isset(Auth::user()->name)) {
        $authorid = Auth::user()->id;
      } else $authorid = 0;

      DB::table('posts')->where('id', $postid)->increment('comments');
      DB::table('posts')->where('id', $postid)->update(['updated_at' => $date]);

      DB::table('replies')->insert(['textreply' => $textreply, 'likes' => 0, 'dislikes' => 0, 'created_at' => $created_at,
      'authorid' => $authorid, 'postid' => $postid]);

      return redirect("/post/$postid")->with('status', 'Reply added succesfully!');
    }

    public function report(Request $request) {
        $textreply = $request->input('textreply');
        $authorid = $request->input('authorid');
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
            return view('sites.report', ['DBcategories' => $DBcategories, 'textreply' => $textreply, 'authorid' => $authorid, 'DBactivethreads' => $DBactivethreads, 'DBpoll' => $DBpoll,'allvotes' => $allvotes ]);
        }

        return view('sites.report', ['DBcategories' => $DBcategories, 'textreply' => $textreply, 'authorid' => $authorid, 'DBpoll' => $DBpoll,'allvotes' => $allvotes]);
    }

    public function reportingmethod(Request $request) {
        $textofreporting = $request->input('textofreporting');
        $reason = $request->input('reason');
        $category = $request->input('category');
        $authorid = $request->input('authorid');

        DB::table('reports')->insert(['category' => $category, 'reason' => $reason, 'textofreporting' => $textofreporting, 'authorid' => $authorid]);
        return redirect('/')->with('status', 'Reported succesfully');
    }
    public function changepicture(Request $request) {
        $profilepicture = $request->input('profilepicture');
        $loggeduser = Auth::user()->name;
        $userid = Auth::user()->id;

        if(Input::hasFile('profilepicture')) {
            $file = Input::file('profilepicture');
            $filename = $file->getClientOriginalName();
            $file->move("storage/images/$loggeduser/", $file->getClientOriginalName());
            DB::table('users')->where('id', $userid)->update(['profilepicture' => $filename]);
        }
        return redirect('/myprofile')->with('status', 'Profile picture succesfully updated');
    }

    public function editprofile(Request $request) {
        $username = $request->input('username');
        $email = $request->input('email');
        $beforeuseremail = $request->input('beforeuseremail');
        $beforeusername = $request->input('beforeusername');
        $userid = Auth::user()->id;

        $usercount = 0;
        $emailcount = 0;
        $DBusercheck = DB::table('users')->where('name', $username)->get();
        foreach ($DBusercheck as $usercheck) {
            $usercount++;
        }
        if($usercount != 0 && $username != $beforeusername) {
            return back()->with('usernamesession', 'Username already taken!');
        }

        $DBemailcheck = DB::table('users')->where('email', $email)->get();
        foreach ($DBemailcheck as $emailcheck) {
            $emailcount++;
        }
        if($emailcount != 0 && $email != $beforeuseremail) {
            return back()->with('emailsession', 'Email already taken!');
        }
        DB::table('users')->where('id', $userid)->update(['email' => $email, 'name' => $username]);
        return back()->with('status', 'Profile succesfully updated');
    }
    public function searchingredirect(Request $request){
        $searchtext = $request->input('searchtext');
        return redirect("/post/$searchtext");
    }

}
