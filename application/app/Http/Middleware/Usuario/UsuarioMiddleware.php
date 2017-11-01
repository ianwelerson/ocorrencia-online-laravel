<?php

namespace OcorrenciaOnline\Http\Middleware\Usuario;

use Closure;
use View;
use OcorrenciaOnline\Http\Controllers\Usuario\UsuarioController;

class UsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // Verifica se existe um usuário autenticado
      if(auth()->check() == true) {
        // Cria uma instância do Controller de Usuario
        $usuarioController = new UsuarioController();
        // Chama a function para pegar os dados do usuário
        $user = $usuarioController->getUserData(auth()->user()->USUARIO_COD);
        // Verifica se foram obtidas informações do usuário
        if($user == false) {
          // Se a variavel $user estiver vazia é executado o logout e exibido uma mensagem de erro
          $usuarioController->logout()
            ->with('mensagem_erro', 'Houve um erro, tente novamente');
        } else {
          // Se existerem dados na variavel $user é feito o compartilhamento dele com todas as views
          View::share([
            // 'isLogged' com a informação se existe usuário logado
            'isLogged' => true,
            // 'usuario' com os dados do usuário
            'usuario' => $user,
          ]);
        }
      } else {
        // Compartilha duas informações para todas as views
        View::share([
          // 'isLogged' informando que não está logado
          'isLogged' => false
        ]);
      }
      return $next($request);
    }
}
