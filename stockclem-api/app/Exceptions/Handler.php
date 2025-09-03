<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    private $url = [
        'article',
        'category',
        'entry',
        'issue',
        'person',
        'presentation',
        'role',
        'supplier',
        'unit',
        'users'
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(NotFoundHttpException $e, $request) {
            //vamos a añadir de tipo api/ a la lista de urls
            $urlFinal = preg_filter('/^/', 'api/', $this->url);
            //vamos a añadir el sufijo / a la lista de urls
            $urlFinal = preg_filter('/$/', '/*', $urlFinal);
            //vamos ahora a comprobar si la url actual coincide con alguna de las urls de la lista
            if($request->is($urlFinal)) 
            {
                return response()->json(['message' => 'Recurso no encontrado'], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function(MethodNotAllowedHttpException $e, $request){
            return response()->json(['message' => 'Método no permitido'], Response::HTTP_METHOD_NOT_ALLOWED);
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) 
        {
            return response()->json(['message' => 'No tienes permisos para acceder a este recurso'], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof RouteNotFoundException) 
            {
            return response()->json(['message' => 'Debes iniciar sesion'], Response::HTTP_UNAUTHORIZED);
        }
        return parent::render($request, $exception);
    }
}