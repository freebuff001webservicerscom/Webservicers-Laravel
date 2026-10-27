<?php

/*
|--------------------------------------------------------------------------
| Generic admin resources
|--------------------------------------------------------------------------
| Each entry powers one sidebar page: a real table backed by the records
| table with create / edit / delete forms generated from `fields`.
*/

return [
    // --- Products -------------------------------------------------------
    'variants' => [
        'label' => 'Variants & options',
        'singular' => 'Variant',
        'description' => 'Plan variations and option bundles offered on service pages.',
        'columns' => ['name' => 'Name', 'service' => 'Service', 'delta' => 'Price delta', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'service' => ['label' => 'Related service'],
            'delta' => ['label' => 'Price delta'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Draft', 'Archived']],
        ],
    ],
    'categories' => [
        'label' => 'Categories',
        'singular' => 'Category',
        'description' => 'The groups used across the site: Presence, Reach, Promote and more.',
        'columns' => ['name' => 'Name', 'slug' => 'Slug', 'sort' => 'Sort', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'slug' => ['label' => 'Slug'],
            'sort' => ['label' => 'Sort order', 'type' => 'number'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Published', 'Draft']],
        ],
    ],
    'attributes' => [
        'label' => 'Attributes',
        'singular' => 'Attribute',
        'description' => 'Reusable attributes such as channel, industry or contract type.',
        'columns' => ['name' => 'Name', 'type' => 'Type', 'values' => 'Values', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'type' => ['label' => 'Type', 'type' => 'select', 'options' => ['Text', 'Number', 'Select', 'Toggle']],
            'values' => ['label' => 'Values', 'hint' => 'Comma separated.'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Draft']],
        ],
    ],
    'brands' => [
        'label' => 'Brands',
        'singular' => 'Brand',
        'description' => 'Partner and client brands featured in work and case studies.',
        'columns' => ['name' => 'Name', 'website' => 'Website', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'website' => ['label' => 'Website'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],
    'collections' => [
        'label' => 'Collections',
        'singular' => 'Collection',
        'description' => 'Curated groups of services shown together on the site.',
        'columns' => ['name' => 'Name', 'description' => 'Description', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Published', 'Draft']],
        ],
    ],
    'tags' => [
        'label' => 'Tags',
        'singular' => 'Tag',
        'description' => 'Tags used to filter content across pages and reports.',
        'columns' => ['name' => 'Name', 'group' => 'Group', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'group' => ['label' => 'Group'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],
    'reviews' => [
        'label' => 'Reviews & ratings',
        'singular' => 'Review',
        'description' => 'Client reviews collected for services across the site.',
        'columns' => ['customer' => 'Customer', 'service' => 'Service', 'rating' => 'Rating', 'status' => 'Status'],
        'fields' => [
            'customer' => ['label' => 'Customer'],
            'service' => ['label' => 'Service'],
            'rating' => ['label' => 'Rating'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Approved', 'Pending', 'Rejected']],
        ],
    ],

    // --- Orders ---------------------------------------------------------
    'fulfillment' => [
        'label' => 'Fulfillment & tracking',
        'singular' => 'Fulfillment',
        'description' => 'Delivery state for every order in progress.',
        'columns' => ['reference' => 'Reference', 'order' => 'Order', 'carrier' => 'Carrier', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'order' => ['label' => 'Order'],
            'carrier' => ['label' => 'Carrier'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Preparing', 'Shipped', 'Delivered', 'Failed']],
        ],
    ],
    'deliveries' => [
        'label' => 'Delivery & shipment tracking',
        'singular' => 'Shipment',
        'description' => 'Live shipments and their destinations.',
        'columns' => ['reference' => 'Reference', 'destination' => 'Destination', 'carrier' => 'Carrier', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'destination' => ['label' => 'Destination'],
            'carrier' => ['label' => 'Carrier'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['In transit', 'Out for delivery', 'Delivered', 'Delayed']],
        ],
    ],
    'carriers' => [
        'label' => 'Carriers & service levels',
        'singular' => 'Carrier',
        'description' => 'Carriers used for physical deliverables such as print and hardware.',
        'columns' => ['name' => 'Name', 'level' => 'Service level', 'zones' => 'Zones', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'level' => ['label' => 'Service level'],
            'zones' => ['label' => 'Zones'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused']],
        ],
    ],
    'returns' => [
        'label' => 'Returns',
        'singular' => 'Return',
        'description' => 'Return requests and their outcomes.',
        'columns' => ['reference' => 'Reference', 'customer' => 'Customer', 'reason' => 'Reason', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'customer' => ['label' => 'Customer'],
            'reason' => ['label' => 'Reason'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Requested', 'Approved', 'Received', 'Rejected']],
        ],
    ],
    'refund_requests' => [
        'label' => 'Refund requests',
        'singular' => 'Refund request',
        'description' => 'Money-back requests waiting on a decision.',
        'columns' => ['reference' => 'Reference', 'customer' => 'Customer', 'amount' => 'Amount', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'customer' => ['label' => 'Customer'],
            'amount' => ['label' => 'Amount'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Pending', 'Approved', 'Declined', 'Refunded']],
        ],
    ],
    'cancellations' => [
        'label' => 'Cancellations',
        'singular' => 'Cancellation',
        'description' => 'Cancelled orders and subscriptions.',
        'columns' => ['reference' => 'Reference', 'customer' => 'Customer', 'reason' => 'Reason', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'customer' => ['label' => 'Customer'],
            'reason' => ['label' => 'Reason'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Requested', 'Processed', 'Declined']],
        ],
    ],
    'abandoned_checkouts' => [
        'label' => 'Abandoned checkouts',
        'singular' => 'Checkout',
        'description' => 'Started but unfinished checkouts worth a follow-up.',
        'columns' => ['reference' => 'Reference', 'customer' => 'Customer', 'value' => 'Value', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'customer' => ['label' => 'Customer'],
            'value' => ['label' => 'Value'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Open', 'Recovered', 'Lost']],
        ],
    ],

    // --- Customers ------------------------------------------------------
    'segments' => [
        'label' => 'Customer segments',
        'singular' => 'Segment',
        'description' => 'Saved groups used by reports and campaigns.',
        'columns' => ['name' => 'Name', 'rule' => 'Rule', 'customers' => 'Customers', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'rule' => ['label' => 'Rule'],
            'customers' => ['label' => 'Customers'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],

    // --- Checkout & pricing --------------------------------------------
    'checkout_experience' => [
        'label' => 'Checkout experience',
        'singular' => 'Checkout rule',
        'description' => 'How the checkout behaves for customers.',
        'columns' => ['name' => 'Rule', 'value' => 'Value', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Rule'],
            'value' => ['label' => 'Value'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Draft']],
        ],
    ],
    'payment_methods' => [
        'label' => 'Checkout payment methods',
        'singular' => 'Payment method',
        'description' => 'Methods customers can use at checkout.',
        'columns' => ['name' => 'Name', 'provider' => 'Provider', 'fee' => 'Fee', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'provider' => ['label' => 'Provider'],
            'fee' => ['label' => 'Fee'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Hidden']],
        ],
    ],
    'coupons' => [
        'label' => 'Coupons',
        'singular' => 'Coupon',
        'description' => 'Discount codes accepted during checkout.',
        'columns' => ['code' => 'Code', 'discount' => 'Discount', 'used' => 'Usage', 'status' => 'Status'],
        'fields' => [
            'code' => ['label' => 'Code'],
            'discount' => ['label' => 'Discount'],
            'used' => ['label' => 'Usage'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Expired', 'Paused']],
        ],
    ],
    'automatic_discounts' => [
        'label' => 'Automatic discounts',
        'singular' => 'Automatic discount',
        'description' => 'Discounts applied without a code.',
        'columns' => ['name' => 'Name', 'rule' => 'Rule', 'value' => 'Value', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'rule' => ['label' => 'Rule'],
            'value' => ['label' => 'Value'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused']],
        ],
    ],
    'promotions' => [
        'label' => 'Promotions',
        'singular' => 'Promotion',
        'description' => 'Time-bound offers running across channels.',
        'columns' => ['name' => 'Name', 'channel' => 'Channel', 'value' => 'Value', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'channel' => ['label' => 'Channel'],
            'value' => ['label' => 'Value'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Scheduled', 'Ended']],
        ],
    ],
    'gift_cards' => [
        'label' => 'Gift cards',
        'singular' => 'Gift card',
        'description' => 'Issued gift cards and their balances.',
        'columns' => ['code' => 'Code', 'balance' => 'Balance', 'recipient' => 'Recipient', 'status' => 'Status'],
        'fields' => [
            'code' => ['label' => 'Code'],
            'balance' => ['label' => 'Balance'],
            'recipient' => ['label' => 'Recipient'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Redeemed', 'Expired']],
        ],
    ],
    'campaigns' => [
        'label' => 'Campaigns',
        'singular' => 'Campaign',
        'description' => 'Paid campaigns driving traffic to the site.',
        'columns' => ['name' => 'Name', 'channel' => 'Channel', 'budget' => 'Budget', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'channel' => ['label' => 'Channel'],
            'budget' => ['label' => 'Budget'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused', 'Ended']],
        ],
    ],

    // --- Online store ---------------------------------------------------
    'menus' => [
        'label' => 'Menus & mega menus',
        'singular' => 'Menu',
        'description' => 'Navigation menus rendered on the public site.',
        'columns' => ['name' => 'Name', 'location' => 'Location', 'items' => 'Items', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'location' => ['label' => 'Location', 'type' => 'select', 'options' => ['Header', 'Footer', 'Mobile']],
            'items' => ['label' => 'Items'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Draft']],
        ],
    ],
    'blog' => [
        'label' => 'Blog posts',
        'singular' => 'Blog post',
        'description' => 'Articles published from the workspace.',
        'columns' => ['title' => 'Title', 'author' => 'Author', 'category' => 'Category', 'status' => 'Status'],
        'fields' => [
            'title' => ['label' => 'Title'],
            'author' => ['label' => 'Author'],
            'category' => ['label' => 'Category'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Published', 'Draft', 'Scheduled']],
        ],
    ],
    'testimonials' => [
        'label' => 'Testimonials',
        'singular' => 'Testimonial',
        'description' => 'Client quotes shown across the site.',
        'columns' => ['customer' => 'Customer', 'company' => 'Company', 'rating' => 'Rating', 'status' => 'Status'],
        'fields' => [
            'customer' => ['label' => 'Customer'],
            'company' => ['label' => 'Company'],
            'rating' => ['label' => 'Rating'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Published', 'Pending', 'Draft']],
        ],
    ],
    'popups' => [
        'label' => 'Popups & announcements',
        'singular' => 'Popup',
        'description' => 'On-site announcements and promotional popups.',
        'columns' => ['name' => 'Name', 'type' => 'Type', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'type' => ['label' => 'Type', 'type' => 'select', 'options' => ['Banner', 'Modal', 'Bar']],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused', 'Draft']],
        ],
    ],
    'faqs' => [
        'label' => 'FAQ library',
        'singular' => 'FAQ',
        'description' => 'Questions and answers reused across service pages.',
        'columns' => ['question' => 'Question', 'category' => 'Category', 'status' => 'Status'],
        'fields' => [
            'question' => ['label' => 'Question'],
            'category' => ['label' => 'Category'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Published', 'Draft']],
        ],
    ],

    // --- Payments -------------------------------------------------------
    'transactions' => [
        'label' => 'Transactions',
        'singular' => 'Transaction',
        'description' => 'Every charge processed through the store.',
        'columns' => ['reference' => 'Reference', 'customer' => 'Customer', 'amount' => 'Amount', 'method' => 'Method', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'customer' => ['label' => 'Customer'],
            'amount' => ['label' => 'Amount'],
            'method' => ['label' => 'Method', 'type' => 'select', 'options' => ['Card', 'SEPA', 'PayPal', 'Invoice']],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Succeeded', 'Pending', 'Failed', 'Refunded']],
        ],
    ],
    'payment_providers' => [
        'label' => 'Payment providers',
        'singular' => 'Provider',
        'description' => 'Providers connected to the checkout.',
        'columns' => ['name' => 'Name', 'mode' => 'Mode', 'fee' => 'Fee', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'mode' => ['label' => 'Mode', 'type' => 'select', 'options' => ['Live', 'Test']],
            'fee' => ['label' => 'Fee'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Connected', 'Not connected']],
        ],
    ],
    'settlements' => [
        'label' => 'Settlements',
        'singular' => 'Settlement',
        'description' => 'Payouts deposited to the business account.',
        'columns' => ['reference' => 'Reference', 'amount' => 'Amount', 'date' => 'Date', 'status' => 'Status'],
        'fields' => [
            'reference' => ['label' => 'Reference'],
            'amount' => ['label' => 'Amount'],
            'date' => ['label' => 'Date'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Paid', 'In transit', 'Expected']],
        ],
    ],
    'payment_links' => [
        'label' => 'Payment links',
        'singular' => 'Payment link',
        'description' => 'Shareable links that open checkout with an amount preset.',
        'columns' => ['name' => 'Name', 'amount' => 'Amount', 'clicks' => 'Clicks', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'amount' => ['label' => 'Amount'],
            'clicks' => ['label' => 'Clicks'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Disabled']],
        ],
    ],

    // --- Communication --------------------------------------------------
    'tickets' => [
        'label' => 'Support tickets',
        'singular' => 'Ticket',
        'description' => 'Support conversations with clients.',
        'columns' => ['subject' => 'Subject', 'requester' => 'Requester', 'priority' => 'Priority', 'status' => 'Status'],
        'fields' => [
            'subject' => ['label' => 'Subject'],
            'requester' => ['label' => 'Requester'],
            'priority' => ['label' => 'Priority', 'type' => 'select', 'options' => ['Low', 'Normal', 'High', 'Urgent']],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Open', 'Pending', 'Resolved', 'Closed']],
        ],
    ],
    'email' => [
        'label' => 'Email workspace',
        'singular' => 'Email',
        'description' => 'Outgoing campaigns and one-to-one sends.',
        'columns' => ['subject' => 'Subject', 'audience' => 'Audience', 'opens' => 'Opens', 'status' => 'Status'],
        'fields' => [
            'subject' => ['label' => 'Subject'],
            'audience' => ['label' => 'Audience'],
            'opens' => ['label' => 'Opens'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Sent', 'Draft', 'Scheduled']],
        ],
    ],
    'email_templates' => [
        'label' => 'Message templates',
        'singular' => 'Template',
        'description' => 'Reusable templates for transactional email.',
        'columns' => ['name' => 'Name', 'subject' => 'Subject', 'updated' => 'Updated', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'subject' => ['label' => 'Subject'],
            'updated' => ['label' => 'Updated'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Draft']],
        ],
    ],

    // --- WebServicers AI -------------------------------------------------
    'ai_workflows' => [
        'label' => 'AI workflows',
        'singular' => 'Workflow',
        'description' => 'Automated flows that draft replies and route work.',
        'columns' => ['name' => 'Name', 'trigger' => 'Trigger', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'trigger' => ['label' => 'Trigger'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused', 'Draft']],
        ],
    ],
    'ai_studio' => [
        'label' => 'AI studio',
        'singular' => 'Generation',
        'description' => 'Saved generations for copy, ads and page drafts.',
        'columns' => ['name' => 'Name', 'model' => 'Model', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'model' => ['label' => 'Model'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Saved', 'Discarded']],
        ],
    ],
    'ai_voice' => [
        'label' => 'Voice & product assist',
        'singular' => 'Voice agent',
        'description' => 'Voice assistant configuration for product questions.',
        'columns' => ['name' => 'Agent', 'language' => 'Language', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'language' => ['label' => 'Language'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Disabled']],
        ],
    ],
    'ai_knowledge' => [
        'label' => 'AI knowledge',
        'singular' => 'Knowledge source',
        'description' => 'Documents and pages the assistants can cite.',
        'columns' => ['name' => 'Source', 'type' => 'Type', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'type' => ['label' => 'Type', 'type' => 'select', 'options' => ['Page', 'Document', 'URL']],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Indexed', 'Indexing', 'Failed']],
        ],
    ],
    'ai_prompts' => [
        'label' => 'Prompt library',
        'singular' => 'Prompt',
        'description' => 'Reusable prompts for the team.',
        'columns' => ['name' => 'Name', 'category' => 'Category', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'category' => ['label' => 'Category'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],
    'ai_rules' => [
        'label' => 'AI reply rules',
        'singular' => 'Reply rule',
        'description' => 'Rules the AI follows when replying to messages.',
        'columns' => ['name' => 'Name', 'action' => 'Action', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'action' => ['label' => 'Action'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Disabled']],
        ],
    ],
    'ai_history' => [
        'label' => 'AI activity & usage',
        'singular' => 'AI run',
        'description' => 'History of assistant runs and their cost.',
        'columns' => ['task' => 'Task', 'model' => 'Model', 'cost' => 'Cost', 'status' => 'Status'],
        'fields' => [
            'task' => ['label' => 'Task'],
            'model' => ['label' => 'Model'],
            'cost' => ['label' => 'Cost'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Succeeded', 'Failed']],
        ],
    ],

    // --- Media & files ---------------------------------------------------
    'media' => [
        'label' => 'Media library',
        'singular' => 'Media file',
        'description' => 'Images and assets used across the site.',
        'columns' => ['name' => 'File', 'type' => 'Type', 'size' => 'Size', 'status' => 'Usage'],
        'fields' => [
            'name' => ['label' => 'File name'],
            'type' => ['label' => 'Type'],
            'size' => ['label' => 'Size'],
            'status' => ['label' => 'Usage'],
        ],
    ],
    'files' => [
        'label' => 'File manager',
        'singular' => 'File',
        'description' => 'Documents, exports and backups.',
        'columns' => ['name' => 'File', 'folder' => 'Folder', 'size' => 'Size', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'File name'],
            'folder' => ['label' => 'Folder'],
            'size' => ['label' => 'Size'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Stored', 'Trashed']],
        ],
    ],

    // --- Workspace -------------------------------------------------------
    'roles' => [
        'label' => 'Roles',
        'singular' => 'Role',
        'description' => 'Access roles assigned to team members.',
        'columns' => ['name' => 'Role', 'members' => 'Members', 'access' => 'Access', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'members' => ['label' => 'Members'],
            'access' => ['label' => 'Access'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],
    'permissions' => [
        'label' => 'Permission matrix',
        'singular' => 'Permission',
        'description' => 'Which roles can touch which modules.',
        'columns' => ['module' => 'Module', 'role' => 'Role', 'access' => 'Access', 'status' => 'Status'],
        'fields' => [
            'module' => ['label' => 'Module'],
            'role' => ['label' => 'Role'],
            'access' => ['label' => 'Access', 'type' => 'select', 'options' => ['Full', 'Edit', 'Read', 'None']],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Granted', 'Denied']],
        ],
    ],
    'teams' => [
        'label' => 'Teams',
        'singular' => 'Team',
        'description' => 'Groups of people working together.',
        'columns' => ['name' => 'Team', 'lead' => 'Lead', 'members' => 'Members', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'lead' => ['label' => 'Lead'],
            'members' => ['label' => 'Members'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Archived']],
        ],
    ],

    // --- Integrations -----------------------------------------------------
    'integrations' => [
        'label' => 'API connections',
        'singular' => 'Connection',
        'description' => 'Third-party services connected to the workspace.',
        'columns' => ['name' => 'Service', 'type' => 'Type', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'type' => ['label' => 'Type'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Connected', 'Not connected', 'Error']],
        ],
    ],
    'webhooks' => [
        'label' => 'Webhooks',
        'singular' => 'Webhook',
        'description' => 'Endpoints notified when events happen.',
        'columns' => ['name' => 'Name', 'event' => 'Event', 'url' => 'URL', 'status' => 'Status'],
        'fields' => [
            'name' => ['label' => 'Name'],
            'event' => ['label' => 'Event'],
            'url' => ['label' => 'URL'],
            'status' => ['label' => 'Status', 'type' => 'select', 'options' => ['Active', 'Paused']],
        ],
    ],
];
