<nav class="nav">
    <div class="top-grid">
        <div></div>
        <div class="menu">

            {{-- CAMISETAS 25/26 (Ligas) --}}
            @php $ligas = $allCategories->where('grupo', 'Ligas'); @endphp
            @if($ligas->count() > 0)
            <details class="dd">
                <summary>CAMISETAS 25/26 <span class="chev">▾</span></summary>
                <div class="dd-panel">
                    @foreach($ligas as $cat)
                        <a href="{{ route('categoria', $cat->slug) }}">{{ $cat->nombre }}</a>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- SELECCIONES --}}
            @php $selecciones = $allCategories->where('grupo', 'Selecciones'); @endphp
            @if($selecciones->count() > 0)
            <details class="dd">
                <summary>SELECCIONES <span class="chev">▾</span></summary>
                <div class="dd-panel">
                    @foreach($selecciones as $cat)
                        <a href="{{ route('categoria', $cat->slug) }}">{{ $cat->nombre }}</a>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- RETRO --}}
            @php $retro = $allCategories->where('grupo', 'Retro'); @endphp
            @if($retro->count() > 0)
            <details class="dd">
                <summary>RETRO <span class="chev">▾</span></summary>
                <div class="dd-panel">
                    @foreach($retro as $cat)
                        <a href="{{ route('categoria', $cat->slug) }}">{{ $cat->nombre }}</a>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- TALLA NIÑO --}}
            @php $tallaNino = $allCategories->where('slug', 'tallanino')->first(); @endphp
            @if($tallaNino)
                <a href="{{ route('categoria', 'tallanino') }}">TALLA NIÑO</a>
            @endif

            {{-- PANTALONES --}}
            @php $pantalones = $allCategories->whereIn('slug', ['cortos', 'largos']); @endphp
            @if($pantalones->count() > 0)
            <details class="dd">
                <summary>PANTALONES <span class="chev">▾</span></summary>
                <div class="dd-panel">
                    @foreach($pantalones as $cat)
                        <a href="{{ route('categoria', $cat->slug) }}">{{ $cat->nombre }}</a>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- BOTAS --}}
            @php $botas = $allCategories->where('slug', 'botas')->first(); @endphp
            @if($botas)
                <a href="{{ route('categoria', 'botas') }}">BOTAS</a>
            @endif

            {{-- BUFANDAS --}}
            @php $bufandas = $allCategories->whereIn('slug', ['clubes', 'selecciones_bufandas', 'retro_bufandas']); @endphp
            @if($bufandas->count() > 0)
            <details class="dd">
                <summary>BUFANDAS <span class="chev">▾</span></summary>
                <div class="dd-panel">
                    @foreach($bufandas as $cat)
                        <a href="{{ route('categoria', $cat->slug) }}">{{ $cat->nombre }}</a>
                    @endforeach
                </div>
            </details>
            @endif

        </div>
    </div>
</nav>