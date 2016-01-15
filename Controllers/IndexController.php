<?php
namespace MadLab\Controller;

use MadLab\Cornerstone\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends Controller
{
	function getIndex(Request $request, Response $response, $params = [])
	{
		$content = $this->render('index.twig', ['name' => '1.0']);
		$response->setContent($content);
		return $response;
	}
}