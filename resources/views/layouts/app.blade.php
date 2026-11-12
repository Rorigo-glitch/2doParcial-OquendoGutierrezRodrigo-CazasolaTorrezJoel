<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('titulo', 'Inventario')</title>
<style>
body{font-family:system-ui,sans-serif;margin:0;background:#f5f6fa;color:#1f2937}
nav{display:flex;gap:1rem;align-items:center;background:#1e3a5f;color:#fff;padding:.7rem 1.2rem}
nav a{color:#fff;text-decoration:none}.sp{flex:1}nav form{margin:0}
main{max-width:980px;margin:1.5rem auto;padding:0 1rem}
table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:.5rem;border-bottom:1px solid #e5e7eb;text-align:left}
.cards{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:1rem}
.card{flex:1;min-width:180px;background:#fff;padding:1rem;border-radius:8px}
.card b{display:block;font-size:1.6rem}
.msg{padding:.6rem;border-radius:6px;margin:.3rem 0}.ok{background:#dcfce7}.err{background:#fee2e2}
.low{color:#b91c1c;font-weight:700}
button,.btn{background:#1e3a5f;color:#fff;border:0;padding:.4rem .8rem;border-radius:6px;cursor:pointer;text-decoration:none;font-size:.9rem}
.danger{background:#b91c1c}.gray{background:#6b7280}
input,select,textarea{padding:.35rem}
.bar{display:flex;gap:.5rem;flex-wrap:wrap;align-items:center;margin-bottom:1rem}
.inline{display:inline-flex;gap:.3rem;margin:0}.inline input{width:4.5rem}
</style>
</head>
<body>
<nav>
  <b>🏪 Inventario</b>
  @auth
    <a href="{{ route('panel') }}">Panel</a>
    <a href="{{ route('productos.index') }}">Productos</a>
    <span class="sp"></span>
    {{ auth()->user()->email }}
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="gray">Salir</button></form>
  @else
    <span class="sp"></span>
    <a href="{{ route('login') }}">Entrar</a>
    <a href="{{ route('register') }}">Registrarse</a>
  @endauth
</nav>
<main>
  @if (session('ok'))<p class="msg ok">{{ session('ok') }}</p>@endif
  @if (session('error'))<p class="msg err">{{ session('error') }}</p>@endif
  @foreach ($errors->all() as $e)<p class="msg err">{{ $e }}</p>@endforeach
  @yield('contenido')
</main>
</body>
</html>
