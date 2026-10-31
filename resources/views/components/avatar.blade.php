@props(['nama', 'foto' => null, 'large' => false])
@if($foto)
  <img src="{{ asset('storage/'.$foto) }}" alt="{{ $nama }}" class="avatar {{ $large ? 'avatar-lg' : '' }}">
@else
  <span class="avatar {{ $large ? 'avatar-lg' : '' }}">{{ strtoupper(mb_substr($nama, 0, 1)) }}</span>
@endif
