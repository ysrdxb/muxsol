<?php

namespace Database\Seeders;

use App\Enums\PageStatus;
use App\Enums\SectionType;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        $authorId = \App\Models\User::first()->id ?? \App\Models\User::factory()->create()->id;

        // Ensure Homepage Exists
        $homepage = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'is_homepage' => true,
                'status' => PageStatus::PUBLISHED,
                'published_at' => now(),
                'author_id' => $authorId,
            ]
        );

        // Ensure Hero Section Exists
        Section::firstOrCreate(
            [
                'page_id' => $homepage->id,
                'type' => SectionType::HERO,
            ],
            [
                'title' => 'Welcome to Muxsol',
                'subtitle' => 'Digital Innovation',
                'content' => [
                    'heading' => 'Building the Future of Digital Experiences',
                    'subheading' => 'Creative Agency',
                    'description' => 'We craft stunning websites and powerful automation solutions that drive growth and engagement for your business.',
                    'primary_button_text' => 'Get Started',
                    'primary_button_url' => '#contact',
                    'secondary_button_text' => 'Learn More',
                    'secondary_button_url' => '#services',
                ],
                'settings' => [
                    'style' => 'centered',
                    'background_type' => 'gradient',
                ],
                'order' => 1,
                'is_active' => true,
            ]
        );

        // Ensure Services Section Exists
        Section::firstOrCreate(
            [
                'page_id' => $homepage->id,
                'type' => SectionType::SERVICES,
            ],
            [
                'title' => 'Our Expertise',
                'subtitle' => 'What We Do',
                'content' => [
                    'items' => [
                        [
                            'title' => 'Web Development',
                            'description' => 'Custom websites built with modern technologies like Laravel and React.',
                            'icon' => 'code-bracket',
                        ],
                        [
                            'title' => 'Mobile Apps',
                            'description' => 'Native and cross-platform mobile applications for iOS and Android.',
                            'icon' => 'device-phone-mobile',
                        ],
                        [
                            'title' => 'Process Automation',
                            'description' => 'Streamline your business operations with custom automation workflows.',
                            'icon' => 'cpu-chip',
                        ],
                    ],
                ],
                'settings' => [
                    'columns' => 3,
                    'style' => 'cards',
                ],
                'order' => 2,
                'is_active' => true,
            ]
        );
    }
}
