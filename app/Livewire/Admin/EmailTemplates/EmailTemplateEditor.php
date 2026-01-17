<?php

namespace App\Livewire\Admin\EmailTemplates;

use App\Enums\EmailTemplateType;
use App\Models\ActivityLog;
use App\Models\EmailTemplate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EmailTemplateEditor extends Component
{
    public ?EmailTemplate $template = null;

    public string $name = '';
    public string $slug = '';
    public string $subject = '';
    public string $body = '';
    public string $type = 'transactional';
    public array $variables = [];
    public bool $is_active = true;

    public string $newVariable = '';
    public bool $showPreview = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('email_templates', 'slug')->ignore($this->template?->id),
            ],
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|in:' . implode(',', array_column(EmailTemplateType::cases(), 'value')),
            'is_active' => 'boolean',
        ];
    }

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->template = EmailTemplate::findOrFail($id);
            $this->name = $this->template->name;
            $this->slug = $this->template->slug;
            $this->subject = $this->template->subject;
            $this->body = $this->template->body;
            $this->type = $this->template->type->value;
            $this->variables = $this->template->variables ?? [];
            $this->is_active = $this->template->is_active;
        } else {
            // Default variables
            $this->variables = ['name', 'email', 'company'];
        }
    }

    public function updatedName(): void
    {
        if (!$this->template) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function addVariable(): void
    {
        if ($this->newVariable && !in_array($this->newVariable, $this->variables)) {
            $this->variables[] = Str::snake($this->newVariable);
            $this->newVariable = '';
        }
    }

    public function removeVariable(int $index): void
    {
        unset($this->variables[$index]);
        $this->variables = array_values($this->variables);
    }

    public function insertVariable(string $variable): void
    {
        // This will be handled by JavaScript on the frontend
        $this->dispatch('insert-variable', variable: '{{ $' . $variable . ' }}');
    }

    public function togglePreview(): void
    {
        $this->showPreview = !$this->showPreview;
    }

    public function getPreviewContent(): string
    {
        $content = $this->body;

        // Replace variables with sample data
        $sampleData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'company' => 'Acme Inc',
            'phone' => '+1 234 567 890',
            'date' => date('F j, Y'),
            'time' => date('g:i A'),
            'link' => '#',
            'site_name' => config('app.name'),
        ];

        foreach ($this->variables as $variable) {
            $value = $sampleData[$variable] ?? '[' . $variable . ']';
            $content = str_replace('{{ $' . $variable . ' }}', $value, $content);
            $content = str_replace('{{$' . $variable . '}}', $value, $content);
        }

        return $content;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'subject' => $this->subject,
            'body' => $this->body,
            'type' => EmailTemplateType::from($this->type),
            'variables' => $this->variables,
            'is_active' => $this->is_active,
        ];

        if ($this->template) {
            $this->template->update($data);
            ActivityLog::log('update', $this->template, 'Updated email template: ' . $this->template->name);
            session()->flash('success', 'Email template updated successfully!');
        } else {
            $template = EmailTemplate::create($data);
            ActivityLog::log('create', $template, 'Created email template: ' . $template->name);
            session()->flash('success', 'Email template created successfully!');
            $this->redirect(route('admin.email-templates.edit', $template->id), navigate: true);
        }
    }

    public function render()
    {
        return view('admin.livewire.email-templates.email-template-editor', [
            'types' => EmailTemplateType::cases(),
            'previewContent' => $this->getPreviewContent(),
        ])->layout('admin.layouts.app');
    }
}
