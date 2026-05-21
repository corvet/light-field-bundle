# Corvet Light Field Bundle

Custom masked date input field with integrated Flatpickr calendar and custom footer buttons (Today / Clear) for Symfony 8+ and AssetMapper (Symfony UX).

## Features
- **Inputmask integration** (formats text as `dd.mm.yyyy` dynamically).
- **Flatpickr integration** (dark theme by default).
- **Custom Footer Buttons**: Single-click buttons for "Today" and "Clear" that work perfectly with the input mask without stripping data.
- **Zero Node/NPM dependencies** (built natively for Symfony AssetMapper).

## Installation

### 1. Download the Bundle

Run the following command in your Symfony project:

```bash
composer require corvet/light-field-bundle
````

### 2. Install JavaScript Dependencies

Since this bundle relies on `flatpickr` and `inputmask` via AssetMapper, import them into your application's `importmap.php`:


```bash
php bin/console importmap:require flatpickr inputmask
```

## Usage

Simply use `MaskedDateType::class` in your Symfony forms:

```php
use Corvet\LightFieldBundle\Form\MaskedDateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('createdAt', MaskedDateType::class, [
            'label' => 'Select Date',
        ]);
    }
}
```

## License

MIT License. See [LICENSE](https://www.google.com/search?q=LICENSE) for more information.

