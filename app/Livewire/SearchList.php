<?php

namespace App\Livewire;

use Livewire\Component;

class SearchList extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        $this->dispatch('search', search: $this->search);
    }
    public function render()
    {
        return view('livewire.search-list');
    }
}
