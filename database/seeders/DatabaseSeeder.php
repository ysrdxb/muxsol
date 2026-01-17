<?php

namespace Database\Seeders;

use App\Enums\MenuLocation;
use App\Enums\PageStatus;
use App\Enums\SectionType;
use App\Enums\UserRole;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@muxsol.com',
            'password' => Hash::make('password'),
            'role' => UserRole::SUPER_ADMIN,
            'is_active' => true,
        ]);

        // Seed Default Settings
        $this->seedSettings();

        // Create Homepage
        $homepage = $this->createHomepage($admin);

        // Create Additional Pages
        $this->createPages($admin);

        // Create Menus
        $this->createMenus();
    }

    private function seedSettings(): void
    {
        $settings = [
            // General Settings
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Muxsol'],
            ['group' => 'general', 'key' => 'site_description', 'value' => 'Web & Mobile Apps Development Agency - We build innovative digital solutions'],
            ['group' => 'general', 'key' => 'admin_email', 'value' => 'info@muxsol.com'],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'UTC'],

            // Appearance Settings
            ['group' => 'appearance', 'key' => 'primary_color', 'value' => '#3B82F6'],
            ['group' => 'appearance', 'key' => 'secondary_color', 'value' => '#10B981'],
            ['group' => 'appearance', 'key' => 'accent_color', 'value' => '#8B5CF6'],
            ['group' => 'appearance', 'key' => 'font_family', 'value' => 'Inter'],
            ['group' => 'appearance', 'key' => 'heading_font', 'value' => 'Inter'],

            // Header Settings
            ['group' => 'header', 'key' => 'sticky_header', 'value' => true],
            ['group' => 'header', 'key' => 'cta_button_text', 'value' => 'Get Started'],
            ['group' => 'header', 'key' => 'cta_button_url', 'value' => '/contact'],

            // Footer Settings
            ['group' => 'footer', 'key' => 'footer_description', 'value' => 'Building innovative digital solutions for businesses worldwide.'],
            ['group' => 'footer', 'key' => 'copyright_text', 'value' => '© ' . date('Y') . ' Muxsol. All rights reserved.'],

            // SEO Settings
            ['group' => 'seo', 'key' => 'meta_title_suffix', 'value' => ' | Muxsol'],
            ['group' => 'seo', 'key' => 'default_meta_description', 'value' => 'Professional web and mobile app development services. Expert in Laravel, React, MERN Stack, WordPress, and AI Automation.'],

            // Security Settings
            ['group' => 'security', 'key' => 'maintenance_mode', 'value' => false],
            ['group' => 'security', 'key' => 'login_attempts', 'value' => 5],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    private function createHomepage(User $admin): Page
    {
        $homepage = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'status' => PageStatus::PUBLISHED,
            'template' => 'home',
            'author_id' => $admin->id,
            'published_at' => now(),
            'order' => 0,
        ]);

        // Hero Section
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::HERO,
            'title' => 'Build Your Digital Future',
            'subtitle' => 'Transform your business with cutting-edge web and mobile solutions',
            'content' => [
                'heading' => 'Build Your Digital Future',
                'subheading' => 'Transform your business with cutting-edge web and mobile solutions',
                'description' => 'We are a full-service digital agency specializing in web development, mobile apps, AI automation, and digital transformation.',
                'primary_button_text' => 'Get Started',
                'primary_button_url' => '/contact',
                'secondary_button_text' => 'View Our Work',
                'secondary_button_url' => '/portfolio',
                'background_image' => null,
            ],
            'settings' => [
                'style' => 'centered',
                'background_type' => 'gradient',
                'text_color' => 'dark',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // Services Section
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::SERVICES,
            'title' => 'Our Services',
            'subtitle' => 'Comprehensive solutions for your digital needs',
            'content' => [
                'items' => [
                    [
                        'title' => 'Web Development',
                        'description' => 'Custom websites and web applications built with Laravel, React, and modern technologies.',
                        'icon' => 'code-bracket',
                    ],
                    [
                        'title' => 'Mobile Apps',
                        'description' => 'Native and cross-platform mobile applications for iOS and Android.',
                        'icon' => 'device-phone-mobile',
                    ],
                    [
                        'title' => 'AI Automation',
                        'description' => 'Intelligent automation solutions to streamline your business processes.',
                        'icon' => 'cpu-chip',
                    ],
                    [
                        'title' => 'WordPress',
                        'description' => 'Professional WordPress development, themes, and plugins.',
                        'icon' => 'squares-2x2',
                    ],
                    [
                        'title' => 'MERN Stack',
                        'description' => 'Full-stack JavaScript development with MongoDB, Express, React, and Node.js.',
                        'icon' => 'server-stack',
                    ],
                    [
                        'title' => 'GoHighLevel',
                        'description' => 'CRM setup, automation, and marketing solutions with GoHighLevel.',
                        'icon' => 'chart-bar',
                    ],
                ],
            ],
            'settings' => [
                'columns' => 3,
                'style' => 'cards',
            ],
            'order' => 2,
            'is_active' => true,
        ]);

        // Stats Section
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::STATS,
            'title' => 'Our Impact',
            'content' => [
                'items' => [
                    ['value' => '500+', 'label' => 'Projects Delivered'],
                    ['value' => '150+', 'label' => 'Happy Clients'],
                    ['value' => '10+', 'label' => 'Years Experience'],
                    ['value' => '25+', 'label' => 'Team Members'],
                ],
            ],
            'settings' => [
                'background' => 'primary',
            ],
            'order' => 3,
            'is_active' => true,
        ]);

        // CTA Section
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::CTA,
            'title' => 'Ready to Start Your Project?',
            'subtitle' => 'Let\'s discuss how we can help bring your ideas to life.',
            'content' => [
                'heading' => 'Ready to Start Your Project?',
                'description' => 'Let\'s discuss how we can help bring your ideas to life.',
                'button_text' => 'Contact Us',
                'button_url' => '/contact',
            ],
            'settings' => [
                'style' => 'centered',
                'background' => 'gradient',
            ],
            'order' => 4,
            'is_active' => true,
        ]);

        return $homepage;
    }

    private function createPages(User $admin): void
    {
        // About Page
        $about = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'content' => '<p>Muxsol is a leading digital agency committed to delivering innovative web and mobile solutions.</p>',
            'status' => PageStatus::PUBLISHED,
            'author_id' => $admin->id,
            'published_at' => now(),
            'order' => 1,
        ]);

        // Services Page
        Page::create([
            'title' => 'Services',
            'slug' => 'services',
            'status' => PageStatus::PUBLISHED,
            'author_id' => $admin->id,
            'published_at' => now(),
            'order' => 2,
        ]);

        // Portfolio Page
        Page::create([
            'title' => 'Portfolio',
            'slug' => 'portfolio',
            'status' => PageStatus::PUBLISHED,
            'author_id' => $admin->id,
            'published_at' => now(),
            'order' => 3,
        ]);

        // Contact Page
        $contact = Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'status' => PageStatus::PUBLISHED,
            'author_id' => $admin->id,
            'published_at' => now(),
            'order' => 4,
        ]);

        // Add contact form section
        Section::create([
            'page_id' => $contact->id,
            'type' => SectionType::CONTACT,
            'title' => 'Get In Touch',
            'subtitle' => 'We\'d love to hear from you',
            'content' => [
                'email' => 'info@muxsol.com',
                'phone' => '+1 234 567 890',
                'address' => '123 Business Street, Tech City',
                'show_map' => false,
            ],
            'settings' => [
                'show_form' => true,
                'form_fields' => ['name', 'email', 'phone', 'message'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);
    }

    private function createMenus(): void
    {
        // Header Menu
        $headerMenu = Menu::create([
            'name' => 'Main Navigation',
            'location' => MenuLocation::HEADER,
        ]);

        $menuItems = [
            ['title' => 'Home', 'url' => '/', 'order' => 1],
            ['title' => 'About', 'url' => '/about', 'order' => 2],
            ['title' => 'Services', 'url' => '/services', 'order' => 3],
            ['title' => 'Portfolio', 'url' => '/portfolio', 'order' => 4],
            ['title' => 'Contact', 'url' => '/contact', 'order' => 5],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create([
                'menu_id' => $headerMenu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'order' => $item['order'],
            ]);
        }

        // Footer Menu
        $footerMenu = Menu::create([
            'name' => 'Footer Navigation',
            'location' => MenuLocation::FOOTER,
        ]);

        $footerItems = [
            ['title' => 'Privacy Policy', 'url' => '/privacy', 'order' => 1],
            ['title' => 'Terms of Service', 'url' => '/terms', 'order' => 2],
            ['title' => 'Contact', 'url' => '/contact', 'order' => 3],
        ];

        foreach ($footerItems as $item) {
            MenuItem::create([
                'menu_id' => $footerMenu->id,
                'title' => $item['title'],
                'url' => $item['url'],
                'order' => $item['order'],
            ]);
        }
    }
}
