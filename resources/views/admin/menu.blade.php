@access('statistics')
    @component('menu.menu-item', [
        'name' => 'statistics',
        'icon' => 'icon-gauge',
        'menu' => 'statistics',
        'url' => '/admin'])
    @endcomponent
@endaccess

@access('users')
    @component('menu.menu-item', [
        'name' => 'users',
        'icon' => 'icon-users-3',
        'menu' => 'users',
        'url' => '/admin/users'])
    @endcomponent
@endaccess

@access('mailing')
    @component('menu.menu-item', [
        'name' => 'mailing',
        'icon' => 'icon-mail-4',
        'menu' => 'mailing',
        'url' => '/admin/mailing'])
    @endcomponent
@endaccess

@access('countries')
@component('menu.menu-rolled', [
    'nameItem' => 'countries',
    'icon' => 'icon-map-2',
    'name' => 'countries',
    'items' => [[
           'name' => 'countries_list',
           'menu' => 'countrieslist',
           'url' => '/admin/countries'
        ],[
           'name' => 'countries_add',
           'menu' => 'countriesadd',
           'url' => '/admin/countries/add'
        ]
    ]])
@endcomponent
@endaccess

@access('categories')
@component('menu.menu-rolled', [
    'nameItem' => 'categories',
    'icon' => 'icon-archive',
    'name' => 'categories',
    'items' => [[
           'name' => 'categories_list',
           'menu' => 'categorieslist',
           'url' => '/admin/categories'
        ],[
           'name' => 'categories_add',
           'menu' => 'categoriesadd',
           'url' => '/admin/categories/add'
        ]
    ]])
@endcomponent
@endaccess

@access('channels')
@component('menu.menu-rolled', [
    'nameItem' => 'channels',
    'icon' => 'icon-megaphone-1',
    'name' => 'channels',
    'items' => [[
           'name' => 'channels_list',
           'menu' => 'channelslist',
           'url' => '/admin/channels'
        ],[
           'name' => 'channels_moderation',
           'menu' => 'channelsmoderation',
           'url' => '/admin/channels/moderation/0'
        ], [
           'name' => 'channels_top',
           'menu' => 'channelstop',
           'url' => '/admin/channels/top/0'
        ]
    ]])
@endcomponent
@endaccess

@access('top_list')
    @component('menu.menu-rolled', [
        'nameItem' => 'top_list',
        'icon' => 'icon-up-3',
        'name' => 'top_list',
        'items' => [[
               'name' => 'channels_top_list_by_top',
               'menu' => 'toplisttop',
               'url' => '/admin/topList/top/top'
            ], [
               'name' => 'channels_top_list_by_country',
               'menu' => 'toplistcountry',
               'url' => '/admin/topList/country'
            ], [
               'name' => 'channels_top_list_by_categories',
               'menu' => 'toplistcategory',
               'url' => '/admin/topList/category'
            ]
        ]])
    @endcomponent
@endaccess

@access('moderators')
    @component('menu.menu-rolled', [
        'nameItem' => 'moderators',
        'icon' => 'icon-users-2',
        'name' => 'moderators',
        'items' => [[
               'name' => 'moderators_list',
               'menu' => 'moderatorslist',
               'url' => '/admin/moderators'
            ],[
               'name' => 'moderators_add',
               'menu' => 'moderatorsadd',
               'url' => '/admin/moderators/add'
            ],[
               'name' => 'moderators_permissions',
               'menu' => 'moderatorspermissions',
               'url' => '/admin/moderators/permissions'
            ]
        ]])
    @endcomponent
@endaccess

@access('languages')
    @component('menu.menu-rolled', [
        'nameItem' => 'languages',
        'icon' => 'icon-language-1',
        'name' => 'languages',
        'items' => [[
                'name' => 'languages_list',
                'menu' => 'languageslist',
                'url' => '/admin/languages/list'
            ],[
               'name' => 'languages_add',
               'menu' => 'languagesadd',
               'url' => '/admin/languages/add'
            ]
        ]])
    @endcomponent
@endaccess

@access('contacts')
    @component('menu.menu-rolled', [
        'nameItem' => 'contacts',
        'icon' => 'icon-book',
        'name' => 'contacts',
        'items' => [[
                'name' => 'contacts_general',
                'menu' => 'contactsgeneral',
                'url' => '/admin/contacts/general'
            ],
            [
               'name' => 'contacts_access',
               'menu' => 'contactsaccess',
               'url' => '/admin/contacts/access'
            ],
            [
               'name' => 'contacts_advertising',
               'menu' => 'contactsadvertising',
               'url' => '/admin/contacts/advertising'
            ],[
               'name' => 'contacts_offers',
               'menu' => 'contactsoffers',
               'url' => '/admin/contacts/offers'
            ]
        ]])
    @endcomponent
@endaccess

@access('answers')
    @component('menu.menu-rolled', [
        'nameItem' => 'answers',
        'icon' => 'icon-help-1',
        'name' => 'answers',
        'items' => [[
                'name' => 'answers_list',
                'menu' => 'answerslist',
                'url' => '/admin/answers/list'
            ],[
               'name' => 'answers_add',
               'menu' => 'answersadd',
               'url' => '/admin/answers/add'
            ]
        ]])
    @endcomponent
@endaccess

@access('payment')
    @component('menu.menu-rolled', [
        'nameItem' => 'payment',
        'icon' => 'icon-money-2',
        'name' => 'admin_pay',
        'items' => [[
                'name' => 'admin_qiwi',
                'menu' => 'payqiwi',
                'url' => '/admin/payment/qiwi'
            ],[
               'name' => 'admin_yandex_noney',
               'menu' => 'payyandex',
               'url' => '/admin/payment/yandex'
            ],[
               'name' => 'admin_webmoney',
               'menu' => 'paywebmoney',
               'url' => '/admin/payment/webmoney'
            ],[
               'name' => 'admin_paypal',
               'menu' => 'paypaypal',
               'url' => '/admin/payment/paypal'
            ]
        ]])
    @endcomponent
@endaccess

@access('settings')
    @component('menu.menu-rolled', [
        'nameItem' => 'settings',
        'icon' => 'icon-cog-alt',
        'name' => 'settings',
        'items' => [
            [
            'name' => 'settings_main',
            'menu' => 'settingsmain',
            'url' => '/admin/settings/main'
            ],
            [
               'name' => 'settings_pages',
               'menu' => 'settingspages',
               'url' => '/admin/settings/pages'
            ],[
               'name' => 'settings_buttons',
               'menu' => 'settingsbuttons',
               'url' => '/admin/settings/buttons'
            ]
        ]])
    @endcomponent
@endaccess
