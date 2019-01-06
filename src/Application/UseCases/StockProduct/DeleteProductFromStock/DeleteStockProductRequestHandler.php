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

namespace App\Application\UseCases\StockProduct\DeleteProductFromStock;

use App\Application\Helpers\Core\ListErrorsAuthorization;
use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;
use App\Domain\Model\StockProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class DeleteStockProductRequestHandler
 */
class DeleteStockProductRequestHandler extends AbstractRequestHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct(
            $serializer,
            $validator,
            $tokenStorage,
            $authorizationChecker
        );
    }

    public function handle(Request $request): InputInterface
    {
        $groupAndStock = $this->checkExistingGroupAndStock($request);
        $this->checkAuthorization(
            'access',
            $groupAndStock['group'],
            ListErrorsAuthorization::ERROR_ACCESS_GROUP
        );
        $this->checkAuthorization(
            'deleteUser',
            $groupAndStock['stock'],
            ListErrorsAuthorization::ERROR_REMOVE_STOCK_PRODUCT_USER
        );
        $this->checkAuthorization(
            'delete',
            $groupAndStock['stock'],
            ListErrorsAuthorization::ERROR_REMOVE_STOCK_PRODUCT
        );

        $input = $this->instanciateInputClass();
        $input->setGroup($groupAndStock['group'])
              ->setStock($groupAndStock['stock']);

        return $input;
    }

    protected function getClassInput(): string
    {
        return DeleteStockProductInput::class;
    }

    protected function havePayload(): bool
    {
        return false;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function checkExistingGroupAndStock(Request $request)
    {
        $group = $this->entityManager->getRepository(GroupUser::class)
            ->find((int) $request->attributes->get('groupId'));
        $stockProduct = $this->entityManager->getRepository(StockProduct::class)
            ->find((int) $request->attributes->get('stockId'));
        if (is_null($group)) {
            throw new HttpException(
                Response::HTTP_NOT_FOUND,
                'Le groupe n\'existe pas.'
            );
        }
        if (is_null($stockProduct)) {
            throw new HttpException(
                Response::HTTP_NOT_FOUND,
                'Ce produit n\'est pas présent dans votre stock.'
            );
        }

        return [
            'group' => $group,
            'stock' => $stockProduct
        ];
    }
}
