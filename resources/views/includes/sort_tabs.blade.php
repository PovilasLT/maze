<ul class="nav nav-tabs">
  <li role="presentation"@if($sort == 'populiariausi' || !$sort) class="active" @endif><a href="?rodyti=populiariausi">Populiariausi</a></li>
  <li role="presentation"@if($sort == 'naujausi') class="active" @endif><a href="?rodyti=naujausi">Naujausi</a></li>
  <li role="presentation"@if($sort == 'naujausi-pranesimai') class="active" @endif><a href="?rodyti=naujausi-pranesimai">Naujausi Pranešimai</a></li>
  <li role="presentation"@if($sort == 'mano-turinys') class="active" @endif><a href="?rodyti=mano-turinys">Mano Turinys</a></li>
</ul>