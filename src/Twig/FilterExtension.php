<?php

declare(strict_types=1);

namespace App\Twig;

use Liip\ImagineBundle\Templating\FilterExtension as BaseFilterExtension;

final class FilterExtension extends BaseFilterExtension
{
    public function filter($path, $filter, array $config = [], $resolver = null)
    {
        if (substr($path, -3) === 'svg') {
            return '/media/image/'.$path;
        }

        return parent::filter($path, $filter, $config, $resolver);
    }
}
