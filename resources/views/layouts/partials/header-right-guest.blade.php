<div id="header-right" class="flex items-center md:space-x-6">
  <div class="flex space-x-5">
      
      <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
        {{ __('Login') }}
      </x-nav-link>
      <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
        {{ __('Register') }}
      </x-nav-link>
  </div>
</div>