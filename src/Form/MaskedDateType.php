<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaskedDateType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        // Додаємо Stimulus-контролер до атрибутів інпута або батьківського div через скінченний додаток
        $view->vars['attr']['data-controller'] = 'corvet--light-field-bundle--main';
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
