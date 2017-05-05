<?php namespace DPSEI\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);

		if(!Config::get('app.debug')) {
			$this->sendErrorEmail(Request::instance(), $e);
		}
	}

	 /**
     * Send an error email
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return void
     */
    protected function sendErrorEmail($request, $e)
    {
        $code = $this->errorCodeFromException($e);

        $data = [
            'exception' 	=> (string)$e,
            'code'      	=> $code,
            'url'       	=> $request->fullUrl(),
            'loggedIn'  	=> \Sentinel::check(),
            'remoteIP'  	=> $request->getClientIp(),

			'refferalurl'   => \URL::previous(),
			'WEB_DOMAIN'    => \Setting::get('WEB_DOMAIN'),
			'APP_NAME'      => \Setting::get('APP_NAME'),
			'APP_VERSION'   => \Setting::get('APP_VERSION').' '.Setting::get('APP_VERSION_TYPE'),
        ];

        \Mail::send('emails.error', $data, function($message) use ($code)
        {
            $message->to(\Setting::get('MAIL_DEBUG_EMAIL'), \Setting::get('MAIL_DEBUG_EMAIL_NAME'));
            $message->subject(\Setting::get('APP_NAME')." Error on ".\Setting::get('WEB_DOMAIN'));
        }); 
    }


    /**
     * Get the exception code
     *
     * @param \Exception $e
     * @return string
     */
    protected function errorCodeFromException(Exception $e)
    {
        if ($this->isHttpException($e)) {
            return $e->getStatusCode();
        }
        return $e->getCode();
    }


	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if($e instanceof NotFoundHttpException)
		{
			return view('errors.404');
		}
		return parent::render($request, $e);

		/*if($e instanceof NotFoundHttpException)
		{
			return view('errors.404');
		}
		if (view()->exists('errors.'.$e->getStatusCode()))
        {
			return parent::render($request, $e);
		} else {
			return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
		}*/
	}

}
