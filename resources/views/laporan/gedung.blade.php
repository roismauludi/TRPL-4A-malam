@if ($gedung == 1)
    @include('laporan.gedung1')
@elseif ($gedung == 2)
    @include('laporan.gedung2')
@elseif ($gedung == 3)
    @include('laporan.gedung3')
@endif
