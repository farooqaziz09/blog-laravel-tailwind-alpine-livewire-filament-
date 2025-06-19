<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;

    #[Rule('required|min:10|max:250')]
    public $comment;

    public function postComment()
    {
        if (auth()->guest()) {
            return;
        }
        // $this->validateOnly('comment');
        $comment = $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
        ]);
        $this->reset('comment');
    }

    #[Computed()]
    public function comments()
    {
        return $this->post?->comments()->with('users')->latest()->paginate(5);
    }
    // livwire autoload post-comment view so we can comment this
    // public function render()
    // {
    //     return view('livewire.post-comments');
    // }
}
