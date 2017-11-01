<?php

namespace OcorrenciaOnline\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfVisitor
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null)
  {
    // Verifica se o usuário está autenticado
    if (!Auth::check()) {
      // Se estiver é redirecionado para a tela de "/meu-cadastro"
      return redirect('/acessar');
    }

    return $next($request);
  }
}
