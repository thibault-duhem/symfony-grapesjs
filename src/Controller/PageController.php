<?php

namespace App\Controller;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
	#[Route('/', methods: ['GET', 'HEAD'] )]
	public function index(): Response
    {
        return $this->render('page/index.html.twig', [
        ]);
    }

	#[Route('/page/create', name:'createPage')]
	public function createPage(EntityManagerInterface $entityManager): Response
	{
		$newPage = new Page();
		$entityManager->persist($newPage);
		$entityManager->flush();

		return $this->render('page/create.html.twig', [
			'page'=>$newPage
		]);
	}

	#[Route('/page/edit/{id}', )]
	public function editPage(int $id, ?Page $page): Response
	{
		if (!$page) {
			return $this->redirectToRoute('createPage');
		}
		return $this->render('page/edit.html.twig', [
			'id' =>$id,
			'page'=>$page
		]);
	}

	#[Route('/page/{id}', )]
	public function showPage(?Page $page): Response
	{
		if (!$page) {
			throw $this->createNotFoundException(
				'No page found for id '.$page->getId()
			);
		}
		return $this->render('page/show.html.twig', [
			'page' =>$page
		]);
	}

	#[Route('/api/page/load/{id}', )]
	public function apiPageLoad(Page $page): Response
	{
		if (!$page) {
			throw $this->createNotFoundException(
				'No page found for id '.$page->getId()
			);
		}
		return new JsonResponse($page->getJson(),200,[],true);
	}

	#[Route('/api/page/store/{id}', )]
	public function apiPageStore(EntityManagerInterface $entityManager, Request $request, int $id): Response
	{
		$page = $entityManager->getRepository(Page::class)->find($id);
		if (!$page) {
			throw $this->createNotFoundException(
				'No page found for id '.$page->getId()
			);
		}
		$page->setJson($request->getContent());
		$content=json_decode($request->getContent());
		$page->setHtml($content->html);
		$page->setCss($content->css);
		$entityManager->persist($page);
		$entityManager->flush();
		return new Response("",200);
	}

}
