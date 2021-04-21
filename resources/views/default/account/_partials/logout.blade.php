<div class="container_sd">
  <form id="frm-logout" action="{{ route('logout') }}" method="post" style="display: inline;">
    @csrf
    <a href="javascript:void()" class="list-group-item list-group-item-action" onclick="document.getElementById('frm-logout').submit();">Cerrar sesión <img src="{{ asset('img/icons/icn_login.svg') }}" alt=""></a>
  </form>
</div>