<?php

namespace App\Observers;

use App\Post;
use App\Traits\HandleImages;
use Illuminate\Support\Str;

class PostObserver
{
    use HandleImages;

    /**
     * Handle the post "creating" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        if (!isset($post['slug'])) {
            $post['slug'] = Str::slug($post['title']);
        }
        
        if (isset($post['image']) && $post['image'] instanceof \Illuminate\Http\UploadedFile) {
            $post['image'] = $this->uploadImage($post['image']);
        }
    }

    /**
     * Handle the post "updating" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {   
        if (isset($post['title']) && !isset($post['slug'])) {
            $post['slug'] = Str::slug($post['title']);
        }
    }

    /**
     * Handle the post "deleting" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleting(Post $post)
    {
        $this->deleteImage($post->image);
    }
}
