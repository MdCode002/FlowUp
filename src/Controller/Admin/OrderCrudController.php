<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions):Actions
    {
        return $actions
        ->add('index','detail');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt',"Passée le")->setFormTypeOptions([

                'html5' => true,
                
                'years' => range(date('Y'), date('Y') + 5),
                
                'widget' => 'single_text',
                
                'input' => 'datetime_immutable',
            
                ]),
            TextField::new('user.getFullName',"Utilisateur"),
            // TextareaField::new('description'),
            MoneyField::new('total')->setCurrency('XOF'),
            BooleanField::new('isPaid',"Payée")
        ];
    }
    
}
