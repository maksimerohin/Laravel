<?php

namespace App\DTOs;

/**
 * Class TelegramUserDTO
 * @package App\DTOs
 */
class TelegramUserDTO implements DTOInterface
{
    const ID = 'id';
    const IS_BOT = 'is_bot';
    const FIRST_NAME = 'first_name';
    const LAST_NAME  = 'last_name';
    const USERNAME  = 'username';
    const LANGUAGE_CODE  = 'language_code';
    const USER_ID  = 'user_id';
    /**
     * @var int
     */
    private $id;
    /**
     * @var bool
     */
    private $isBot;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $landuageCode;
    /**
     * @var string
     */
    private $userId;

    /**
     * TelegramUserDTO constructor.
     * @param int $id
     * @param bool $isBot
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $landuageCode
     * @param string $userId
     */
    private function __construct(
        int $id,
        bool $isBot,
        ?string $firstName,
        ?string $lastName,
        ?string $username,
        ?string $landuageCode,
        ?string $userId
    ) {

        $this->id = $id;
        $this->isBot = $isBot;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->landuageCode = $landuageCode;
        $this->userId = $userId;
    }

    /**
     * @param array $data
     * @return DTOInterface
     */
    public static function fromArray(array $data): DTOInterface
    {
        return new static(
            $data[static::ID],
            $data[static::IS_BOT] ?? false,
            $data[static::FIRST_NAME] ?? null,
            $data[static::LAST_NAME] ?? null,
            $data[static::USERNAME] ?? null,
            $data[static::LANGUAGE_CODE] ?? null,
            $data[static::USER_ID] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            static::ID => $this->id,
            static::IS_BOT => $this->isBot,
            static::FIRST_NAME => $this->firstName,
            static::LAST_NAME => $this->lastName,
            static::USERNAME => $this->username,
            static::LANGUAGE_CODE => $this->landuageCode,
            static::USER_ID => $this->userId,
        ];
    }
}
