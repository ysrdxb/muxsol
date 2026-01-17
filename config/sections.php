<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Available Section Types
    |--------------------------------------------------------------------------
    */

    'types' => [
        'hero' => [
            'name' => 'Hero Section',
            'description' => 'Main banner section with heading, text, and CTA',
            'icon' => 'heroicons-o-rectangle-group',
            'view' => 'frontend.sections.hero',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Subtitle'],
                'description' => ['type' => 'textarea', 'label' => 'Description'],
                'background_image' => ['type' => 'image', 'label' => 'Background Image'],
                'cta_text' => ['type' => 'text', 'label' => 'CTA Button Text'],
                'cta_url' => ['type' => 'text', 'label' => 'CTA Button URL'],
                'cta_secondary_text' => ['type' => 'text', 'label' => 'Secondary CTA Text'],
                'cta_secondary_url' => ['type' => 'text', 'label' => 'Secondary CTA URL'],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['centered', 'left', 'right', 'split']],
            ],
        ],

        'services' => [
            'name' => 'Services',
            'description' => 'Display your services in a grid layout',
            'icon' => 'heroicons-o-squares-2x2',
            'view' => 'frontend.sections.services',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Services', 'fields' => [
                    'icon' => ['type' => 'icon', 'label' => 'Icon'],
                    'title' => ['type' => 'text', 'label' => 'Title'],
                    'description' => ['type' => 'textarea', 'label' => 'Description'],
                    'url' => ['type' => 'text', 'label' => 'Link URL'],
                ]],
                'columns' => ['type' => 'select', 'label' => 'Columns', 'options' => ['2', '3', '4']],
            ],
        ],

        'portfolio' => [
            'name' => 'Portfolio/Projects',
            'description' => 'Showcase your work and projects',
            'icon' => 'heroicons-o-briefcase',
            'view' => 'frontend.sections.portfolio',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Projects', 'fields' => [
                    'image' => ['type' => 'image', 'label' => 'Project Image'],
                    'title' => ['type' => 'text', 'label' => 'Project Title'],
                    'category' => ['type' => 'text', 'label' => 'Category'],
                    'description' => ['type' => 'textarea', 'label' => 'Description'],
                    'url' => ['type' => 'text', 'label' => 'Project URL'],
                ]],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['grid', 'masonry', 'carousel']],
            ],
        ],

        'testimonials' => [
            'name' => 'Testimonials',
            'description' => 'Display client testimonials',
            'icon' => 'heroicons-o-chat-bubble-left-right',
            'view' => 'frontend.sections.testimonials',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Testimonials', 'fields' => [
                    'content' => ['type' => 'textarea', 'label' => 'Testimonial'],
                    'author' => ['type' => 'text', 'label' => 'Author Name'],
                    'position' => ['type' => 'text', 'label' => 'Position/Company'],
                    'avatar' => ['type' => 'image', 'label' => 'Avatar'],
                    'rating' => ['type' => 'number', 'label' => 'Rating (1-5)'],
                ]],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['carousel', 'grid', 'single']],
            ],
        ],

        'team' => [
            'name' => 'Team Members',
            'description' => 'Introduce your team',
            'icon' => 'heroicons-o-user-group',
            'view' => 'frontend.sections.team',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Team Members', 'fields' => [
                    'photo' => ['type' => 'image', 'label' => 'Photo'],
                    'name' => ['type' => 'text', 'label' => 'Name'],
                    'position' => ['type' => 'text', 'label' => 'Position'],
                    'bio' => ['type' => 'textarea', 'label' => 'Bio'],
                    'social_links' => ['type' => 'social', 'label' => 'Social Links'],
                ]],
            ],
        ],

        'pricing' => [
            'name' => 'Pricing Tables',
            'description' => 'Display pricing plans',
            'icon' => 'heroicons-o-currency-dollar',
            'view' => 'frontend.sections.pricing',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Pricing Plans', 'fields' => [
                    'name' => ['type' => 'text', 'label' => 'Plan Name'],
                    'price' => ['type' => 'text', 'label' => 'Price'],
                    'period' => ['type' => 'text', 'label' => 'Period (e.g., /month)'],
                    'description' => ['type' => 'textarea', 'label' => 'Description'],
                    'features' => ['type' => 'textarea', 'label' => 'Features (one per line)'],
                    'cta_text' => ['type' => 'text', 'label' => 'CTA Button Text'],
                    'cta_url' => ['type' => 'text', 'label' => 'CTA Button URL'],
                    'highlighted' => ['type' => 'checkbox', 'label' => 'Highlight this plan'],
                ]],
            ],
        ],

        'cta' => [
            'name' => 'Call to Action',
            'description' => 'Conversion-focused CTA section',
            'icon' => 'heroicons-o-megaphone',
            'view' => 'frontend.sections.cta',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'description' => ['type' => 'textarea', 'label' => 'Description'],
                'cta_text' => ['type' => 'text', 'label' => 'Button Text'],
                'cta_url' => ['type' => 'text', 'label' => 'Button URL'],
                'background_color' => ['type' => 'color', 'label' => 'Background Color'],
                'background_image' => ['type' => 'image', 'label' => 'Background Image'],
            ],
        ],

        'features' => [
            'name' => 'Features',
            'description' => 'Highlight key features',
            'icon' => 'heroicons-o-star',
            'view' => 'frontend.sections.features',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Features', 'fields' => [
                    'icon' => ['type' => 'icon', 'label' => 'Icon'],
                    'title' => ['type' => 'text', 'label' => 'Title'],
                    'description' => ['type' => 'textarea', 'label' => 'Description'],
                ]],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['grid', 'list', 'alternating']],
            ],
        ],

        'stats' => [
            'name' => 'Statistics/Counters',
            'description' => 'Display impressive numbers',
            'icon' => 'heroicons-o-chart-bar',
            'view' => 'frontend.sections.stats',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'items' => ['type' => 'repeater', 'label' => 'Stats', 'fields' => [
                    'number' => ['type' => 'text', 'label' => 'Number'],
                    'suffix' => ['type' => 'text', 'label' => 'Suffix (e.g., +, %)'],
                    'label' => ['type' => 'text', 'label' => 'Label'],
                ]],
                'background_color' => ['type' => 'color', 'label' => 'Background Color'],
            ],
        ],

        'faq' => [
            'name' => 'FAQ',
            'description' => 'Frequently asked questions accordion',
            'icon' => 'heroicons-o-question-mark-circle',
            'view' => 'frontend.sections.faq',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'items' => ['type' => 'repeater', 'label' => 'Questions', 'fields' => [
                    'question' => ['type' => 'text', 'label' => 'Question'],
                    'answer' => ['type' => 'wysiwyg', 'label' => 'Answer'],
                ]],
            ],
        ],

        'contact' => [
            'name' => 'Contact Form',
            'description' => 'Contact form with info',
            'icon' => 'heroicons-o-envelope',
            'view' => 'frontend.sections.contact',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'subtitle' => ['type' => 'text', 'label' => 'Section Subtitle'],
                'address' => ['type' => 'textarea', 'label' => 'Address'],
                'email' => ['type' => 'text', 'label' => 'Email'],
                'phone' => ['type' => 'text', 'label' => 'Phone'],
                'map_embed' => ['type' => 'textarea', 'label' => 'Google Maps Embed Code'],
                'show_form' => ['type' => 'checkbox', 'label' => 'Show Contact Form'],
            ],
        ],

        'gallery' => [
            'name' => 'Image Gallery',
            'description' => 'Display images in a gallery',
            'icon' => 'heroicons-o-photo',
            'view' => 'frontend.sections.gallery',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'items' => ['type' => 'repeater', 'label' => 'Images', 'fields' => [
                    'image' => ['type' => 'image', 'label' => 'Image'],
                    'caption' => ['type' => 'text', 'label' => 'Caption'],
                ]],
                'columns' => ['type' => 'select', 'label' => 'Columns', 'options' => ['2', '3', '4', '5']],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['grid', 'masonry']],
            ],
        ],

        'clients' => [
            'name' => 'Clients/Partners',
            'description' => 'Logo showcase of clients/partners',
            'icon' => 'heroicons-o-building-office',
            'view' => 'frontend.sections.clients',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Section Title'],
                'items' => ['type' => 'repeater', 'label' => 'Logos', 'fields' => [
                    'logo' => ['type' => 'image', 'label' => 'Logo'],
                    'name' => ['type' => 'text', 'label' => 'Company Name'],
                    'url' => ['type' => 'text', 'label' => 'Website URL'],
                ]],
                'style' => ['type' => 'select', 'label' => 'Style', 'options' => ['grid', 'carousel']],
            ],
        ],

        'text_block' => [
            'name' => 'Text Block',
            'description' => 'Rich text content section',
            'icon' => 'heroicons-o-document-text',
            'view' => 'frontend.sections.text-block',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'content' => ['type' => 'wysiwyg', 'label' => 'Content'],
            ],
        ],

        'image_text' => [
            'name' => 'Image with Text',
            'description' => 'Image alongside text content',
            'icon' => 'heroicons-o-rectangle-stack',
            'view' => 'frontend.sections.image-text',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'content' => ['type' => 'wysiwyg', 'label' => 'Content'],
                'image' => ['type' => 'image', 'label' => 'Image'],
                'image_position' => ['type' => 'select', 'label' => 'Image Position', 'options' => ['left', 'right']],
                'cta_text' => ['type' => 'text', 'label' => 'CTA Button Text'],
                'cta_url' => ['type' => 'text', 'label' => 'CTA Button URL'],
            ],
        ],

        'video' => [
            'name' => 'Video Section',
            'description' => 'Embed video content',
            'icon' => 'heroicons-o-play-circle',
            'view' => 'frontend.sections.video',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'description' => ['type' => 'textarea', 'label' => 'Description'],
                'video_url' => ['type' => 'text', 'label' => 'Video URL (YouTube/Vimeo)'],
                'thumbnail' => ['type' => 'image', 'label' => 'Thumbnail Image'],
            ],
        ],

        'newsletter' => [
            'name' => 'Newsletter',
            'description' => 'Email subscription form',
            'icon' => 'heroicons-o-newspaper',
            'view' => 'frontend.sections.newsletter',
            'fields' => [
                'title' => ['type' => 'text', 'label' => 'Title'],
                'description' => ['type' => 'textarea', 'label' => 'Description'],
                'button_text' => ['type' => 'text', 'label' => 'Button Text'],
                'background_color' => ['type' => 'color', 'label' => 'Background Color'],
            ],
        ],

        'custom_html' => [
            'name' => 'Custom HTML',
            'description' => 'Add custom HTML code',
            'icon' => 'heroicons-o-code-bracket',
            'view' => 'frontend.sections.custom-html',
            'fields' => [
                'content' => ['type' => 'code', 'label' => 'HTML Code'],
            ],
        ],
    ],
];
