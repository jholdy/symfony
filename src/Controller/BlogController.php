<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
  /**
   * @Route("/{page}", name="blog_list", defaults={"page": 1}, requirements={"page"="\d+"})
   */
  public function index($page, Request $requet)
  {
    $limit = $requet->get('limit', 10);
    $repository = $this->getDoctrine()->getRepository(BlogPost::class);
    $items = $repository->findAll();
    return $this->json($items);
  }

  /**
   * @Route("/post/{id}", name="blog_by_id", methods={"GET"})
   * @ParamConverter("post", class="App:BlogPost")
   */
  public function post($post)
  {
    return $this->json($post);

  }

  /**
   * @Route("/post/{slug}", name="blog_by_slug", methods={"POST"})
   * @ParamConverter("post", class="App:BlogPost", options={"mapping": {"slug": "slug"}})
   */
  public function postBySlug($post)
  {
    return $this->json($post);
  }

  /**
   * @Route("/add", name="blog_add", methods={"POST"})
   */
  public function add(Request $request)
  {
    $serializer = $this->get('serializer');

    $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');

    $em  = $this->getDoctrine()->getManager();
    $em->persist($blogPost);
    $em->flush();

    return $this->json($blogPost);
  }
}
