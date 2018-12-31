<?php

declare(strict_types=1);

/*
 * This file is part of recipe
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Helpers\Core;

use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class TranslatorBuilder
 */
class TranslatorBuilder
{
    const ALLOWED_LANGAGE = [
        'fr' => 'fr_FR',
        'en' => 'en_EN',
    ];

    /** @var TranslatorInterface */
    private $translator;

    /**
     * TranslatorBuilder constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * @param string $key
     * @param string $catalog
     *
     * @return array
     */
    public function buildTranslatable(string $key, string $catalog)
    {
        $results = [];
        foreach (self::ALLOWED_LANGAGE as $shortCode => $isoCode) {
            $results[$isoCode] = $this->translate($key, $shortCode, $catalog);
        }

        return $results;
    }

    /**
     * @param string $key
     * @param string $lang
     * @param string $catalog
     * @param array  $params
     *
     * @return string
     */
    public function translate(string $key, string $lang, string $catalog, array $params = [])
    {
        return $this->translator->trans($key, $params, $catalog, $lang);
    }
}
