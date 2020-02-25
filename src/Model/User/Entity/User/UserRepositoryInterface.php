<?php
declare(strict_types=1);

namespace Myks92\User\Model\User\Entity\User;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @author Maxim Vorozhtsov <myks1992@mail.ru>
 */
interface UserRepositoryInterface
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em);

    /**
     * @param string $token
     *
     * @return User|object|null
     */
    public function findByConfirmToken(string $token): ?User;

    /**
     * @param string $token
     *
     * @return User|object|null
     */
    public function findByResetToken(string $token): ?User;

    /**
     * @param Id $id
     *
     * @return User
     */
    public function get(Id $id): User;

    /**
     * @param Email $email
     *
     * @return User
     */
    public function getByEmail(Email $email): User;

    /**
     * @param Email $email
     *
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function hasByEmail(Email $email): bool;

    /**
     * @param string $network
     * @param string $identity
     *
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function hasByNetworkIdentity(string $network, string $identity): bool;

    /**
     * @param User $user
     */
    public function add(User $user): void;

    /**
     * @param User $user
     */
    public function remove(User $user): void;
}