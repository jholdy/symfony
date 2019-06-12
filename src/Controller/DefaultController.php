<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{
  /**
   * @Route("/", name="default_index")
   */
  public function index()
  {
    $a = 'sdasdad';
    return phpinfo();
  }

  /**
   * @Route("/teste", name="default_teste")
   */
  public function teste()
  {
    $a = 'sdasdad';
    return $a;
  }
}
