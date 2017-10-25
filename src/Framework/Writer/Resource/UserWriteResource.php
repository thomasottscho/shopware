<?php declare(strict_types=1);

namespace Shopware\Framework\Writer\Resource;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\UserWrittenEvent;
use Shopware\Framework\Write\Field\BoolField;
use Shopware\Framework\Write\Field\DateField;
use Shopware\Framework\Write\Field\FkField;
use Shopware\Framework\Write\Field\IntField;
use Shopware\Framework\Write\Field\ReferenceField;
use Shopware\Framework\Write\Field\StringField;
use Shopware\Framework\Write\Field\SubresourceField;
use Shopware\Framework\Write\Field\UuidField;
use Shopware\Framework\Write\Flag\Required;
use Shopware\Framework\Write\WriteResource;
use Shopware\Locale\Writer\Resource\LocaleWriteResource;
use Shopware\Media\Writer\Resource\MediaWriteResource;

class UserWriteResource extends WriteResource
{
    protected const UUID_FIELD = 'uuid';
    protected const ROLE_ID_FIELD = 'roleId';
    protected const ROLE_UUID_FIELD = 'roleUuid';
    protected const NAME_FIELD = 'name';
    protected const PASSWORD_FIELD = 'password';
    protected const ENCODER_FIELD = 'encoder';
    protected const API_KEY_FIELD = 'apiKey';
    protected const LOCALE_ID_FIELD = 'localeId';
    protected const SESSION_ID_FIELD = 'sessionId';
    protected const LAST_LOGIN_FIELD = 'lastLogin';
    protected const EMAIL_FIELD = 'email';
    protected const ACTIVE_FIELD = 'active';
    protected const FAILED_LOGINS_FIELD = 'failedLogins';
    protected const LOCKED_UNTIL_FIELD = 'lockedUntil';
    protected const EXTENDED_EDITOR_FIELD = 'extendedEditor';
    protected const DISABLED_CACHE_FIELD = 'disabledCache';

    public function __construct()
    {
        parent::__construct('user');

        $this->primaryKeyFields[self::UUID_FIELD] = (new UuidField('uuid'))->setFlags(new Required());
        $this->fields[self::ROLE_ID_FIELD] = (new IntField('user_role_id'))->setFlags(new Required());
        $this->fields[self::ROLE_UUID_FIELD] = (new StringField('user_role_uuid'))->setFlags(new Required());
        $this->fields[self::NAME_FIELD] = (new StringField('user_name'))->setFlags(new Required());
        $this->fields[self::PASSWORD_FIELD] = (new StringField('password'))->setFlags(new Required());
        $this->fields[self::ENCODER_FIELD] = new StringField('encoder');
        $this->fields[self::API_KEY_FIELD] = new StringField('api_key');
        $this->fields[self::LOCALE_ID_FIELD] = (new IntField('locale_id'))->setFlags(new Required());
        $this->fields[self::SESSION_ID_FIELD] = new StringField('session_id');
        $this->fields[self::LAST_LOGIN_FIELD] = (new DateField('last_login'))->setFlags(new Required());
        $this->fields[self::NAME_FIELD] = (new StringField('name'))->setFlags(new Required());
        $this->fields[self::EMAIL_FIELD] = (new StringField('email'))->setFlags(new Required());
        $this->fields[self::ACTIVE_FIELD] = new BoolField('active');
        $this->fields[self::FAILED_LOGINS_FIELD] = (new IntField('failed_logins'))->setFlags(new Required());
        $this->fields[self::LOCKED_UNTIL_FIELD] = new DateField('locked_until');
        $this->fields[self::EXTENDED_EDITOR_FIELD] = new BoolField('extended_editor');
        $this->fields[self::DISABLED_CACHE_FIELD] = new BoolField('disabled_cache');
        $this->fields['blogs'] = new SubresourceField(BlogWriteResource::class);
        $this->fields['media'] = new SubresourceField(MediaWriteResource::class);
        $this->fields['locale'] = new ReferenceField('localeUuid', 'uuid', LocaleWriteResource::class);
        $this->fields['localeUuid'] = (new FkField('locale_uuid', LocaleWriteResource::class, 'uuid'))->setFlags(new Required());
    }

    public function getWriteOrder(): array
    {
        return [
            BlogWriteResource::class,
            MediaWriteResource::class,
            LocaleWriteResource::class,
            self::class,
        ];
    }

    public static function createWrittenEvent(array $updates, TranslationContext $context, array $rawData = [], array $errors = []): UserWrittenEvent
    {
        $event = new UserWrittenEvent($updates[self::class] ?? [], $context, $rawData, $errors);

        unset($updates[self::class]);

        /**
         * @var WriteResource
         * @var string[]      $identifiers
         */
        foreach ($updates as $class => $identifiers) {
            if (!array_key_exists($class, $updates) || count($updates[$class]) === 0) {
                continue;
            }

            $event->addEvent($class::createWrittenEvent($updates, $context));
        }

        return $event;
    }
}
