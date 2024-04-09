<?php

namespace App\Admin;

use App\Entity\Category;
use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        // ... configure $form
        $form
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'by_reference' => false, // important to call addCategory and removeCategory in ProductEntity
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name')
            ->add('categories', null, [
                'label' => 'Category', // Set the label here
                'field_type' => EntityType::class,
                'field_options' => [
                    'class' => Category::class,
                    'choice_label' => 'name',
                ],
            ])
        ;
    }

    protected function configureListFields(ListMapper $list): void // config in list view
    {
        // ... configure $list
        //        addIdentifier is a shortcut to add a field to the list view and able to click to view details
        $list
            ->addIdentifier('name')
            ->add('price')
            ->add('categories');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('name')
            ->add('price')
            ->add('inStock')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('categories');
    }

    public function toString(object $object): string
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Product';
    }
}
