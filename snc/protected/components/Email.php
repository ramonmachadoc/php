<?php

/**
 *	Classe responsavel pelo envio de email
*/
class Email {

	/**

	 * @$titulo - Ex: "Titulo do email"
	 * @$to     - Ex: array('faxandre@gmail.com' => 'Usuario SGE - AndreGMAIL')
	 * @$view   - Ex: protected/views/email
	 * @textBody - Ex: texto que aparece dentro do corpo do email
	*/

	public static function Send($titulo, $to, $view, $evento, $motivo=null) {

        $SM = Yii::app()->swiftMailer;

        //'email-ssl.com.br', 25
        $Transport = $SM->smtpTransport('smtp.voemap.com.br', 587)
                        ->setUsername('sge@voemap.com.br')
                        ->setPassword('sgeMap!@#2018');     

        $Mailer = $SM->mailer($Transport);

        //renderiza a view (views/email/XXX)
        $view = Yii::app()->controller->renderPartial('application.views.email.'.$view, array('evento' => $evento, 'motivo' => $motivo,), true);
        $Message = $SM
            ->newMessage($titulo)
            ->setFrom(array('sge@voemap.com.br' => 'Sistema SGE'))
            ->setTo($to)
            ->addPart($view, 'text/html');

        $result = $Mailer->send($Message);
		//dbg($view);

        return $result;
	}

}
