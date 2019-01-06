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

/**
 * Class ListErrorsAuthorization
 */
class ListErrorsAuthorization
{
    const ERROR_ACCESS_GROUP = 'Vous n\'êtes pas autorisé aux informations de ce groupe';
    const GROUP_NOT_FOUND = 'Le groupe n\'existe pas.';
    const ERROR_EDIT_STOCK_PRODUCT = 'Vous n\'avez pas les droits pour modifier le stock de ce produit.';
}
