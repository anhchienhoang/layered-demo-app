<?php

namespace DemoApp\Core\Component\User\Model;

class User
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $address;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $address
     *
     * @return User
     */
    public static function create(string $firstName, string $lastName, string $email, string $address)
    {
        if (empty($firstName) || empty($lastName) || empty($email) || empty($address)) {
            throw new \InvalidArgumentException('Invalid data');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }

        $newUser = new self();

        $newUser->firstName = $firstName;
        $newUser->lastName = $lastName;
        $newUser->email = $email;
        $newUser->address = $address;

        return $newUser;
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public static function createFromState(array $data): User
    {
        $user = new self();
        $user->id = $data['id'];
        $user->firstName = $data['first_name'];
        $user->lastName = $data['last_name'];
        $user->email = $data['email'];
        $user->address = $data['address'];

        return $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}