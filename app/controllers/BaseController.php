<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function setAjaxResponse($status, $msgKey = '', $data = [])
    {
        $opermsg = getAsysConf('opermsg');

        return [
            'status' => $status,
            'info' => [
                'data' => $data,
                'msg' => isset($opermsg[$msgKey]) ? $opermsg[$msgKey] : implode(' ', $data),
            ]
        ];
    }

}
