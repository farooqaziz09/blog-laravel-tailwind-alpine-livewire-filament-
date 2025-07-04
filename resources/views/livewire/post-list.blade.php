<div class=" px-3 lg:px-7 py-6">
  <div class="flex justify-between items-center border-b border-gray-100">
    <div class="flex justify-between items-center border-b border-gray-100">
      <div class="text-gray-600">
        @if ($this->activeCategory || $search)
          <button class="gray-500 text-xs mr-3" wire:click="clearFilters()">X</button>
        @endif
        @if ($this->activeCategory)
          <x-badge wire:navigate href="{{ route('post.index', ['category' => $this->activeCategory->slug]) }}"
            :bgColor="$this->activeCategory->bg_color" :textColor="$this->activeCategory->text_color">{{ $this->activeCategory->title }}</x-badge>
        @endif
        @if ($search)
          Containing: {{ $search }} <br />
        @endif

      </div>
    </div>
    <div id="filter-selector" class="flex items-center space-x-4 font-light ">
      <x-checkbox wire:model.live="popular"/>
      <x-label>Popular</x-label>
      <button class="{{ $sort === 'asc' ? 'border-b border-gray-700 text-gray-900' : 'text-gray-500' }}  py-4 "
        wire:click="setSort('asc')">Latest</button>
      <button class="{{ $sort === 'desc' ? 'border-b border-gray-700 text-gray-900' : 'text-gray-500' }}  py-4 "
        wire:click="setSort('desc')">Oldest</button>
    </div>
  </div>
  <div class="py-4">
    @foreach ($this->posts as $post)
      <x-posts.post-item :key="$post->id" :post="$post" />
    @endforeach
  </div>

  <div class="my-3">
    {{ $this->posts->links() }}
  </div>
</div>
