<?php
class Utils{

	/**
	 *  SALVA O ARQUIVO NO DIRETORIO UPLOAD
	 */    

	public static function salvaArquivo($fileName, $origem, $_FILES_UPLOAD, $nameInput="arquivo"){
		
		//verifica qual model esta salvanso o arquivo
		if($origem=='Contencao')
			$sufixo = '_CONTENCAO';
		else if($origem=='Planoacao')
			$sufixo = '_PAC';
	
		$nomeArquivo = "";
		for ($i=0; $i < sizeof($_FILES_UPLOAD[$origem]['name'][$nameInput]) ; $i++) { 

			//pegando a extensao
			$extensao =  '.' . substr(strrchr($_FILES_UPLOAD[$origem]['name'][$nameInput][$i], "."), 1);

			//nome do arquivo
			$nome = str_replace('-', '_', $fileName);
			$nome = str_replace('/', '_', $nome);
			$nome = $i."-".$nome;

			//inseri o sufixo no nome do arquivo
			//if($origem=='Contencao' or $origem=='Correcao')
			if($origem=='Contencao' or $origem=='Planoacao')
				$nome = $nome . $sufixo . $extensao;
			else if($origem=='Evento')
				$nome = $nome . $extensao;

			//pega o arquivo temporario
			$arquivo_tmp = $_FILES_UPLOAD[$origem]['tmp_name'][$nameInput][$i];

			//salva arquivo
			if(move_uploaded_file($arquivo_tmp, 'upload'.DIRECTORY_SEPARATOR.$nome)){
				$nomeArquivo .= $nome.";";
			}else{
				throw new RuntimeException('Envio de arquivo falhou!');
			} 

		}

		return $nomeArquivo;
	}



	/** Endode parametros GET */ 

	public static function encodeGET($data) {

		return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($data)))));

	}



	/** Dedode parametros GET */ 

	public static function decodeGET($data) {

		return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($data)))));

	}



	/**

	 *  Converte as datasdo formato americano para brasileiro e vice-versa

	 */ 

	public static function converte($data, $lang='ing') {



		switch ($lang) {

			case 'ing' :

				return date('Y-m-d', strtotime(str_replace('/', '-', $data)));

			break;

			case 'pt'  : 

				return date('d/m/Y', strtotime(str_replace('-', '/', $data)));

			break;

		}



	}



	/*#############################################*/

	/*## Força o download no browser do cliente  ##*/

	/*#############################################*/

	public static function downloadArquivo($nomeArquivo)

	{

		$arquivo = getcwd() . '/upload/' . $nomeArquivo;

		

		header("Content-Type: application/octet-stream");//generico, qualquer arquivo por stream

		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');

		header('Pragma: no-cache');

		header('Expires: 0');

		header("Content-Length: ".filesize($arquivo)); 

		header("Content-Disposition: attachment; filename=".basename($arquivo)); 

		

		readfile($arquivo);

	}





	/**

	 * Compara a 1Âª data passada por parÃ¢metro com a 2Âª segunda

	 *

	 * @access public

	 * @param string $data1 Data no formato (dd/mm/yyyy)

	 * @param string $data2 Data no formato (dd/mm/yyyy). Caso nÃ£o informada,

	 *                      serÃ¡ a data atual

	 * @return integer

	 * - 1 => datas iguais

	 * - 2 => $data1 Ã© posterior Ã  $data2

	 * - 3 => $data1 Ã© anterior Ã  $data2

	 */

	/*public static function comparar($data1, $data2 = '')

	{

		$data1 = trim($data1);

		$data2 = trim($data2);



		// verifica se a 2Âª data foi informada

		if (!strlen($data2)) {

			$data2 = date('d/m/Y');

		}



		// caso as datas estejam no formato datetime, extrai apenas a data

		$data1 = self::extrairDataDeDatetime($data1);

		$data2 = self::extrairDataDeDatetime($data2);



		// verifica se as datas sÃ£o iguais

		if ($data1 == $data2) {

			return 1;

		}



		$_data1 = explode('/', $data1);

		$_data2 = explode('/', $data2);



		$time1 = mktime(0, 0, 0, $_data1['1'], $_data1['0'], $_data1['2']);

		$time2 = mktime(0, 0, 0, $_data2['1'], $_data2['0'], $_data2['2']);



		// verifica se a 1Âª data Ã© maior do que a 2Âª

		return ($time1 > $time2) ? 2 : 3;

	}*/



	/**

	 * Extrai apenas a data de um datetime

	 *

	 * @static

	 * @param string $datetime (dd/mm/yyy hh:mm:ss)

	 * @return string

	 */

	/*public static function extrairDataDeDatetime($datetime)

	{

		// verifica se a data estÃ¡ mesmo no formato timestamp

		if (strlen($datetime) == 19) {

			$data = explode(' ', $datetime);



			return $data['0'];

		} else {

			return $datetime;

		}

	}*/



	/**

	 * Converte datas em diversos formatos

	 *

	 * @static

	 * @param string $data Data que terÃ¡ o formato convertido

	 * @param integer $tipo Tipo de conversÃ£o que serÃ¡ aplicado

	 * - 1 : dd/mm/yyyy >> yyyy-mm-dd

	 * - 2 : yyyy-mm-dd >> dd/mm/yyyy

	 * @return string

	 */

	/*public static function converter($data, $tipo = 1)

	{

		$prefixoErro = 'Problemas na conversÃ£o de datas: ';



		$data = trim($data);



		// verifica se a data foi informada

		if (!mb_strlen($data, 'UTF-8')) {

			throw new CHttpException(404, $prefixoErro . 'data nÃ£o informada');

		}



		// verifica se o tipo de conversÃ£o informado Ã© vÃ¡lido

		if (!is_numeric($tipo)) {

			throw new CHttpException(404, $prefixoErro . 'o tipo de conversÃ£o informado Ã© invÃ¡lido');

		}



		switch ($tipo) {

			case 1 : return substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2); break;



			case 2 : return substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4); break;



			default: throw new CHttpException(404, $prefixoErro . 'o tipo de conversÃ£o nÃ£o existe');

		}

	}*/



	/**

	 * Recebe 2 datas no formato brasileiro (dd/mm/yyyy) e calcula a quantidade

	 * de meses entre as mesmas

	 *

	 * @param string $data1

	 * @param string $data2

	 * @return int

	 */

	/*public static function calcularQuantidadeMesesEntreDuasDatas($data1, $data2)

	{

		if ($data1 && $data2) {

			$vetorData1 = explode('/', $data1);

			$vetorData2 = explode('/', $data2);



			$resultado = ($vetorData2['2'] - $vetorData1['2'])*12;

			if ($vetorData1['1'] > $vetorData2['1']) {

				$resultado -= ($vetorData1['1'] - $vetorData2['1']);

			}

			else if ($vetorData2['1'] > $vetorData1['1']) {

				$resultado += ($vetorData2['1'] - $vetorData1['1']);

			}

		}

		else {

			$resultado = 0;

		}



		return $resultado;

	}*/

	

	/**

	 * Recebe 2 datas no formato brasileiro (dd/mm/yyyy) e calcula a quantidade

	 * de dias entre as mesmas

	 *

	 * @param string $data1

	 * @param string $data2

	 * @return int

	 */

	public function calcularQuantidadeDiasEntreDuasDatas($data1, $data2)

	{

		$partesData1 = explode('/', $data1);

		$data1 = $partesData1['2']. '-' . $partesData1['1']. '-' .  $partesData1['0'];

		$partesData2 = explode('/', $data2);

		$data2 = $partesData2['2']. '-' . $partesData2['1']. '-' .  $partesData2['0'];

		

	

		// Usa a funÃ§Ã£o strtotime() e pega o timestamp das duas datas:

		$time_inicial = strtotime($data1);

		$time_final = strtotime($data2);

	

		// Calcula a diferenÃ§a de segundos entre as duas datas:

		$diferenca = $time_final - $time_inicial; // 19522800 segundos

	

		// Calcula a diferenÃ§a de dias

		$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

	

		// Exibe uma mensagem de resultado:

		return $dias;

		   

	}

	

	

	/**

	 * Recebe 1 data  no formato brasileiro (dd/mm/yyyy) e diminui uma determinada quantidade de meses da mesma 

	 * @param string $data

	 * @param int    $qtdMeses

	 * @return string

	 */

	/*public function diminuirMesesDeUmaData( $data , $qtdMeses )

	{

		$partesData = explode('/', $data);

		$timestamp  = mktime(0, 0, 0, $partesData['1'], $partesData['0'], $partesData['2']);

		$novaData   = date('d/m/Y', strtotime("-".$qtdMeses." month", $timestamp));

		return $novaData;

	}*/





	/**

	 * Recebe 1 data  no formato brasileiro (dd/mm/yyyy) e acrescenta uma determinada quantidade de meses na mesma 

	 * @param string $data

	 * @param int    $qtdMeses

	 * @return string

	 */

	/*public function acrescentaMesesEmUmaData( $data , $qtdMeses )

	{

		$partesData = explode('/', $data);

		$timestamp  = mktime(0, 0, 0, $partesData['1'], $partesData['0'], $partesData['2']);

		$novaData   = date('d/m/Y', strtotime("+".$qtdMeses." month", $timestamp));

		return $novaData;

	}*/



	/**

	 * Recebe 1 data e o formato em que ela é válida e informa se a data é válida de acordo com o formato passado 

	 * @param string $data

	 * @param string $formato

	 * @return boolean

	 */

	/*public static function validateDate($data, $formato = 'Y-m-d H:i:s'){

		$d = DateTime::createFromFormat($formato, $data);

		return $d && $d->format($formato) == $data;

	}*/  

}