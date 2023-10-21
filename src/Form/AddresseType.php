<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,['label'=> "Quel nom souhaitez-vous sonner a votre addresse ?","attr"=>[
                "placeholder" => "Exemple : adresse 1",
            ]])
            ->add('prenom', TextType::class,['label'=> "Prenom","attr"=>[
                "placeholder" => "Entrer votre prenom",
            ]])
            ->add('nom', TextType::class,['label'=> "Nom","attr"=>[
                "placeholder" => "Entrer votre nom",
            ]])
            ->add('addresse', TextType::class,['label'=> "Addresse","attr"=>[
                "placeholder" => "Entrer votre Adresse",
            ]])
            ->add('infoSup', TextType::class,['label'=> "Information supplémentaire","required" =>false,"attr"=>[
                "placeholder" => "Information supplémentaire (facultatif)",
                
            ]])
          
            ->add('ville', ChoiceType::class, [
                'label' => 'Zone',
                'choices' => [
                    'Sélectionner' => null,
                    'Amitie 1' => 'Amitie 1',
                    'Amitie 2' => 'Amitie 2',
                    'Amitie 3' => 'Amitie 3',
                    'Bambilor' => 'Bambilor',
                    'Bargny' => 'Bargny',
                    'Bel Air' => 'Bel Air',
                    'Bop' => 'Bop',
                    'Camberene' => 'Camberene',
                    'Castor' => 'Castor',
                    'Centenaire' => 'Centenaire',
                    'Cite Keur Damel' => 'Cite Keur Damel',
                    'Cite Keur Gorgui' => 'Cite Keur Gorgui',
                    'Colobane' => 'Colobane',
                    'Dalifort' => 'Dalifort',
                    'Deni Biram Ndao' => 'Deni Biram Ndao',
                    'Derkle' => 'Derkle',
                    'Diamagueune' => 'Diamagueune',
                    'Diamalaye' => 'Diamalaye',
                    'Diamniadio' => 'Diamniadio',
                    'Dieuppeul' => 'Dieuppeul',
                    'Dogar' => 'Dogar',
                    'Fann' => 'Fann',
                    'Fann Hock' => 'Fann Hock',
                    'Fann Residence' => 'Fann Residence',
                    'Fass' => 'Fass',
                    'Fass Paillote' => 'Fass Paillote',
                    'Fenetre Mermoz' => 'Fenetre Mermoz',
                    'Golf' => 'Golf',
                    'Grand Dakar' => 'Grand Dakar',
                    'Grand Mbao' => 'Grand Mbao',
                    'Grand Medine' => 'Grand Medine',
                    'Grand Yoff' => 'Grand Yoff',
                    'Guediawaye' => 'Guediawaye',
                    'Guediawaye - Cite Gadaye' => 'Guediawaye - Cite Gadaye',
                    'Guediawaye - P.A.I' => 'Guediawaye - P.A.I',
                    'Gueule Tapee' => 'Gueule Tapee',
                    'H.L.M (1-2-3-4-5-6)' => 'H.L.M (1-2-3-4-5-6)',
                    'H.L.M Patte d\' Oie' => 'H.L.M Patte d\' Oie',
                    'Hamo (1-2-3-4-5-6)' => 'Hamo (1-2-3-4-5-6)',
                    'Hann Bel Air' => 'Hann Bel Air',
                    'Hann Marinas' => 'Hann Marinas',
                    'Hann Mariste' => 'Hann Mariste',
                    'HLM Grand Medine' => 'HLM Grand Medine',
                    'HLM Grand Yoff' => 'HLM Grand Yoff',
                    'HLM Las Palmas' => 'HLM Las Palmas',
                    'Keur Massar' => 'Keur Massar',
                    'Keur Massar Diakhaye' => 'Keur Massar Diakhaye',
                    'Keur Massar Parcelles Assainies' => 'Keur Massar Parcelles Assainies',
                    'Keur Massar Village' => 'Keur Massar Village',
                    'Keur Mbaye Fall' => 'Keur Mbaye Fall',
                    'Keur Ndiaye Lo' => 'Keur Ndiaye Lo',
                    'Kounoune' => 'Kounoune',
                    'Lac Rose' => 'Lac Rose',
                    'Liberté 6 - Cité Sipres' => 'Liberté 6 - Cité Sipres',
                    'Liberté 6 - Cité Sonatel' => 'Liberté 6 - Cité Sonatel',
                    'Liberte 6 extension' => 'Liberte 6 extension',
                    'Malika' => 'Malika',
                    'Mamelle' => 'Mamelle',
                    'Maristes' => 'Maristes',
                    'Mbao - Cité Sipres' => 'Mbao - Cité Sipres',
                    'Medina' => 'Medina',
                    'Medina Gounass' => 'Medina Gounass',
                    'Mermoz' => 'Mermoz',
                    'Ndiakhirate' => 'Ndiakhirate',
                    'Ngor - Almadies' => 'Ngor - Almadies',
                    'Niaga' => 'Niaga',
                    'Nonedelivery' => 'Nonedelivery',
                    'Nord foire' => 'Nord foire',
                    'Ouakam' => 'Ouakam',
                    'Ouest foire' => 'Ouest foire',
                    'Parcelles - Cite Fadia' => 'Parcelles - Cite Fadia',
                    'Parcelles - Cite Nations Unies' => 'Parcelles - Cite Nations Unies',
                    'Parcelles Assainies' => 'Parcelles Assainies',
                    'Patte D oie' => 'Patte D oie',
                    'Patte D oie builders' => 'Patte D oie builders',
                    'Petit Mbao' => 'Petit Mbao',
                    'Pikine' => 'Pikine',
                    'Pikine Cité Lobatfall' => 'Pikine Cité Lobatfall',
                    'Pikine Guinaw Rail' => 'Pikine Guinaw Rail',
                    'Pikine Icotaf' => 'Pikine Icotaf',
                    'Pikine Khourounar' => 'Pikine Khourounar',
                    'Pikine Nord' => 'Pikine Nord',
                    'Pikine Rue 10' => 'Pikine Rue 10',
                    'Pikine Tally Bou Bess' => 'Pikine Tally Bou Bess',
                    'Pikine Tally Bou Mak' => 'Pikine Tally Bou Mak',
                    'Plateau' => 'Plateau',
                    'Point E' => 'Point E',
                    'Rue 10' => 'Rue 10',
                    'Rufisque' => 'Rufisque',
                    'Sangalkam' => 'Sangalkam',
                    'Scat Urbam' => 'Scat Urbam',
                    'Sebikotane' => 'Sebikotane',
                    'Sendou' => 'Sendou',
                    'Sicap Baobab' => 'Sicap Baobab',
                    'Sicap fass Mbao' => 'Sicap fass Mbao',
                    'Sicap Karack' => 'Sicap Karack',
                    'Sicap Liberté 1' => 'Sicap Liberté 1',
                    'Sicap Liberté 2' => 'Sicap Liberté 2',
                    'Sicap Liberté 3' => 'Sicap Liberté 3',
                    'Sicap Liberté 4' => 'Sicap Liberté 4',
                    'Sicap Liberté 5' => 'Sicap Liberté 5',
                    'Sicap Liberté 6' => 'Sicap Liberté 6',
                    'Sicap Sacre Coeur 1' => 'Sicap Sacre Coeur 1',
                    'Sicap Sacre Coeur 2' => 'Sicap Sacre Coeur 2',
                    'Sicap Sacre Coeur 3' => 'Sicap Sacre Coeur 3',
                    'Sicap Sacre coeur 3 Extension' => 'Sicap Sacre coeur 3 Extension',
                    'Soprim' => 'Soprim',
                    'Sotrac Mermoz' => 'Sotrac Mermoz',
                    'Sud Foire' => 'Sud Foire',
                    'Thiaroye Gare' => 'Thiaroye Gare',
                    'Thiaroye sur mer' => 'Thiaroye sur mer',
                    'Tivaouane Peulh' => 'Tivaouane Peulh',
                    'Toubab Dialao' => 'Toubab Dialao',
                    'Usine Bene Tally' => 'Usine Bene Tally',
                    'Usine Niary Tally' => 'Usine Niary Tally',
                    'Yen' => 'Yen',
                    'Yeumbeul' => 'Yeumbeul',
                    'Yoff' => 'Yoff',
                    'Zac Mbao' => 'Zac Mbao',
                    'Zone A et B' => 'Zone A et B',
                    'Zone de Captage' => 'Zone de Captage',
                    'Zone Industrielle' => 'Zone Industrielle',
                ],
            ])
            ->add('tel', NumberType::class,['label'=> "Telephone","attr"=>[
                "placeholder" => "Entrer votre Telephone",
            ]])
            ->add('submit',SubmitType::class,['label'=> "Ajouter mon addresse",'attr'=>[
                "class"=>"btn btn-block btn-warning"
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
