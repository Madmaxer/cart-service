<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

class NegotiateContent
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->getMethod(), ['POST', 'PATCH'], true) && !$request->isJson()) {
            throw new UnsupportedMediaTypeHttpException('Unsupported Media Type');
        }

        if (!$request->wantsJson()) {
            throw new NotAcceptableHttpException('Not Acceptable');
        }

        return $next($request);
    }
}
