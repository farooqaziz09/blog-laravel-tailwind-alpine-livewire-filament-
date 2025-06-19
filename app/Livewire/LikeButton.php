<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{
    #[Reactive]
    public Post $post;
    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect(route('login'), true);
        }
        $user = auth()->user();
        $hasLiked = $user->hasLiked($this->post);
        if ($hasLiked) {
            $user->likes()->detach($this->post);
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Post unliked',
                position: 'center',
                timer: 1500
            );
            return;
        }
        $user->likes()->attach($this->post);
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Post Liked',
            position: 'center',
            timer: 1500

        );
    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
