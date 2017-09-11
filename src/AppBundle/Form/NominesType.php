<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
class NominesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('nominee')
//            ->add('domaine')

            ->add('domaine', ChoiceType::class, array('choices' => array(
                'Création artistique et technique' => '1',
                'Scénographie' => '2',
                'Espoir féminin' => '3',
                'Espoir masculin' => '4',
                'Découverte' => '5',
                'Auteur' => '6',
                'Prix Bernadette Abraté' => '7',
                'Comédienne' => '7',
                'Comédien' => '8',
                'Seul en scène' => '10',
                'Spectacle de danse' => '11',
                'Mise en scène' => '12',
                'Spectacle' => '13',
                'Prix spécial du jury' => '14',
                'Spectacle "Jeune Public"' => '25',
                'Spectacle de cirque' => '62',
            )))

            ->add('annee', ChoiceType::class, array('choices' => array(
                '2007' => '2007',
                '2008' => '2008',
                '2009' => '2009',
                '2010' => '2010',
                '2011' => '2011',
                '2012' => '2012',
                '2013' => '2013',
                '2014' => '2014',
                '2015' => '2015',
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
                '2020' => '2020',
                '2021' => '2021',
                '2022' => '2022',
                '2023' => '2023',
                '2024' => '2024',
                '2025' => '2025',
                '2026' => '2026',
                '2027' => '2027',
                '2028' => '2028',
                '2029' => '2029',
                '2030' => '2030')))
            ->add('sid1', TextType::class, array('label' => "Nom ou titre de l'oeuvre"))
            ->add('nid1', TextType::class ,array('label' => 'Prénom','required' => false))
            ->add('sid2', TextType::class ,array('label' => 'Nom','required' => false))
            ->add('nid2', TextType::class ,array('label' => 'Prénom','required' => false))
            ->add('sid3', TextType::class ,array('label' => 'Nom','required' => false))
            ->add('nid3', TextType::class ,array('label' => 'Prénom','required' => false))
            ->add('elu', ChoiceType::class, array('choices' => array('Non' => '0', 'Oui' => '1')))
            ->add('commentaire', CKEditorType::class, array('config' => array('uiColor' => '#B6FDFF', 'width' => '1200px', 'color' => 'red')))
            ->add('longcomm', CKEditorType::class, array('config' => array('uiColor' => '#B6FDFF', 'width' => '1200px'),'label' => 'Notice'))
            ->add('photo')
;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Nomines'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_nomines';
    }

}
