<?php

namespace App\Livewire\Admin\Menus;

use App\Enums\MenuLocation;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Livewire\Component;

class MenuManager extends Component
{
    public ?Menu $menu = null;
    public string $menuName = '';
    public string $menuLocation = 'header';

    public array $menuItems = [];
    public bool $showItemModal = false;
    public ?int $editingItemIndex = null;

    public string $itemTitle = '';
    public string $itemUrl = '';
    public ?int $itemPageId = null;
    public string $itemTarget = '_self';

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->menu = Menu::with('items')->find($id);
            if ($this->menu) {
                $this->menuName = $this->menu->name;
                $this->menuLocation = $this->menu->location->value;
                $this->menuItems = $this->menu->items->map(fn($item) => [
                    'id' => $item->id,
                    'title' => $item->title,
                    'url' => $item->url,
                    'page_id' => $item->page_id,
                    'target' => $item->target,
                ])->toArray();
            }
        }
    }

    public function save(): void
    {
        $this->validate([
            'menuName' => 'required|min:2|max:100',
            'menuLocation' => 'required',
        ]);

        $data = [
            'name' => $this->menuName,
            'location' => MenuLocation::from($this->menuLocation),
        ];

        if ($this->menu) {
            $this->menu->update($data);
        } else {
            $this->menu = Menu::create($data);
        }

        // Save menu items
        $existingIds = [];
        foreach ($this->menuItems as $index => $itemData) {
            $itemData['menu_id'] = $this->menu->id;
            $itemData['order'] = $index + 1;

            if (isset($itemData['id'])) {
                $item = MenuItem::find($itemData['id']);
                if ($item) {
                    $item->update($itemData);
                    $existingIds[] = $item->id;
                }
            } else {
                $item = MenuItem::create($itemData);
                $this->menuItems[$index]['id'] = $item->id;
                $existingIds[] = $item->id;
            }
        }

        MenuItem::where('menu_id', $this->menu->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        Menu::clearCache();
        session()->flash('success', 'Menu saved successfully!');
    }

    public function addItem(): void
    {
        $this->validate([
            'itemTitle' => 'required|min:1|max:100',
        ]);

        $this->menuItems[] = [
            'title' => $this->itemTitle,
            'url' => $this->itemPageId ? null : $this->itemUrl,
            'page_id' => $this->itemPageId,
            'target' => $this->itemTarget,
        ];

        $this->resetItemForm();
        $this->showItemModal = false;
    }

    public function editItem(int $index): void
    {
        $this->editingItemIndex = $index;
        $item = $this->menuItems[$index];
        $this->itemTitle = $item['title'];
        $this->itemUrl = $item['url'] ?? '';
        $this->itemPageId = $item['page_id'];
        $this->itemTarget = $item['target'] ?? '_self';
        $this->showItemModal = true;
    }

    public function updateItem(): void
    {
        $this->validate([
            'itemTitle' => 'required|min:1|max:100',
        ]);

        if ($this->editingItemIndex !== null) {
            $this->menuItems[$this->editingItemIndex] = [
                'id' => $this->menuItems[$this->editingItemIndex]['id'] ?? null,
                'title' => $this->itemTitle,
                'url' => $this->itemPageId ? null : $this->itemUrl,
                'page_id' => $this->itemPageId,
                'target' => $this->itemTarget,
            ];
        }

        $this->resetItemForm();
        $this->showItemModal = false;
    }

    public function removeItem(int $index): void
    {
        unset($this->menuItems[$index]);
        $this->menuItems = array_values($this->menuItems);
    }

    public function moveItem(int $index, string $direction): void
    {
        $newIndex = $direction === 'up' ? $index - 1 : $index + 1;
        if ($newIndex >= 0 && $newIndex < count($this->menuItems)) {
            $temp = $this->menuItems[$index];
            $this->menuItems[$index] = $this->menuItems[$newIndex];
            $this->menuItems[$newIndex] = $temp;
        }
    }

    public function openAddModal(): void
    {
        $this->resetItemForm();
        $this->showItemModal = true;
    }

    private function resetItemForm(): void
    {
        $this->editingItemIndex = null;
        $this->itemTitle = '';
        $this->itemUrl = '';
        $this->itemPageId = null;
        $this->itemTarget = '_self';
    }

    public function render()
    {
        return view('admin.livewire.menus.menu-manager', [
            'locations' => MenuLocation::cases(),
            'pages' => Page::published()->orderBy('title')->get(),
        ])->layout('admin.layouts.app');
    }
}
