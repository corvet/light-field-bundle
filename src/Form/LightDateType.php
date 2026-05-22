<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LightDateType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder, 
        array $options
    ): void {
        $builder->addViewTransformer(new DateTimeToStringTransformer(
            inputTimezone: 'UTC',
            outputTimezone: 'UTC',
            format: 'd.m.Y'
        ));
    }

    public function buildView(
        FormView $view, 
        FormInterface $form, 
        array $options
    ): void {
        // Додаємо Stimulus-контролер до атрибутів інпута або батьківського div через скінченний додаток
        $view->vars['attr']['data-controller'] = 'corvet--light-field-bundle--main';
        $view->vars['legend'] = $options['legend'] ?? ucfirst($form->getName());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'legend' => null, // Обов'язково реєструємо нову опцію
            'attr' => [
                'placeholder' => '..____',
                'autocomplete' => 'off',
            ],
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'corvet_masked_date';
    }
}
