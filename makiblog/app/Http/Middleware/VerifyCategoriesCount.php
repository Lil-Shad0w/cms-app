<?php

namespace App\Http\Middleware;
use App\Category;
use Closure;

class VerifyCategoriesCount
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
        if(Category::all()->count() == 0){
            return redirect(route('categories.create'))->with('error', 'Morate kreirati kategoriju kako bi ste kreirali post');
        }

        return $next($request);
    }
}
