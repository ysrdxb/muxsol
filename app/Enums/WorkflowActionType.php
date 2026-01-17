<?php

namespace App\Enums;

enum WorkflowActionType: string
{
    case SEND_EMAIL = 'send_email';
    case DELAY = 'delay';
    case CONDITION = 'condition';
    case WEBHOOK = 'webhook';
    case UPDATE_CONTACT = 'update_contact';
    case ADD_TAG = 'add_tag';
    case REMOVE_TAG = 'remove_tag';
    case AI_RESPONSE = 'ai_response';
    case NOTIFICATION = 'notification';

    public function label(): string
    {
        return match ($this) {
            self::SEND_EMAIL => 'Send Email',
            self::DELAY => 'Wait/Delay',
            self::CONDITION => 'Condition',
            self::WEBHOOK => 'Send Webhook',
            self::UPDATE_CONTACT => 'Update Contact',
            self::ADD_TAG => 'Add Tag',
            self::REMOVE_TAG => 'Remove Tag',
            self::AI_RESPONSE => 'AI Response',
            self::NOTIFICATION => 'Send Notification',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::SEND_EMAIL => 'envelope',
            self::DELAY => 'clock',
            self::CONDITION => 'adjustments-horizontal',
            self::WEBHOOK => 'link',
            self::UPDATE_CONTACT => 'pencil',
            self::ADD_TAG => 'tag',
            self::REMOVE_TAG => 'x-mark',
            self::AI_RESPONSE => 'sparkles',
            self::NOTIFICATION => 'bell',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($action) => [
            $action->value => $action->label()
        ])->toArray();
    }
}
