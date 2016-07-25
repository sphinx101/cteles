<?php namespace cteles\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Route;
use Laracasts\Flash\Flash;


class RolPermisoMiddleware {
    protected $requiereRole=false;
    protected $roles;
    protected $requierePermiso=false;
    protected $permisos;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var Route
     */
    private $route;

    /**
     * @param Guard $auth
     * @param Route $route
     */
    public function __construct(Guard $auth,Route $route){

        $this->auth = $auth;
        $this->route = $route;

        /* si en la ruta se definen roles */
        if(isset($route->getAction()['roles'])){
            $this->requiereRole=true;
            $this->roles=$route->getAction()['roles'];
        }

        /* si en la ruta se definen permisos */
        if(isset($route->getAction()['permisos'])){
            $this->requierePermiso=true;
            $this->permisos=$route->getAction()['permisos'];
        }

    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

        if($this->requiereRole){
            return $this->analizaRoles($request,$next);
        }elseif($this->requierePermiso){
            return $this->analizaPermisos($request,$next);
        }else{
            return $next($request);
        }


	}

    /**
     * @param $request
     * @param $next
     */
    protected function analizaRoles($request,$next){


        if($this->auth->check()) {
            if ($this->auth->user()->hasRole($this->roles)) {
                if ($this->requierePermiso) {
                    return $this->analizaPermisos($request, $next);
                }
                return $next($request);
            } else {
                Flash::warning('Sus privilegios actules no permiten tener acceso a este recurso. Pongase en contacto con el administrador del sistema');
                return redirect()->to('/home');
            }
        }else{
            return redirect()->to('/auth/login');
        }
    }

    protected function analizaPermisos($request,$next){
        if($this->auth->check()) {

            if ($this->auth->user()->can($this->permisos)) {
                return $next($request);
            } else {
                Flash::warning('No cuenta con los permisos necesarios para tener acceso a este recurso. Pongase en contacto con el administrador del sistema');
                return redirect()->to('/home');
            }
        }else{
            return redirect()->to('/auth/login');
        }

    }

}
