<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ajaxmethods extends Controller
{
 public function likingnodislike(Request $request)
 {
   $replyid = $request->input('replyid');
   $authorip = $request->ip();

   DB::table('likes')->insert(['postid' => 0, 'replyid' => $replyid, 'authorip' => $authorip]);
   DB::table('replies')->where('id', $replyid)->increment('likes');
 }


 public function likinganddislike(Request $request)
 {
     $replyid = $request->input('replyid');
     $authorip = $request->ip();

     DB::table('likes')->insert(['postid' => 0, 'replyid' => $replyid, 'authorip' => $authorip]);
     DB::table('replies')->where('id', $replyid)->increment('likes');
     DB::table('replies')->where('id', $replyid)->decrement('dislikes');
     DB::table('dislikes')->where('authorip', $authorip)->where('replyid', $replyid)->delete();
 }

 public function noliking(Request $request) {
     $replyid = $request->input('replyid');
     $authorip = $request->ip();

     DB::table('likes')->where('authorip', $authorip)->where('replyid', $replyid)->delete();
     DB::table('replies')->where('id', $replyid)->decrement('likes');
 }

 public function dislikenolike(Request $request) {
     $replyid = $request->input('replyid');
     $authorip = $request->ip();

     DB::table('dislikes')->insert(['postid' => 0, 'replyid' => $replyid, 'authorip' => $authorip]);
     DB::table('replies')->where('id', $replyid)->increment('dislikes');
 }


 public function dislikeandlike(Request $request) {
     $replyid = $request->input('replyid');
     $authorip = $request->ip();

     DB::table('dislikes')->insert(['postid' => 0, 'replyid' => $replyid, 'authorip' => $authorip]);
     DB::table('replies')->where('id', $replyid)->increment('dislikes');
     DB::table('replies')->where('id', $replyid)->decrement('likes');
     DB::table('likes')->where('authorip', $authorip)->where('replyid', $replyid)->delete();
 }

 public function nodisliking(Request $request) {
     $replyid = $request->input('replyid');
     $authorip = $request->ip();

     DB::table('dislikes')->where('authorip', $authorip)->where('replyid', $replyid)->delete();
     DB::table('replies')->where('id', $replyid)->decrement('dislikes');
 }



 // POST METHODS




    public function postlikingnodislike(Request $request)
    {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('likes')->insert(['replyid' => 0, 'postid' => $replyid, 'authorip' => $authorip]);
        DB::table('posts')->where('id', $replyid)->increment('likes');

        return $replyid;
    }


    public function postlikinganddislike(Request $request)
    {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('likes')->insert(['postid' => $replyid, 'replyid' => 0, 'authorip' => $authorip]);
        DB::table('posts')->where('id', $replyid)->increment('likes');
        DB::table('posts')->where('id', $replyid)->decrement('dislikes');
        DB::table('dislikes')->where('authorip', $authorip)->where('postid', $replyid)->delete();
    }

    public function postnoliking(Request $request) {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('likes')->where('authorip', $authorip)->where('postid', $replyid)->delete();
        DB::table('posts')->where('id', $replyid)->decrement('likes');
    }

    public function postdislikenolike(Request $request) {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('dislikes')->insert(['postid' => $replyid, 'replyid' => 0, 'authorip' => $authorip]);
        DB::table('posts')->where('id', $replyid)->increment('dislikes');
    }


    public function postdislikeandlike(Request $request) {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('dislikes')->insert(['postid' => $replyid, 'replyid' => 0, 'authorip' => $authorip]);
        DB::table('posts')->where('id', $replyid)->increment('dislikes');
        DB::table('posts')->where('id', $replyid)->decrement('likes');
        DB::table('likes')->where('authorip', $authorip)->where('postid', $replyid)->delete();
    }

    public function postnodisliking(Request $request) {
        $replyid = $request->input('replyid');
        $authorip = $request->ip();

        DB::table('dislikes')->where('authorip', $authorip)->where('postid', $replyid)->delete();
        DB::table('posts')->where('id', $replyid)->decrement('dislikes');
    }



    //poll vote
    public function pollvotemethods(Request $request) {
     $radioval = $request->input('radioval');
     $authorip = $request->ip();

     DB::table('pollvotes')->insert(['authorip' => $authorip, 'vote' => $radioval]);
     DB::table('poll')->where('option', $radioval)->increment('votes');
    }

    public function searchermethod(Request $request) {
        $searchingfor = $request->input('searchingfor');

        array_set($titles, 'titlecraetairher020328893t298t328', 32);
        array_set($id, '8768678678', 32);
        array_set($comments, 'nngfngfnfgnecraetairher0298t328', 32);

        $DBposts = DB::table('posts')->where('title', 'like', $searchingfor.'%')->where('whocanseethis', 'Everyone')->select('title', 'comments', 'id')->take(50)->orderBy('viewed', 'desc')->get();
        foreach ($DBposts as $post) {
            array_push($titles, $post->title);
            array_push($comments, $post->comments);
            array_push($id, $post->id);
        }
        array_forget($titles, 'titlecraetairher020328893t298t328');
        array_forget($id, '8768678678');
        array_forget($comments, 'nngfngfnfgnecraetairher0298t328');
        $bigarray = array($titles, $comments, $id);
        return $bigarray;
    }



}
