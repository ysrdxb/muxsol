<?php

namespace App\Models;

use App\Enums\EmailTemplateType;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'subject',
        'body',
        'type',
        'variables',
        'is_active',
    ];

    protected $casts = [
        'type' => EmailTemplateType::class,
        'variables' => 'json',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeType($query, string|EmailTemplateType $type)
    {
        $typeValue = $type instanceof EmailTemplateType ? $type->value : $type;
        return $query->where('type', $typeValue);
    }

    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }

    public function render(array $data = []): array
    {
        $subject = $this->subject;
        $body = $this->body;

        foreach ($data as $key => $value) {
            $placeholder = '{{' . $key . '}}';
            $subject = str_replace($placeholder, $value, $subject);
            $body = str_replace($placeholder, $value, $body);
        }

        return [
            'subject' => $subject,
            'body' => $body,
        ];
    }

    public function getAvailableVariables(): array
    {
        return $this->variables ?? [];
    }

    public function duplicate(): self
    {
        $newTemplate = $this->replicate();
        $newTemplate->name = $this->name . ' (Copy)';
        $newTemplate->slug = null;
        $newTemplate->save();

        return $newTemplate;
    }
}
