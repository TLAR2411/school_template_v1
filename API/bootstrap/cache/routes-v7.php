<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/hosts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.hosts',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/folders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.folders',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/clear-cache-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.clear-cache-all',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/delete-multiple-files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.delete-multiple-files',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/log-viewer/api/logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.logs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lon7A8HVgt8RADyG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/refresh' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OTzbWUz9biw2TWF1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/img' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hyU4QWgAEdlSOL1Y',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/bootstrap' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OXekbW5wQuoM5QUL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/change-user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TzABJAzzSQsRYWmt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::feWwbiO5TNj8Tzap',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/export-excel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BOrcAZjn57iKERzG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/cache-clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DfognNGpcuSRwURn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/accounting-dashboard-summary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jDb7iNIhKVb3z5jG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/accounting-dashboard-income-expense-profit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qdvhPioQiADtFNTj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kkHwoe5mZpS06rxp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lpjbww9yB1GoEl80',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Mqm0EoZwJRy08Sqi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JwVHCwiPJ4DwFbqX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::792CWXT1V9qAYJc1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5Hojz5c7ZJPAQh0E',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/provinces-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ztLCaslJN3VMtjUf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Qc0CiclOfbpU5ra9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4gjNLytzgrpodnWB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::drF9qESczoSA8LdH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F8ADwpYsWuO268tN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qBpmky5cedSxq3C5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KGZMBx0iuUvlft3j',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/districts-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5FZ8jMnWJpRyLtR0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EonVXP6AqYqOdoBZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kRUR4oMeOrVtZhpo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::b6wuh1o0yTHFcWRd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nPsSis2iL2HlvZQa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::p0ql4Y85wViRppxl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Woc0opDZmFu9g5Xn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/communes-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VSOXdjJrmL3ZXoqK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UlcXyZLAakFOpajD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FRQgBVCRfW67Ctam',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qcMnR96KwMrgTarX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BQwc1DWA6ifpZMyG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XjoH5f9AMfbEFEUb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Om01b1Vm6lEuc4e2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/villages-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5ZLEqhxB2IZYIYkr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/admin-dashboards' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aOY2UL5Ubt7yMIO8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/activity-log-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::f2laPxxkCBwAJ3iG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/activity-log-delete-by-date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q3S3hYbtVLcvhowf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-get-co' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YcUbY0EBIOWLbtbB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-get-approver' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::do91DxwpJrfJ9Tem',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oiIJKlJoj5CuuvB7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-all-under-users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2TLsdhOi9wlywu1a',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ux2vd93SoZ2z9SRV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t5C7oloD53WncyBf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::A6TZj3O98APfAKZU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qf9WtqbApZWE1BVK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Den1nVp5mZPCCDNu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3Qmw7ckh8X9Tjv1V',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B7VqMs2BdpeT8Rje',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-permission' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pV5bpwwXIHAuvZvS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-change-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9jmFahX9VodubsuX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-change-username-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F7UcYU5itDAX27SL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-change-image-path' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qZo1fOOQID91JsJb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/users-link-user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sL7emWbPL5DNWCT0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qb0ix9xUbglzM8nK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0W35yppXLnJrS0IX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QVeXEAJ2CzXz0IOs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8g6DlcvGi8Pwwxsf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hjQC9WOjgay9YMvH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OiaQnJg3PdxApPnz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/branches-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ylxWIFYVaeENitln',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/currencies-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2OjM4csrjSvuAZsq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/currencies-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::a411hzGi6TShVsxp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/currencies-default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YbcapuuIgsVx56ao',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uIdBcMG8KpWMkgcO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kx5hiCwGVX5XPTIO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8TFD2xcGnHSI1m8z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rG4HD3pp5AjYvm2r',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::l3uerDrbg68ogUoZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/roles-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PewYHo09jCcdQJYl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HeEpAzALiFbpK6C7',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aJpl2JqmMISdWMuo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Sh9Io9f37hTLNDvY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oTJYTHHgvrgxfmrT',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kxAVfoIndXdchoSX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/positions-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JgyQyYOry6qVPU3G',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YRsVzZJe8XI8wpCn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tRrYNpi6za9II2h2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3OtczqwtPgb0zAgv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FnGb70xXWsLVDBxM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hv3T4AmOADgoB9ag',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/permissions-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::R7IpUa3BsGAJCmxV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/loans-dashboard-daily-result' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EGqs9gO7ac98XGWT',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/loans-dashboard-monthly-result' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WkP440HqERpKSNDL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/loans-dashboard-all-loans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RD1jxSXo0Mba0lgC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/loans-dashboard-daily-plan-and-collected' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eeO9oBWwjsrbk6wk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/loans-dashboard-late-overdue-repayment-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::faZt0AlQX8Kw0s78',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/hr-dashboards' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eCKF13EI9z3QdFC5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wNCCVXTA9eLQujXe',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HdQJrsO38ktPqky4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OdIGRionUw4z2YKv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sU09J4jHx3hHEpVy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ApI3JS8qAMrhyJrp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g7sbn9yeQ7Q4cSl2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-activity-type-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wtjAFvOl0wgiR1VA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::77VIsLCLoPiwOGVu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8mKDRln5VeiDUrD0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3OBipvKrUeR8heG4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-delete_subject' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wOUfaQvOBIBGocVG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1jfcmbrNTY3UNnWV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-classes-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cLfe0PLZmQvvf7OW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UAl1ZZe0ZeNDDfJ3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::C6IhF1UXDIhhOQBN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XSCVcYaEceX4pX2r',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RRMuSV2jIw07C8vj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zlenDGYxQCel2kca',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fFeS0u2bRlFHXE5B',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/subjects-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BKpQcoVJLk5sowCf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Iv8hplGzor79SIsL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dX2ffHdksBQF37n0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0hflUMlsGCO9U3Wp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rGRsOMo388UMp7c0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H78oVv9fgOecqP5L',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dJfWsAslTlVygNHW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/students-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2BMDQuEnRfpfIMCj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dvNFIup7dOufwMG2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::COMwMwvf80jQqIQO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bSEyOEF8W0fS3Dpk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8z8EGASGhBXL3kJR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ou9WoLVhmGTcC6IV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KZOCMtJXf6eoAa8r',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/curriculums-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g6qQeZOxveGVunJK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qK9UDR49f2g4Foij',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7Mu2MNZsCpEdYcpR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bItLcCNUyLwrzlfo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hpO4ofyzTLHfC9SA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GggcVxZOYCFrF6rE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nkiYw4mjTYmyHgE8',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/years-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::58kyKVJcAHB5VUwl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-not-yet-enroll' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qslW6pUXMxZCQ5Fp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-enroll-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::R8mq9YfSvL5YZ153',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-enroll-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3wtH48isvXkWquqh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Iilx5CPuPZ5icPsm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cJt6dmOYvGyr9cwB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iZUWYCczUg4djWvI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ygLW27mzdUVBjheL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::USZQz1uAlklkrvNI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KUw9H0VPAXv7J9lN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/education-levels-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OUItpIIe23TCTOVu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P52ydmWGCnEPNwG3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1VELxBpiS34FfAdk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5K4Pm6arZTdaGFiG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NU7C8TEDXqdipgOg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RNwWsK5yAkUaoY59',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Kd9MRUwM4wdtNPIW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/rooms-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VaekLLI3SmNovwXL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hvPMvHHdv2APYKUI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hQBXzCQxSRo09Vqq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5o18LikMWkCk3R1Z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::92QVkIZwu6xfIjhg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dvRHLJucGTnBleAW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TF49MIivMLNVNxVd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grades-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bVcsoZ404sJ4yayo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qZepxTCG2hQJlChR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Dl60eKToShc58l7X',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SQUfBHDZxVdhTCrH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Q2pwgvDlg6vfWErz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kh60rVXMqwcmqNTB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lNe7IbjLqW5Zx8fy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MzyG0UdMVYocG8FO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::a1HjiJngOo26GyTc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/classes-type-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hBPl95RhCZvUNb0C',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MelRPG4iV3FlKCyN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PQ4n5i7lbHXIWn7D',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NPRoBtvlDSNENdoD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LtpRg0UwkG8J0DU0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OZO4Fj4i3fZQRwfH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HFf3TvsjYJrLyrCI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/teachers-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iYlXZwIkzmmUiEIj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-not-yet-enroll-class' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RiQ6Gyav28gObz6l',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-class-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NBIsAwxBkLP2nM4x',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-class-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TErYkMvFSdqlzOVY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grading-rules-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aL98Hs33DFXmteEf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grading-rules-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yuMgx4MJrdIfWS7J',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grading-rules-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::X3JBssC510PUy67x',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/grading-rules-subjects' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::53xb8JaySc5wGBAz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/assessments-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y7Q1bO0ck6dYsBmI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/assessments-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0DzaX8ggaKEW32FY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/families-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Uq6x3j6QiMLb7E2W',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/families-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::v1moTHCu5FQ9q6KL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/families-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mSlAjsT3rMSnSUNk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/families-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gRI8Dl6lcqFj9Pka',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-family-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0QGXp5UKdmgwzqGx',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-family-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::htg5E5MY2gDDvUek',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/family-members-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4wllsp4X32T2uGfx',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/family-members-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aLxmD6b3VrZB3AJe',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/family-members-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hxYDzKFzJvzoCrvG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/family-members-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yDL8348W3qaZm9ly',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZnOWNRgUczLTUDYl',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xpIJICDiFkBtmUMU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/img' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vdso9k8BWfXHK48X',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/h2c-proxy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IMbkKPaOb502e0kz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6kZwgmgbFvEKmxP0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/log\\-viewer(?|/api/f(?|olders/([^/]++)(?|/(?|download(?|/request(*:72)|(*:79))|clear\\-cache(*:99))|(*:107))|iles/([^/]++)(?|/(?|download(?|/request(*:155)|(*:163))|clear\\-cache(*:184))|(*:193)))|(?:/((?:.*)))?(*:217))|/storage/(.*)(*:239))/?$}sDu',
    ),
    3 => 
    array (
      72 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.folders.request-download',
          ),
          1 => 
          array (
            0 => 'folderIdentifier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      79 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.folders.download',
          ),
          1 => 
          array (
            0 => 'folderIdentifier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      99 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.folders.clear-cache',
          ),
          1 => 
          array (
            0 => 'folderIdentifier',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      107 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.folders.delete',
          ),
          1 => 
          array (
            0 => 'folderIdentifier',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      155 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.request-download',
          ),
          1 => 
          array (
            0 => 'fileIdentifier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.download',
          ),
          1 => 
          array (
            0 => 'fileIdentifier',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      184 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.clear-cache',
          ),
          1 => 
          array (
            0 => 'fileIdentifier',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      193 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.files.delete',
          ),
          1 => 
          array (
            0 => 'fileIdentifier',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      217 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'log-viewer.index',
            'view' => NULL,
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      239 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.hosts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/hosts',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\HostsController@index',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\HostsController@index',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.hosts',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.folders' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/folders',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@index',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@index',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.folders',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.folders.request-download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/folders/{folderIdentifier}/download/request',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@requestDownload',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@requestDownload',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.folders.request-download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.folders.clear-cache' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'log-viewer/api/folders/{folderIdentifier}/clear-cache',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@clearCache',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@clearCache',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.folders.clear-cache',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.folders.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'log-viewer/api/folders/{folderIdentifier}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@delete',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@delete',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.folders.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/files',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@index',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@index',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.request-download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/files/{fileIdentifier}/download/request',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@requestDownload',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@requestDownload',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.request-download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.clear-cache' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'log-viewer/api/files/{fileIdentifier}/clear-cache',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@clearCache',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@clearCache',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.clear-cache',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'log-viewer/api/files/{fileIdentifier}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@delete',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@delete',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.clear-cache-all' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'log-viewer/api/clear-cache-all',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@clearCacheAll',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@clearCacheAll',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.clear-cache-all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.delete-multiple-files' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'log-viewer/api/delete-multiple-files',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@deleteMultipleFiles',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@deleteMultipleFiles',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.delete-multiple-files',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.logs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/logs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Opcodes\\LogViewer\\Http\\Middleware\\ForwardRequestToHostMiddleware',
          3 => 'Opcodes\\LogViewer\\Http\\Middleware\\JsonResourceWithoutWrappingMiddleware',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\LogsController@index',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\LogsController@index',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.logs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.folders.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/folders/{folderIdentifier}/download',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Illuminate\\Routing\\Middleware\\ValidateSignature',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@download',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FoldersController@download',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.folders.download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.files.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/api/files/{fileIdentifier}/download',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Opcodes\\LogViewer\\Http\\Middleware\\EnsureFrontendRequestsAreStateful',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
          2 => 'Illuminate\\Routing\\Middleware\\ValidateSignature',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@download',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\FilesController@download',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer/api',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.files.download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'log-viewer.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'log-viewer/{view?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
          1 => 'Opcodes\\LogViewer\\Http\\Middleware\\AuthorizeLogViewer',
        ),
        'uses' => 'Opcodes\\LogViewer\\Http\\Controllers\\IndexController@__invoke',
        'controller' => 'Opcodes\\LogViewer\\Http\\Controllers\\IndexController',
        'namespace' => 'Opcodes\\LogViewer\\Http\\Controllers',
        'prefix' => 'log-viewer',
        'where' => 
        array (
        ),
        'as' => 'log-viewer.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'view' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Lon7A8HVgt8RADyG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@login',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Lon7A8HVgt8RADyG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OTzbWUz9biw2TWF1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/refresh',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@refresh',
        'controller' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@refresh',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OTzbWUz9biw2TWF1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hyU4QWgAEdlSOL1Y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/web/img',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\ImageController@resize',
        'controller' => 'App\\Http\\Controllers\\ImageController@resize',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hyU4QWgAEdlSOL1Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OXekbW5wQuoM5QUL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/web/bootstrap',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@bootstrap',
        'controller' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@bootstrap',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OXekbW5wQuoM5QUL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TzABJAzzSQsRYWmt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/change-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@changeUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@changeUser',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TzABJAzzSQsRYWmt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::feWwbiO5TNj8Tzap' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\Auth\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::feWwbiO5TNj8Tzap',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BOrcAZjn57iKERzG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/export-excel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\ExportController@exportExcel',
        'controller' => 'App\\Http\\Controllers\\ExportController@exportExcel',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::BOrcAZjn57iKERzG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DfognNGpcuSRwURn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/cache-clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CacheController@clear',
        'controller' => 'App\\Http\\Controllers\\Api\\CacheController@clear',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::DfognNGpcuSRwURn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jDb7iNIhKVb3z5jG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/accounting-dashboard-summary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Accounting\\AccountingDashboardController@summary',
        'controller' => 'App\\Http\\Controllers\\Api\\Accounting\\AccountingDashboardController@summary',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::jDb7iNIhKVb3z5jG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qdvhPioQiADtFNTj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/accounting-dashboard-income-expense-profit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Accounting\\AccountingDashboardController@incomeExpenseProfit',
        'controller' => 'App\\Http\\Controllers\\Api\\Accounting\\AccountingDashboardController@incomeExpenseProfit',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qdvhPioQiADtFNTj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kkHwoe5mZpS06rxp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kkHwoe5mZpS06rxp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lpjbww9yB1GoEl80' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::lpjbww9yB1GoEl80',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Mqm0EoZwJRy08Sqi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-provinces',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Mqm0EoZwJRy08Sqi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JwVHCwiPJ4DwFbqX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-provinces',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JwVHCwiPJ4DwFbqX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::792CWXT1V9qAYJc1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-provinces',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::792CWXT1V9qAYJc1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5Hojz5c7ZJPAQh0E' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-provinces',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5Hojz5c7ZJPAQh0E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ztLCaslJN3VMtjUf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/provinces-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\ProvinceController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ztLCaslJN3VMtjUf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Qc0CiclOfbpU5ra9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Qc0CiclOfbpU5ra9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4gjNLytzgrpodnWB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::4gjNLytzgrpodnWB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::drF9qESczoSA8LdH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-districts',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::drF9qESczoSA8LdH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F8ADwpYsWuO268tN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-districts',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::F8ADwpYsWuO268tN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qBpmky5cedSxq3C5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-districts',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qBpmky5cedSxq3C5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KGZMBx0iuUvlft3j' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:password-districts',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::KGZMBx0iuUvlft3j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5FZ8jMnWJpRyLtR0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/districts-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\DistrictController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5FZ8jMnWJpRyLtR0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EonVXP6AqYqOdoBZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::EonVXP6AqYqOdoBZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kRUR4oMeOrVtZhpo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kRUR4oMeOrVtZhpo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::b6wuh1o0yTHFcWRd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-communes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::b6wuh1o0yTHFcWRd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nPsSis2iL2HlvZQa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-communes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::nPsSis2iL2HlvZQa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p0ql4Y85wViRppxl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-communes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::p0ql4Y85wViRppxl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Woc0opDZmFu9g5Xn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-communes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Woc0opDZmFu9g5Xn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VSOXdjJrmL3ZXoqK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/communes-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\CommuneController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::VSOXdjJrmL3ZXoqK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UlcXyZLAakFOpajD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::UlcXyZLAakFOpajD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FRQgBVCRfW67Ctam' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::FRQgBVCRfW67Ctam',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qcMnR96KwMrgTarX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-villages',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qcMnR96KwMrgTarX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BQwc1DWA6ifpZMyG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-villages',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::BQwc1DWA6ifpZMyG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XjoH5f9AMfbEFEUb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-villages',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::XjoH5f9AMfbEFEUb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Om01b1Vm6lEuc4e2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-villages',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Om01b1Vm6lEuc4e2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5ZLEqhxB2IZYIYkr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/villages-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\Address\\VillageController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5ZLEqhxB2IZYIYkr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aOY2UL5Ubt7yMIO8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/admin-dashboards',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AdminDashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\AdminDashboardController@index',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::aOY2UL5Ubt7yMIO8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::f2laPxxkCBwAJ3iG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/activity-log-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-activity-log',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ActivityLogController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\ActivityLogController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::f2laPxxkCBwAJ3iG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q3S3hYbtVLcvhowf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/activity-log-delete-by-date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-activity-log',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ActivityLogController@deleteByDate',
        'controller' => 'App\\Http\\Controllers\\Api\\ActivityLogController@deleteByDate',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Q3S3hYbtVLcvhowf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YcUbY0EBIOWLbtbB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-get-co',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@getCo',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@getCo',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YcUbY0EBIOWLbtbB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::do91DxwpJrfJ9Tem' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-get-approver',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@getApprover',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@getApprover',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::do91DxwpJrfJ9Tem',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oiIJKlJoj5CuuvB7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::oiIJKlJoj5CuuvB7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2TLsdhOi9wlywu1a' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-all-under-users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@allUnderUsers',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@allUnderUsers',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::2TLsdhOi9wlywu1a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ux2vd93SoZ2z9SRV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Ux2vd93SoZ2z9SRV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t5C7oloD53WncyBf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-users',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::t5C7oloD53WncyBf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::A6TZj3O98APfAKZU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-users',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::A6TZj3O98APfAKZU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qf9WtqbApZWE1BVK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-users',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qf9WtqbApZWE1BVK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Den1nVp5mZPCCDNu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-users',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Den1nVp5mZPCCDNu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3Qmw7ckh8X9Tjv1V' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:change-active-users',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::3Qmw7ckh8X9Tjv1V',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B7VqMs2BdpeT8Rje' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@password',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@password',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::B7VqMs2BdpeT8Rje',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pV5bpwwXIHAuvZvS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-permission',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@permission',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@permission',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::pV5bpwwXIHAuvZvS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9jmFahX9VodubsuX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-change-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@changePassword',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@changePassword',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::9jmFahX9VodubsuX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F7UcYU5itDAX27SL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-change-username-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@changeUsernameEmail',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@changeUsernameEmail',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::F7UcYU5itDAX27SL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qZo1fOOQID91JsJb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-change-image-path',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@changeImagePath',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@changeImagePath',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qZo1fOOQID91JsJb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sL7emWbPL5DNWCT0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/users-link-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@linkUser',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@linkUser',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::sL7emWbPL5DNWCT0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qb0ix9xUbglzM8nK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qb0ix9xUbglzM8nK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0W35yppXLnJrS0IX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::0W35yppXLnJrS0IX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QVeXEAJ2CzXz0IOs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-branches',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::QVeXEAJ2CzXz0IOs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8g6DlcvGi8Pwwxsf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-branches',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::8g6DlcvGi8Pwwxsf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hjQC9WOjgay9YMvH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-branches',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hjQC9WOjgay9YMvH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OiaQnJg3PdxApPnz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-branches',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OiaQnJg3PdxApPnz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ylxWIFYVaeENitln' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/branches-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BranchController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\BranchController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ylxWIFYVaeENitln',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2OjM4csrjSvuAZsq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/currencies-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CurrencyController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\CurrencyController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::2OjM4csrjSvuAZsq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a411hzGi6TShVsxp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/currencies-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CurrencyController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\CurrencyController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::a411hzGi6TShVsxp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YbcapuuIgsVx56ao' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/currencies-default',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CurrencyController@setDefault',
        'controller' => 'App\\Http\\Controllers\\Api\\CurrencyController@setDefault',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YbcapuuIgsVx56ao',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uIdBcMG8KpWMkgcO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::uIdBcMG8KpWMkgcO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kx5hiCwGVX5XPTIO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kx5hiCwGVX5XPTIO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8TFD2xcGnHSI1m8z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-roles',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::8TFD2xcGnHSI1m8z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rG4HD3pp5AjYvm2r' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-roles',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::rG4HD3pp5AjYvm2r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::l3uerDrbg68ogUoZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-roles',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::l3uerDrbg68ogUoZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PewYHo09jCcdQJYl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/roles-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-roles',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\RoleController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::PewYHo09jCcdQJYl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HeEpAzALiFbpK6C7' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::HeEpAzALiFbpK6C7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aJpl2JqmMISdWMuo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::aJpl2JqmMISdWMuo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Sh9Io9f37hTLNDvY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-positions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Sh9Io9f37hTLNDvY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oTJYTHHgvrgxfmrT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-positions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::oTJYTHHgvrgxfmrT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kxAVfoIndXdchoSX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-positions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kxAVfoIndXdchoSX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JgyQyYOry6qVPU3G' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/positions-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-positions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PositionController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JgyQyYOry6qVPU3G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YRsVzZJe8XI8wpCn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YRsVzZJe8XI8wpCn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tRrYNpi6za9II2h2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::tRrYNpi6za9II2h2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3OtczqwtPgb0zAgv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:view-permissions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::3OtczqwtPgb0zAgv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FnGb70xXWsLVDBxM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:add-permissions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::FnGb70xXWsLVDBxM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hv3T4AmOADgoB9ag' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:edit-permissions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hv3T4AmOADgoB9ag',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::R7IpUa3BsGAJCmxV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/permissions-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'auth:api',
          3 => 'permission:delete-permissions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::R7IpUa3BsGAJCmxV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EGqs9gO7ac98XGWT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/loans-dashboard-daily-result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@dailyResult',
        'controller' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@dailyResult',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::EGqs9gO7ac98XGWT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WkP440HqERpKSNDL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/loans-dashboard-monthly-result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@monthlyResult',
        'controller' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@monthlyResult',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::WkP440HqERpKSNDL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RD1jxSXo0Mba0lgC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/loans-dashboard-all-loans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@allLoans',
        'controller' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@allLoans',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::RD1jxSXo0Mba0lgC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eeO9oBWwjsrbk6wk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/loans-dashboard-daily-plan-and-collected',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@dailyPlanAndCollected',
        'controller' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@dailyPlanAndCollected',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::eeO9oBWwjsrbk6wk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::faZt0AlQX8Kw0s78' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/loans-dashboard-late-overdue-repayment-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@lateAndOverdueRepaymentStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\Loan\\DashboardController@lateAndOverdueRepaymentStatus',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::faZt0AlQX8Kw0s78',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eCKF13EI9z3QdFC5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/hr-dashboards',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Hr\\DashboardController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\Hr\\DashboardController@index',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::eCKF13EI9z3QdFC5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wNCCVXTA9eLQujXe' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::wNCCVXTA9eLQujXe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HdQJrsO38ktPqky4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::HdQJrsO38ktPqky4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OdIGRionUw4z2YKv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OdIGRionUw4z2YKv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sU09J4jHx3hHEpVy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::sU09J4jHx3hHEpVy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ApI3JS8qAMrhyJrp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ApI3JS8qAMrhyJrp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g7sbn9yeQ7Q4cSl2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::g7sbn9yeQ7Q4cSl2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wtjAFvOl0wgiR1VA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-activity-type-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::wtjAFvOl0wgiR1VA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::77VIsLCLoPiwOGVu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::77VIsLCLoPiwOGVu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8mKDRln5VeiDUrD0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::8mKDRln5VeiDUrD0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3OBipvKrUeR8heG4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::3OBipvKrUeR8heG4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wOUfaQvOBIBGocVG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-delete_subject',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete_subject',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete_subject',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::wOUfaQvOBIBGocVG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1jfcmbrNTY3UNnWV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::1jfcmbrNTY3UNnWV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cLfe0PLZmQvvf7OW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-classes-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::cLfe0PLZmQvvf7OW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UAl1ZZe0ZeNDDfJ3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::UAl1ZZe0ZeNDDfJ3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::C6IhF1UXDIhhOQBN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::C6IhF1UXDIhhOQBN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XSCVcYaEceX4pX2r' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::XSCVcYaEceX4pX2r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RRMuSV2jIw07C8vj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::RRMuSV2jIw07C8vj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zlenDGYxQCel2kca' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::zlenDGYxQCel2kca',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fFeS0u2bRlFHXE5B' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::fFeS0u2bRlFHXE5B',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BKpQcoVJLk5sowCf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subjects-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::BKpQcoVJLk5sowCf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Iv8hplGzor79SIsL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Iv8hplGzor79SIsL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dX2ffHdksBQF37n0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::dX2ffHdksBQF37n0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0hflUMlsGCO9U3Wp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::0hflUMlsGCO9U3Wp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rGRsOMo388UMp7c0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::rGRsOMo388UMp7c0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H78oVv9fgOecqP5L' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::H78oVv9fgOecqP5L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dJfWsAslTlVygNHW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::dJfWsAslTlVygNHW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2BMDQuEnRfpfIMCj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::2BMDQuEnRfpfIMCj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dvNFIup7dOufwMG2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::dvNFIup7dOufwMG2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::COMwMwvf80jQqIQO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::COMwMwvf80jQqIQO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bSEyOEF8W0fS3Dpk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::bSEyOEF8W0fS3Dpk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8z8EGASGhBXL3kJR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::8z8EGASGhBXL3kJR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ou9WoLVhmGTcC6IV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Ou9WoLVhmGTcC6IV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KZOCMtJXf6eoAa8r' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::KZOCMtJXf6eoAa8r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g6qQeZOxveGVunJK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/curriculums-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::g6qQeZOxveGVunJK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qK9UDR49f2g4Foij' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qK9UDR49f2g4Foij',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7Mu2MNZsCpEdYcpR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::7Mu2MNZsCpEdYcpR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bItLcCNUyLwrzlfo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::bItLcCNUyLwrzlfo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hpO4ofyzTLHfC9SA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hpO4ofyzTLHfC9SA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GggcVxZOYCFrF6rE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::GggcVxZOYCFrF6rE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nkiYw4mjTYmyHgE8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::nkiYw4mjTYmyHgE8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::58kyKVJcAHB5VUwl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/years-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::58kyKVJcAHB5VUwl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qslW6pUXMxZCQ5Fp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-not-yet-enroll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@studentNotYetEnrollCurriculum',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@studentNotYetEnrollCurriculum',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qslW6pUXMxZCQ5Fp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::R8mq9YfSvL5YZ153' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-enroll-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::R8mq9YfSvL5YZ153',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3wtH48isvXkWquqh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-enroll-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::3wtH48isvXkWquqh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Iilx5CPuPZ5icPsm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Iilx5CPuPZ5icPsm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cJt6dmOYvGyr9cwB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::cJt6dmOYvGyr9cwB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iZUWYCczUg4djWvI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::iZUWYCczUg4djWvI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ygLW27mzdUVBjheL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ygLW27mzdUVBjheL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::USZQz1uAlklkrvNI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::USZQz1uAlklkrvNI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KUw9H0VPAXv7J9lN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::KUw9H0VPAXv7J9lN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OUItpIIe23TCTOVu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/education-levels-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OUItpIIe23TCTOVu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P52ydmWGCnEPNwG3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::P52ydmWGCnEPNwG3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1VELxBpiS34FfAdk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::1VELxBpiS34FfAdk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5K4Pm6arZTdaGFiG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5K4Pm6arZTdaGFiG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NU7C8TEDXqdipgOg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NU7C8TEDXqdipgOg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RNwWsK5yAkUaoY59' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::RNwWsK5yAkUaoY59',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Kd9MRUwM4wdtNPIW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Kd9MRUwM4wdtNPIW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VaekLLI3SmNovwXL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/rooms-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::VaekLLI3SmNovwXL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hvPMvHHdv2APYKUI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hvPMvHHdv2APYKUI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hQBXzCQxSRo09Vqq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hQBXzCQxSRo09Vqq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5o18LikMWkCk3R1Z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5o18LikMWkCk3R1Z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::92QVkIZwu6xfIjhg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::92QVkIZwu6xfIjhg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dvRHLJucGTnBleAW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::dvRHLJucGTnBleAW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TF49MIivMLNVNxVd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TF49MIivMLNVNxVd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bVcsoZ404sJ4yayo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grades-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::bVcsoZ404sJ4yayo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qZepxTCG2hQJlChR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qZepxTCG2hQJlChR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Dl60eKToShc58l7X' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Dl60eKToShc58l7X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SQUfBHDZxVdhTCrH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::SQUfBHDZxVdhTCrH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q2pwgvDlg6vfWErz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Q2pwgvDlg6vfWErz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kh60rVXMqwcmqNTB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kh60rVXMqwcmqNTB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lNe7IbjLqW5Zx8fy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::lNe7IbjLqW5Zx8fy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MzyG0UdMVYocG8FO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::MzyG0UdMVYocG8FO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a1HjiJngOo26GyTc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@detail',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@detail',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::a1HjiJngOo26GyTc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hBPl95RhCZvUNb0C' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-type-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassTypeController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassTypeController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hBPl95RhCZvUNb0C',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MelRPG4iV3FlKCyN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::MelRPG4iV3FlKCyN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PQ4n5i7lbHXIWn7D' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::PQ4n5i7lbHXIWn7D',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NPRoBtvlDSNENdoD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NPRoBtvlDSNENdoD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LtpRg0UwkG8J0DU0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::LtpRg0UwkG8J0DU0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OZO4Fj4i3fZQRwfH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::OZO4Fj4i3fZQRwfH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HFf3TvsjYJrLyrCI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::HFf3TvsjYJrLyrCI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iYlXZwIkzmmUiEIj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::iYlXZwIkzmmUiEIj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RiQ6Gyav28gObz6l' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-not-yet-enroll-class',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@studentNotYetEnrollClass',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@studentNotYetEnrollClass',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::RiQ6Gyav28gObz6l',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NBIsAwxBkLP2nM4x' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-class-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NBIsAwxBkLP2nM4x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TErYkMvFSdqlzOVY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-class-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TErYkMvFSdqlzOVY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aL98Hs33DFXmteEf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grading-rules-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::aL98Hs33DFXmteEf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yuMgx4MJrdIfWS7J' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grading-rules-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::yuMgx4MJrdIfWS7J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::X3JBssC510PUy67x' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grading-rules-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::X3JBssC510PUy67x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::53xb8JaySc5wGBAz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grading-rules-subjects',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@subject_grade',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@subject_grade',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::53xb8JaySc5wGBAz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::y7Q1bO0ck6dYsBmI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/assessments-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::y7Q1bO0ck6dYsBmI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0DzaX8ggaKEW32FY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/assessments-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::0DzaX8ggaKEW32FY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Uq6x3j6QiMLb7E2W' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/families-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Uq6x3j6QiMLb7E2W',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::v1moTHCu5FQ9q6KL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/families-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::v1moTHCu5FQ9q6KL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mSlAjsT3rMSnSUNk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/families-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::mSlAjsT3rMSnSUNk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gRI8Dl6lcqFj9Pka' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/families-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::gRI8Dl6lcqFj9Pka',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0QGXp5UKdmgwzqGx' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-family-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::0QGXp5UKdmgwzqGx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::htg5E5MY2gDDvUek' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-family-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::htg5E5MY2gDDvUek',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4wllsp4X32T2uGfx' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/family-members-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::4wllsp4X32T2uGfx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aLxmD6b3VrZB3AJe' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/family-members-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::aLxmD6b3VrZB3AJe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hxYDzKFzJvzoCrvG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/family-members-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hxYDzKFzJvzoCrvG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yDL8348W3qaZm9ly' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/family-members-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::yDL8348W3qaZm9ly',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZnOWNRgUczLTUDYl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:848:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'/Users/teangtela/Desktop/freelance/school_template/API/vendor/laravel/framework/src/Illuminate/Foundation/Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"000000000000041c0000000000000000";}}',
        'as' => 'generated::ZnOWNRgUczLTUDYl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xpIJICDiFkBtmUMU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:264:"function () {
    return \\response()->json([
        \'status\' => true,
        \'message\' => \'School Template API\',
        \'version\' => \'1.0.0\',
        \'environment\' => \\app()->environment(),
        \'maintenance_mode\' => \\app()->isDownForMaintenance(),
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000004d70000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::xpIJICDiFkBtmUMU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vdso9k8BWfXHK48X' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'img',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ImageController@resize',
        'controller' => 'App\\Http\\Controllers\\ImageController@resize',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::vdso9k8BWfXHK48X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IMbkKPaOb502e0kz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'h2c-proxy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:493:"function (\\Illuminate\\Http\\Request $request) {
    $url = $request->query(\'url\');
    \\abort_unless(\\filter_var($url, FILTER_VALIDATE_URL), 400);

    $client = new \\GuzzleHttp\\Client([\'verify\' => false, \'timeout\' => 10]);
    $res = $client->get($url);

    $ctype = $res->getHeaderLine(\'Content-Type\') ?: \'image/png\';
    return \\response($res->getBody(), 200, [
        \'Content-Type\' => $ctype,
        \'Cache-Control\' => \'no-cache\',
        \'Access-Control-Allow-Origin\' => \'*\',
    ]);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000004da0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IMbkKPaOb502e0kz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6kZwgmgbFvEKmxP0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::6kZwgmgbFvEKmxP0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:4:{s:6:"driver";s:5:"local";s:4:"root";s:74:"/Users/teangtela/Desktop/freelance/school_template/API/storage/app/private";s:5:"serve";b:1;s:5:"throw";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000004e40000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
