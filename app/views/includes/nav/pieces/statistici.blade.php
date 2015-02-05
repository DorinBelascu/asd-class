  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Statistici <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      <li><a href=" {{ URL::route('statistici-note') }}">Note</a></li>
      <li class="divider"></li>
      <li><a href=" {{ URL::route('statistici-absente') }}">Absente</a></li>
      <li class="divider"></li>
      <li><a href=" {{ URL::route('statistici-medii') }}">Medii</a></li>
      <li class="divider"></li>
      <li><a href=" {{ URL::route('statistici-teze') }}">Teze</a></li>
    </ul>
  </li>