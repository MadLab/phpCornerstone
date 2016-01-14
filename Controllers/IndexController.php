<?php
namespace MadLab\Controller;

use MadLab\Cornerstone\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use User;

class IndexController extends Controller
{
	function getIndex(Request $request, Response $response, $params = [])
	{

		$user = new User($this->require('pdo'));
		$users = $user->getActive();


		$users[474]->campaign = 'test';
		$users[474]->update();

		//$users[474]->registerDat = '32';

		$content = $this->render('index', ['name'=>'test']);
		$response->setContent($content);
		return $response;

	}
}