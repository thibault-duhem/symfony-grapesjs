<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\TemplateType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageAdmin extends AbstractAdmin
{
	protected function configureFormFields(FormMapper $form): void
	{
		$form->add('title');

		$form
			->add('editor', TemplateType::class, [
				'template'   => 'page/adminEdit.html.twig',
                  'parameters' => [
					'id' => $this->getSubject()->getId(),
				  ],
              ]);
	}

	protected function configureDatagridFilters(DatagridMapper $datagrid): void
	{
		$datagrid->add('id');
		$datagrid->add('title');

	}

	protected function configureListFields(ListMapper $list): void
	{
		$list->addIdentifier('id');
		$list->addIdentifier('title');
		$list->add(ListMapper::NAME_ACTIONS, null, [
			'actions' => [
				'show' => [],
				'edit' => [
					// You may add custom link parameters used to generate the action url
					'link_parameters' => [
						'full' => true,
					]
				],
				'delete' => [],
			]
		]);
	}

	protected function configureShowFields(ShowMapper $show): void
	{
		$show->add('title');
		$show
			->add('json', TemplateType::class, [
				'template'   => 'page/adminShow.html.twig',
				'parameters' => [
					'id' => $this->getSubject()->getId(),
				],
			]);
	}
}