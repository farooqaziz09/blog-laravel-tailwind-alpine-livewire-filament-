<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Features\SupportPagination\HandlesPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';
    #[Url()]
    public $search = '';
    #[Url()]
    public $category = '';
    #[Url()]
    public $popular = '';

    public function setSort($sort)
    {
        $this->sort = $sort === 'desc' ? 'desc' : 'asc';
    }
    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    #[Computed()]
    public function posts()
    {

        $q = Post::published()
            ->orderBy('published_at', $this->sort)
            ->with('author', 'categories')
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->withCount('likes')
                    ->orderBy('likes_count', 'desc');
            })
            ->where('title', 'like', "%{$this->search}%")
            // ->toSql();
            ->paginate(10);
        return $q;
    }
    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }
    #[Computed()]
    public function activeCategory()
    {
        if ($this->category === null || $this->category === '') {
            return null;
        }
        return Category::where('slug', $this->category)->first() ?? false;
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
