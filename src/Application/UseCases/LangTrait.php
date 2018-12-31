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

namespace App\Application\UseCases;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * trait LangTrait
 */
trait LangTrait
{
    /**
     * Language Required. `fr` or `en` allowed
     *
     * @var string
     *
     * @Assert\Choice(choices={"fr", "en"})
     * @Assert\NotBlank(
     *     message="Language is required"
     * )
     */
    protected $lang;

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(?string $lang)
    {
        $this->lang = $lang;
    }
}
