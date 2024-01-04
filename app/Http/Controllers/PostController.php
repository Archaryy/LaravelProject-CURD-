<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function createPost(Request $request) {
        if(auth()->user()->check()) {
            $incoming_fields = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);
    
            $incoming_fields['title'] = strip_tags($incoming_fields['title']);
            $incoming_fields['body'] = strip_tags($incoming_fields['body']);
            $incoming_fields['user_id'] = auth()->id();
            Post::create($incoming_fields);  
        }
        
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incoming_fields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incoming_fields['title'] = strip_tags($incoming_fields['title']);
        $incoming_fields['body'] = strip_tags($incoming_fields['body']);

        $post->update($incoming_fields);
        return redirect('/');
    }

    public function deletePost(Post $post) {
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        
        return redirect('/');
    }
}
