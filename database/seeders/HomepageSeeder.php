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

        // Clear existing sections
        Section::where('page_id', $homepage->id)->delete();

        // 1. Hero Section (Dark Theme)
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::HERO,
            'title' => 'Building Digital Excellence',
            'subtitle' => 'Software & Automation Agency',
            'content' => [
                'heading' => "Building Digital\nExcellence",
                'subheading' => 'Software & Automation Agency',
                'description' => 'We partner with ambitious businesses to build custom software, automate operations, and create digital experiences that drive real growth.',
                'primary_button_text' => 'Start Your Project',
                'primary_button_url' => '#contact',
                'secondary_button_text' => 'View Our Work',
                'secondary_button_url' => '#portfolio',
                'stats' => [
                    ['value' => '200+', 'label' => 'Projects Delivered'],
                    ['value' => '50+', 'label' => 'Happy Clients'],
                    ['value' => '10+', 'label' => 'Years Experience'],
                    ['value' => '24/7', 'label' => 'Support'],
                ],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        // 2. About Section (Light Theme)
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::IMAGE_TEXT,
            'title' => 'We Build Software That Matters',
            'subtitle' => 'About Muxsol',
            'content' => [
                'heading' => 'We Build Software That Matters',
                'subheading' => 'About Muxsol',
                'description' => 'Muxsol is a leading software development and automation agency dedicated to helping businesses transform their operations through technology. Our team of experienced engineers and designers work closely with clients to deliver solutions that create lasting impact.',
                'highlights' => [
                    ['text' => 'Full-Stack Development Expertise'],
                    ['text' => 'Agile & Transparent Process'],
                    ['text' => 'Dedicated Project Teams'],
                    ['text' => 'Post-Launch Support & Maintenance'],
                ],
                'button_text' => 'Learn More About Us',
                'button_url' => '/about',
            ],
            'order' => 2,
            'is_active' => true,
        ]);

        // 3. Services Section (Dark Theme)
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::SERVICES,
            'title' => 'What We Do',
            'subtitle' => 'Our Services',
            'content' => [
                'items' => [
                    [
                        'title' => 'Custom Software Development',
                        'description' => 'End-to-end development of scalable web and mobile applications tailored to your business needs.',
                        'icon' => 'code-bracket',
                    ],
                    [
                        'title' => 'Mobile App Development',
                        'description' => 'Native and cross-platform mobile apps that deliver exceptional user experiences across devices.',
                        'icon' => 'device-phone-mobile',
                    ],
                    [
                        'title' => 'Process Automation',
                        'description' => 'Intelligent automation solutions that eliminate manual tasks and boost operational efficiency.',
                        'icon' => 'cpu-chip',
                    ],
                    [
                        'title' => 'Cloud Infrastructure',
                        'description' => 'Scalable cloud architecture and DevOps practices for reliable, high-performance systems.',
                        'icon' => 'server-stack',
                    ],
                    [
                        'title' => 'Data & Analytics',
                        'description' => 'Transform raw data into actionable insights with custom dashboards and reporting tools.',
                        'icon' => 'chart-bar',
                    ],
                    [
                        'title' => 'AI & Machine Learning',
                        'description' => 'Leverage artificial intelligence to automate decisions and enhance your products.',
                        'icon' => 'cpu-chip',
                    ],
                ],
            ],
            'settings' => ['columns' => 3],
            'order' => 3,
            'is_active' => true,
        ]);

        // 4. Products Section (Light Theme)
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::FEATURES,
            'title' => 'Our Products',
            'subtitle' => 'What We Build',
            'content' => [
                'items' => [
                    [
                        'title' => 'Enterprise SaaS Platforms',
                        'description' => 'Multi-tenant software platforms built for scale and reliability.',
                        'tag' => 'Featured',
                    ],
                    [
                        'title' => 'E-Commerce Solutions',
                        'description' => 'Complete online store solutions with payment and inventory management.',
                        'tag' => 'Popular',
                    ],
                    [
                        'title' => 'Business Automation Tools',
                        'description' => 'Custom workflow automation to eliminate repetitive tasks.',
                        'tag' => 'New',
                    ],
                ],
            ],
            'order' => 4,
            'is_active' => true,
        ]);

        // 5. Portfolio Section (Light Theme)
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::PORTFOLIO,
            'title' => 'Our Work',
            'subtitle' => 'Portfolio',
            'content' => [
                'items' => [
                    [
                        'title' => 'Enterprise Resource Planning System',
                        'category' => 'Web Application',
                        'link' => '#',
                    ],
                    [
                        'title' => 'FinTech Mobile Banking App',
                        'category' => 'Mobile Development',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Healthcare Management Platform',
                        'category' => 'SaaS Product',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Real-Time Analytics Dashboard',
                        'category' => 'Data Analytics',
                        'link' => '#',
                    ],
                ],
            ],
            'order' => 5,
            'is_active' => true,
        ]);

        // 6. CTA Section
        Section::create([
            'page_id' => $homepage->id,
            'type' => SectionType::CTA,
            'title' => 'Ready to Build Something Great?',
            'subtitle' => 'Get Started',
            'content' => [
                'heading' => 'Ready to Build Something Great?',
                'description' => "Let's discuss how we can help transform your business through technology.",
                'button_text' => 'Schedule a Call',
                'button_url' => '#contact',
            ],
            'order' => 6,
            'is_active' => true,
        ]);
    }
}
