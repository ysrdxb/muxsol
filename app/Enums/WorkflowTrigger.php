<?php

namespace App\Enums;

enum WorkflowTrigger: string
{
    case FORM_SUBMIT = 'form_submit';
    case PAGE_VISIT = 'page_visit';
    case SCHEDULE = 'schedule';
    case WEBHOOK = 'webhook';
    case USER_SIGNUP = 'user_signup';
    case CONTACT_CREATED = 'contact_created';

    public function label(): string
    {
        return match ($this) {
            self::FORM_SUBMIT => 'Form Submission',
            self::PAGE_VISIT => 'Page Visit',
            self::SCHEDULE => 'Scheduled Time',
            self::WEBHOOK => 'Webhook',
            self::USER_SIGNUP => 'User Signup',
            self::CONTACT_CREATED => 'Contact Created',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::FORM_SUBMIT => 'document-text',
            self::PAGE_VISIT => 'eye',
            self::SCHEDULE => 'clock',
            self::WEBHOOK => 'link',
            self::USER_SIGNUP => 'user-plus',
            self::CONTACT_CREATED => 'user-circle',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($trigger) => [
            $trigger->value => $trigger->label()
        ])->toArray();
    }
}
