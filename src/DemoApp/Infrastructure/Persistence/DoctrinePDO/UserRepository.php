<?php

namespace DemoApp\Infrastructure\Persistence\DoctrinePDO;

use DemoApp\Core\Component\User\Model\User;
use DemoApp\Core\Component\User\Model\UserRepository as UserRepositoryPort;
use Doctrine\DBAL\Connection;

class UserRepository implements UserRepositoryPort
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param User $user
     *
     * @return int
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function add(User $user): int
    {
        $result = $this->connection->executeQuery(
            'INSERT INTO users (`first_name`, `last_name`, `email`, `address`) VALUES (?, ?, ?, ?)',
            [$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getAddress()]
        );

        if ($result) {
            return $this->connection->lastInsertId();
        }

        return 0;
    }

    /**
     * @param int $id
     *
     * @return User
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function get(int $id): User
    {
        $stmt  = $stmt = $this->connection->prepare('SELECT * FROM `users` WHERE id=:id');
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return User::createFromState($data);
    }

}