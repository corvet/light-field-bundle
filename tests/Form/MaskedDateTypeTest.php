<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle\Tests\Form;

use Corvet\LightFieldBundle\Form\MaskedDateType;
use Symfony\Component\Form\Test\TypeTestCase;

class MaskedDateTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = '21.05.2026';

        // Створюємо форму за допомогою фабрики компонентів форми Symfony
        $form = $this->factory->create(MaskedDateType::class);

        // Імітуємо відправку (submit) даних у форму
        $form->submit($formData);

        // Перевіряємо, що дані успішно скомпілювалися і форма валідна
        $this->assertTrue($form->isSynchronized());
        $this->assertSame($formData, $form->getData());
    }
}
