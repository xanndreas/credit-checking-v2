<ul class="menu-sub">
    @if (isset($menu))
        @foreach ($menu as $submenu)

            {{-- active menu method --}}
            @php
                $activeClass = null;
                $active = $configData["layout"] === 'vertical' ? 'active open':'active';
                $currentRouteName =  Route::currentRouteName();

                if ($currentRouteName === $submenu->slug) {
                    $activeClass = 'active';
                }
                elseif (isset($submenu->submenu)) {
                    if (gettype($submenu->slug) === 'array') {
                    foreach($submenu->slug as $slug){
                        if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                            $activeClass = $active;
                        }
                    }
                    }
                    else{
                        if (str_contains($currentRouteName,$submenu->slug) and strpos($currentRouteName,$submenu->slug) === 0) {
                            $activeClass = $active;
                        }
                    }
                }
            @endphp

            <li class="menu-item {{$activeClass}} @isset($submenu->permission) @cannot($submenu->permission) d-none @endcannot @endisset@">
                <a href="{{ isset($submenu->slug) ? route($submenu->slug) : 'javascript:void(0)' }}"
                   class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                   @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
                    @if (isset($submenu->icon))
                        <i class="{{ $submenu->icon }}"></i>
                    @endif
                    <div>{{ isset($submenu->name) ? trans($submenu->name) : '' }}</div>
                </a>

                {{-- submenu --}}
                @if (isset($submenu->submenu))
                    @include('layouts.sections.menu.submenu',['menu' => $submenu->submenu])
                @endif
            </li>
        @endforeach
    @endif
</ul>
