<?php namespace maze\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
	];

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if(env('APP_DEBUG', true))
		{
			Log::debug("YES, this is data");
			if($request->wantsJson())
			{
				var_dump($e);
				return response()->json($e->getStatusCode());
			}
			else 
			{
				return parent::render($request, $e);
			}
		}

		if($this->isHttpException($e))
		{
			if($e->getStatusCode() == 404)
			{
				if($request->wantsJson())
				{
					return response()->json("Page not found");
				}
				else 
				{
					return response()->view('errors.404');
				}
			}
			elseif($e->getStatusCode() == 503)
			{
				return response()->view('errors.503');
			}
			else
			{
				return response()->view('errors.internal');
			}
		}
		if(class_basename($e) == 'ModelNotFoundException')
		{
			return response()->view('errors.404');
		}
		else
		{
			return response()->view('errors.internal');
		}
	}

}
