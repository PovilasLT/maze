<?php namespace maze\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException',
		'Illuminate\Database\Eloquent\ModelNotFoundException',
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
		if($this->isHttpException($e))
		{
			if($e->getStatusCode() == 404)
			{
				return response()->view('errors.404');
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
