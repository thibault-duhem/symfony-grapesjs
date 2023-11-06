<?php

namespace App\Controller;

use App\Entity\Page;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAdminController extends CRUDController
{
	public function createAction(Request $request): RedirectResponse
	{
		$page = $this->admin->getNewInstance();
		$page->setTitle("Entrez un titre");
		$this->admin->create($page);

		return new RedirectResponse($this->admin->generateUrl('edit',['id'=>$page->getId()]));
	}

}
