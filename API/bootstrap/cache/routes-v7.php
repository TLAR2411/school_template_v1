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
            '_route' => 'generated::lENfFgdJE08tK9U8',
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
            '_route' => 'generated::zmb9RXs3mQYDb0yX',
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
            '_route' => 'generated::epeWKjtzyXRcEvz1',
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
            '_route' => 'generated::YSIaDvlUibESGerG',
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
            '_route' => 'generated::2gQ4ueNNaqeP5Zvv',
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
            '_route' => 'generated::r0CzvdXZXM3At9jf',
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
            '_route' => 'generated::BBlozTycl10ZFwsM',
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
            '_route' => 'generated::TvjvOqRv9atURi3o',
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
            '_route' => 'generated::N3VMySNSxUcpN0CX',
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
            '_route' => 'generated::Cy8TOD9KH427angW',
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
            '_route' => 'generated::5WSF0jeTogb1BsWY',
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
            '_route' => 'generated::VdblkjF82F0xabxX',
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
            '_route' => 'generated::XALQ8bbAodaMKIhq',
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
            '_route' => 'generated::RTRJEJ0U42a7wEDr',
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
            '_route' => 'generated::mWCiYouK0ipfw8uv',
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
            '_route' => 'generated::RN3D0aW96izPyJAC',
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
            '_route' => 'generated::sI1dyJpviQ4chBVc',
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
            '_route' => 'generated::IPEzOuoJ3IcHJl0l',
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
            '_route' => 'generated::xy0azrEn859VhN8t',
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
            '_route' => 'generated::v7EfOmL2bI0cqTr0',
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
            '_route' => 'generated::RI36Mj4DaS4igGBq',
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
            '_route' => 'generated::R7hkqOG44k7dFzw2',
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
            '_route' => 'generated::BA6hgwoFlyxykCX2',
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
            '_route' => 'generated::4B0O1m5D4hecQKNO',
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
            '_route' => 'generated::IBtng170gNyfeY5c',
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
            '_route' => 'generated::oNADdJ6OJ2nwun87',
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
            '_route' => 'generated::JEwe5BmC5kSHcy12',
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
            '_route' => 'generated::UwvrbKfHz3kdqrfR',
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
            '_route' => 'generated::ournZVgSCglOgorp',
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
            '_route' => 'generated::o398xuJajA73YrUw',
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
            '_route' => 'generated::Mg6LgG914ThZdq4y',
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
            '_route' => 'generated::cUSrh014luIZa1US',
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
            '_route' => 'generated::VCzpZevxtIxILLYU',
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
            '_route' => 'generated::ZbM8gyeS487xnYQf',
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
            '_route' => 'generated::eU9cXb9co4aoDD37',
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
            '_route' => 'generated::WvSeAtBQ4fOJCSpf',
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
            '_route' => 'generated::88AyZsdkMjEW12hP',
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
            '_route' => 'generated::fLIOfAVF8dRolgB8',
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
            '_route' => 'generated::l6mBN0HDOaxvwfPr',
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
            '_route' => 'generated::TQmguJW3BpwhCnB3',
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
            '_route' => 'generated::AA7fxDKuChXbmths',
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
            '_route' => 'generated::xnBk12lDfgRDSqPk',
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
            '_route' => 'generated::wYG9G3O9Xx8Rmo9k',
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
            '_route' => 'generated::meUDFevQQJMad5uS',
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
            '_route' => 'generated::vSQylMmEW8bhXoUn',
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
            '_route' => 'generated::c5BbWv03Sh7WpAC3',
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
            '_route' => 'generated::xQX9SunfaCx7NFxJ',
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
            '_route' => 'generated::bYo1CK2DxcEpSHWi',
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
            '_route' => 'generated::6NoFcmAipEFRizb5',
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
            '_route' => 'generated::eH5Avck00XfoVqh0',
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
            '_route' => 'generated::MDfMgpLD73VjHnzV',
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
            '_route' => 'generated::hcDOW37pN90LpxAv',
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
            '_route' => 'generated::qGISAf37rmvK20uk',
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
            '_route' => 'generated::tGGlPkk5bUslDJKT',
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
            '_route' => 'generated::q0p6ERyVtVwpsYeT',
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
            '_route' => 'generated::XbZXxM504GxcAlsu',
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
            '_route' => 'generated::NVPYAcpwOX0xIov2',
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
            '_route' => 'generated::kVsgEF1ev1MCh2jT',
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
            '_route' => 'generated::kTNtgx4V8I76jgR1',
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
            '_route' => 'generated::fEML8wQRoqXIXGWw',
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
            '_route' => 'generated::uQfpCZXrLFljkKz9',
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
            '_route' => 'generated::xyRcWabkKbh3UiGW',
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
            '_route' => 'generated::huGLpjkcmh5gQgon',
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
            '_route' => 'generated::ZkT3SrCNPKIbTOCS',
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
            '_route' => 'generated::oSA1All5uRsaNbVT',
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
            '_route' => 'generated::kY3vvH79gY7aqhiV',
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
            '_route' => 'generated::mcB6Mh5Sq12XRLIO',
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
            '_route' => 'generated::x6ByS8wPQynaFDzv',
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
            '_route' => 'generated::v0xiB0qmL77qO7WU',
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
            '_route' => 'generated::AWRVpUfgpBy4ZqHS',
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
            '_route' => 'generated::YNEgUspGbbXpQb5w',
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
            '_route' => 'generated::b1Np0BOOc4EGP8CF',
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
            '_route' => 'generated::U7CGv2CZwVEpMoD3',
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
            '_route' => 'generated::fprQVjs0PXlJIbW2',
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
            '_route' => 'generated::4WpcCpWrJFMHVVSc',
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
            '_route' => 'generated::2pG938iTzKnPvNpk',
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
            '_route' => 'generated::HjsEnvOtX3Mezn33',
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
            '_route' => 'generated::qAG9Sk97i9Eba4XJ',
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
            '_route' => 'generated::drszjtqR6RRFXvix',
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
            '_route' => 'generated::gsRDdi0GmEKbgaxT',
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
            '_route' => 'generated::oNxpEpN3TfadbhmK',
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
            '_route' => 'generated::fhkMgnnLtidvCevt',
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
            '_route' => 'generated::iKf0omTV2NZU41GE',
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
            '_route' => 'generated::9ycGVa1oWMmNaS3r',
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
            '_route' => 'generated::9PpmmahxaKvSr6fK',
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
      '/api/web/report-templates-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5ilh7Lq4C0zmYSpw',
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
      '/api/web/report-templates-save' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CGwdv3SarOAdLpQu',
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
      '/api/web/telegram-connection/status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B41Luult6hUxxNzH',
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
      '/api/web/telegram-connection/link' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7I3GmbFYgY7FKJwL',
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
      '/api/web/telegram-connection/disconnect' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hy2kkNkSPqM7HD8c',
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
      '/api/web/telegram-connection/unlink-group' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y3Xca1D5gRzWzxNx',
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
            '_route' => 'generated::GzA08csX2leAqcxT',
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
            '_route' => 'generated::f73pwWvBqU0VQLIy',
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
            '_route' => 'generated::x4KXOcFsvU9MVv3O',
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
            '_route' => 'generated::y8dlT2oRQCKBV6bA',
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
            '_route' => 'generated::rNnffrP1nxOT6zCu',
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
            '_route' => 'generated::TwsZZ3Pk1aITw1nW',
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
      '/api/web/school-dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HoCz0wWDXzG0pjpg',
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
      '/api/web/attendance-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PQxVSUsTSK2qtMta',
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
      '/api/web/attendance-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hn45m0i6qAy3LCTF',
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
      '/api/web/attendance-report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::y7QVls1ogDK18bK9',
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
      '/api/web/score-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IwvTHoirmkVUbgLo',
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
      '/api/web/score-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tTAcg7Nm9jFAXikH',
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
      '/api/web/score-month-header-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sjMKz9r2Rfwp041S',
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
      '/api/web/score-entry-setting-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N2rjWCOvDIEGxy6q',
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
      '/api/web/score-entry-setting-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Is7DqlwzbWRvqg54',
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
      '/api/web/score-entry-status-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w0U7GJO6xUThx1TM',
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
      '/api/web/grade-subject-order-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6MfYZb1BcHzz5S1H',
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
      '/api/web/grade-subject-order-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1O4AlfHNIOBvgOt4',
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
      '/api/web/score-english-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MmfclfrBWp5ROZqb',
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
      '/api/web/score-english-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nabWA8kqE4Vf7899',
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
      '/api/web/term-period-lists-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VbLJfU202J5ZMK9C',
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
      '/api/web/term-period-lists-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JE9kMBdIZWXmeKL8',
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
      '/api/web/term-periods-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AX1bgodyuOfctP3v',
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
      '/api/web/term-periods-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lh824T5f3MdL53l0',
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
      '/api/web/term-periods-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::umzOmpIJaEOKW1hJ',
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
      '/api/web/term-periods-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::50Hw1oZnQO4jVWGl',
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
      '/api/web/term-periods-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CGFfuZwDNj32uPp1',
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
      '/api/web/term-periods-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SN79vXPcShRhAhCr',
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
            '_route' => 'generated::wrSixlyoti3hhTYA',
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
            '_route' => 'generated::ziLVivfzzU3c7Qnz',
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
            '_route' => 'generated::O3DTogd5VfuTLgg7',
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
            '_route' => 'generated::Un96Q8VQ6J33zCHt',
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
            '_route' => 'generated::IEuaErdAbtB6dphp',
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
            '_route' => 'generated::E02OZ2DGYJQ4YWwf',
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
            '_route' => 'generated::wqNi1dFKFDzRBWG4',
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
            '_route' => 'generated::lq3MV5XvCoBioIg3',
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
            '_route' => 'generated::NSvE3ZMhIGUtngEQ',
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
            '_route' => 'generated::c716PkBI2H7e0a3p',
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
            '_route' => 'generated::skdo8598ir6my16C',
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
            '_route' => 'generated::cQN8gujxHixC66g9',
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
            '_route' => 'generated::kiVja1Mpd8VSjjAi',
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
      '/api/web/subject-class' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::C6xF9d0OXUVPsQ0R',
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
            '_route' => 'generated::NFJuvn2HegmXdhOu',
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
            '_route' => 'generated::vudV25pnGUNXllDE',
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
            '_route' => 'generated::y5SI8mRSZwpMb1tm',
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
            '_route' => 'generated::2SzfILNZ1agruPAl',
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
            '_route' => 'generated::TpXIEOhs6jEp3vSJ',
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
            '_route' => 'generated::S13oYYXGe5FAPNJl',
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
            '_route' => 'generated::QBZ0N32GUmEkNfOQ',
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
      '/api/web/subejects-by-day' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZPwwc0jXs1H59O6f',
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
            '_route' => 'generated::nU4PGBjHuk3f1Cdq',
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
            '_route' => 'generated::em6aJtq4SyzfPUPI',
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
            '_route' => 'generated::E3IexmV5VyvQ9Mqk',
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
            '_route' => 'generated::ZSmMnsPOihNG623Y',
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
            '_route' => 'generated::78Zs4NicImpD8K39',
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
            '_route' => 'generated::qMqEOJVugl2GqOnI',
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
      '/api/web/students-delete-many' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mHdVT1teCx3nFoyh',
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
            '_route' => 'generated::U07c0iEIEXZMJ5MH',
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
            '_route' => 'generated::sCqsd85Wodgik9B3',
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
            '_route' => 'generated::7XuhEp5fRE1XzPmQ',
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
            '_route' => 'generated::qqN1CbayuAG3ji39',
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
            '_route' => 'generated::MO3qn3uJIGeT4hY6',
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
            '_route' => 'generated::YOM1jZFaBMQLYg3O',
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
            '_route' => 'generated::qfkNy54VZs0thLMh',
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
            '_route' => 'generated::LPIxtV3XAyg0dONl',
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
            '_route' => 'generated::liNPztoMYhGpqJ7T',
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
            '_route' => 'generated::iUYLZJNLkzudM1Sx',
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
            '_route' => 'generated::E8oFl3qZkWcynSxd',
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
            '_route' => 'generated::hOgFhxyCPkKuYCJR',
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
            '_route' => 'generated::rmLzQX1lYKDRwR5h',
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
            '_route' => 'generated::sj84uEHyLE2foSjb',
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
            '_route' => 'generated::dAzJ8t60mnR9uDil',
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
            '_route' => 'generated::61YQ5NODSF9tTUND',
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
            '_route' => 'generated::AHey2xhvgu3PGJcE',
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
            '_route' => 'generated::jOkJDuRo7YEjiVIN',
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
      '/api/web/students-curriculums-disable' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZbbZn0Fzqvu5hiwT',
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
            '_route' => 'generated::T3eDWBJXupGfXyRp',
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
            '_route' => 'generated::PS6h5WffAQXNG77y',
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
            '_route' => 'generated::zez6gefcaiQXOvKV',
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
            '_route' => 'generated::JywEBaJdzfwJNKT0',
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
            '_route' => 'generated::ghq6Yqglc5t52CFG',
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
            '_route' => 'generated::4RvAAnF42RRKlnS3',
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
            '_route' => 'generated::Hy42N4ggnC6tFVDL',
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
            '_route' => 'generated::5p1gjrzK3Gn9g4VK',
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
            '_route' => 'generated::YE0wqJMDlkP37YIX',
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
            '_route' => 'generated::yUFO6M5RncSm3Agk',
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
            '_route' => 'generated::YxBfsF5ZYCvoVFub',
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
            '_route' => 'generated::ARAFqrODZC5bgJY5',
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
            '_route' => 'generated::NYk1cHMvlV8PjtJX',
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
            '_route' => 'generated::XdpF1v1cRnmQewlK',
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
            '_route' => 'generated::JJj2ErD4ZeHZ2pP3',
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
            '_route' => 'generated::QLXRBRNEX48j1PY7',
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
            '_route' => 'generated::zzSQ4mJ2FCpyqyQX',
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
            '_route' => 'generated::9Jo9yN2rir8EN704',
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
            '_route' => 'generated::NdXS2W0GYI43UqBT',
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
            '_route' => 'generated::1sYM1i2V3sRDl2M6',
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
            '_route' => 'generated::T48dsy35dvBtLgXM',
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
            '_route' => 'generated::3RtR7O6nsfatSJLv',
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
            '_route' => 'generated::TYM9tF4WKrtFp8Yi',
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
            '_route' => 'generated::pOGROzTyg5oFcXp3',
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
            '_route' => 'generated::fGxPLAtqOt2OZEoT',
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
            '_route' => 'generated::HWnQe3TaU8Fj7x0L',
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
            '_route' => 'generated::Wxb9RKFNtCUIlSwv',
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
            '_route' => 'generated::7iviLK1yhrFzZY9g',
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
            '_route' => 'generated::SAgGwMnISMZdgW0e',
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
      '/api/web/classes-teacher' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9DFQn4uldBs5fSym',
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
            '_route' => 'generated::TKTvu64LIcDSXzw3',
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
            '_route' => 'generated::WN6E3MpCfK1emv1i',
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
      '/api/web/teachers-import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g81C6JOSaMZr1dUN',
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
      '/api/web/teachers-import-template' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZdGQxWWLMLGnIeyq',
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
            '_route' => 'generated::N3i1CAMMaCIjTTpZ',
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
            '_route' => 'generated::nBVYfTW9cXQJeOw0',
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
      '/api/web/teachers-detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iuPf6zfgQJT0TgQz',
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
            '_route' => 'generated::RaNYXhYXuzQ27Bns',
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
            '_route' => 'generated::ONLqHnRcbTwB8EAk',
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
            '_route' => 'generated::Kcb956sjpGc7K1Ry',
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
            '_route' => 'generated::nWqKBsWvs3dtuGvi',
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
            '_route' => 'generated::UDHk5AUA4yCgBYxY',
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
            '_route' => 'generated::AyDhYYCMeLHqVuT8',
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
            '_route' => 'generated::Mh5yvSnEVx7W6XqT',
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
            '_route' => 'generated::iBHAXEeN9B9YUcWE',
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
            '_route' => 'generated::8x4sH9QwK4jvBEJs',
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
            '_route' => 'generated::pS0rGkg6OHqq3QBX',
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
            '_route' => 'generated::QWlJWEYeqxzqatR1',
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
            '_route' => 'generated::QB6BfTunpqCj5wWV',
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
            '_route' => 'generated::JPM6JQ88Rw8pCCn2',
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
            '_route' => 'generated::tZiFXuFVJwYlhgir',
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
            '_route' => 'generated::vCBXPTDevDXySTb2',
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
            '_route' => 'generated::qBjzursfGJT5Y0Z4',
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
            '_route' => 'generated::hgStd4GJDdMAcQCW',
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
            '_route' => 'generated::T6EDVwluBwSgAgTQ',
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
            '_route' => 'generated::C6tF0ecVyKQ7xSq3',
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
            '_route' => 'generated::U2D3i6gZfUkUmqVj',
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
            '_route' => 'generated::1c43Q8t0MaQNxrLd',
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
            '_route' => 'generated::SckUHiiOhHX69Vvo',
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
            '_route' => 'generated::tC90DqJ84DHTpvMP',
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
      '/api/web/schedules-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DiK345Ejlfp0Uge3',
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
      '/api/web/schedules-store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pBAC4tg2pffpbjCS',
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
      '/api/web/schedules-show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fsYypxhz1c3sQu2T',
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
      '/api/web/schedules-update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TvlPjwB4Rbko5QKs',
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
      '/api/web/schedules-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZbYkrRTwRunDV78r',
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
      '/api/web/days-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fQFmWG2nUNNyMPto',
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
      '/api/web/shift-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W5aVNmru9k7Hpvye',
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
      '/api/web/months-all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H2WGKIs2fMy11xFq',
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
      '/api/web/telegram/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YrjxT7uQjtPkqB6F',
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
      '/api/web/telegram-connection/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Qb6rXcunHtnvlMZb',
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
      '/api/web/telegram-connection/send-message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k82Hswob6aCf1Opc',
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
      '/api/web/telegram/permission-request' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CUhFDRD2SVSeVKz5',
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
      '/api/app/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hBwZnODw9rC3IrH8',
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
      '/api/app/report-student-individual' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5aABMKAvuLbTLEUp',
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
      '/api/app/notifications/permission' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w6OspfnXt6OwyGAk',
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
      '/api/app/notifications/attendance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YOvuU4NxpQTVqTnC',
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
      '/api/app/telegram/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ftDroGHfvy5Mxk0S',
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
      '/api/app/telegram-connection/webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pCJSAMg4KGKfspWc',
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
      '/api/app/telegram-connection/link' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aprx2pKu2XxunX0p',
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
      '/api/app/telegram-connection/status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::emukdO5vR8QMmdNR',
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
      '/api/app/telegram-connection/send-message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::le7kKplntAUkQhF3',
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
      '/api/app/telegram-connection/disconnect' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vmG5PbDhyx2sB8s9',
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
      '/api/app/telegram-connection/unlink-group' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4HtVhh52WHCBP1Wv',
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
      '/api/app/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WYrm3gZ1B1sdKalI',
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
      '/api/app/telegram/permission-request' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LCSQCcsBZ2h9KWB5',
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
      '/api/app/device-token' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RpjKABED49k4nWWV',
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
      '/api/app/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P8KtAw0llxUehFff',
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
      '/api/app/permission-request' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xxw7mPwSeH23Z6Wj',
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
      '/api/app/students-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rdBSreDQBg9IxpNd',
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
      '/api/app/classes-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dahNobrENH9o0i5N',
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
      '/api/app/curriculums-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Cq35QSjLP1NoowyY',
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
      '/api/app/years-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P2oZeG5xibmd2v5W',
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
      '/api/app/report-code' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zg2L4fBYaDIyfaAs',
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
      '/api/app/family-classes-list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ury5C3mtrh6cECHo',
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
      '/api/app/academic-years' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m1Cu3jueRETIDdxN',
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
      '/api/app/curriculums' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DDWvD85PuPq4PgLj',
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
      '/api/clear-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VA7yPkulZTzKVn2N',
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
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TXWEcOVSqwlSbax5',
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
            '_route' => 'generated::DfHBOpj88jNj4d4P',
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
            '_route' => 'generated::IFCwmzMVlSwDUbRs',
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
            '_route' => 'generated::0yqxs6NDniK1nNvf',
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
            '_route' => 'generated::XhsXX5zceXopqsge',
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
      0 => '{^(?|/log\\-viewer(?|/api/f(?|olders/([^/]++)(?|/(?|download(?|/request(*:72)|(*:79))|clear\\-cache(*:99))|(*:107))|iles/([^/]++)(?|/(?|download(?|/request(*:155)|(*:163))|clear\\-cache(*:184))|(*:193)))|(?:/((?:.*)))?(*:217))|/api/app/permission\\-request/([^/]++)(?|(*:266)|/([^/]++)(*:283))|/storage/(.*)(*:305))/?$}sDu',
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
      266 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8co788eb7rsfPsIx',
          ),
          1 => 
          array (
            0 => 'id',
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
      283 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XgQw4kdwThDEmj8Q',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'type',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      305 => 
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
    'generated::lENfFgdJE08tK9U8' => 
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
        'as' => 'generated::lENfFgdJE08tK9U8',
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
    'generated::zmb9RXs3mQYDb0yX' => 
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
        'as' => 'generated::zmb9RXs3mQYDb0yX',
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
    'generated::epeWKjtzyXRcEvz1' => 
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
        'as' => 'generated::epeWKjtzyXRcEvz1',
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
    'generated::YSIaDvlUibESGerG' => 
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
        'as' => 'generated::YSIaDvlUibESGerG',
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
    'generated::2gQ4ueNNaqeP5Zvv' => 
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
        'as' => 'generated::2gQ4ueNNaqeP5Zvv',
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
    'generated::r0CzvdXZXM3At9jf' => 
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
        'uses' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@logout',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::r0CzvdXZXM3At9jf',
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
    'generated::BBlozTycl10ZFwsM' => 
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
        'as' => 'generated::BBlozTycl10ZFwsM',
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
    'generated::TvjvOqRv9atURi3o' => 
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
        'as' => 'generated::TvjvOqRv9atURi3o',
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
    'generated::N3VMySNSxUcpN0CX' => 
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
        'as' => 'generated::N3VMySNSxUcpN0CX',
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
    'generated::Cy8TOD9KH427angW' => 
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
        'as' => 'generated::Cy8TOD9KH427angW',
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
    'generated::5WSF0jeTogb1BsWY' => 
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
        'as' => 'generated::5WSF0jeTogb1BsWY',
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
    'generated::VdblkjF82F0xabxX' => 
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
        'as' => 'generated::VdblkjF82F0xabxX',
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
    'generated::XALQ8bbAodaMKIhq' => 
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
        'as' => 'generated::XALQ8bbAodaMKIhq',
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
    'generated::RTRJEJ0U42a7wEDr' => 
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
        'as' => 'generated::RTRJEJ0U42a7wEDr',
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
    'generated::mWCiYouK0ipfw8uv' => 
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
        'as' => 'generated::mWCiYouK0ipfw8uv',
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
    'generated::RN3D0aW96izPyJAC' => 
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
        'as' => 'generated::RN3D0aW96izPyJAC',
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
    'generated::sI1dyJpviQ4chBVc' => 
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
        'as' => 'generated::sI1dyJpviQ4chBVc',
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
    'generated::IPEzOuoJ3IcHJl0l' => 
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
        'as' => 'generated::IPEzOuoJ3IcHJl0l',
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
    'generated::xy0azrEn859VhN8t' => 
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
        'as' => 'generated::xy0azrEn859VhN8t',
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
    'generated::v7EfOmL2bI0cqTr0' => 
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
        'as' => 'generated::v7EfOmL2bI0cqTr0',
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
    'generated::RI36Mj4DaS4igGBq' => 
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
        'as' => 'generated::RI36Mj4DaS4igGBq',
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
    'generated::R7hkqOG44k7dFzw2' => 
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
        'as' => 'generated::R7hkqOG44k7dFzw2',
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
    'generated::BA6hgwoFlyxykCX2' => 
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
        'as' => 'generated::BA6hgwoFlyxykCX2',
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
    'generated::4B0O1m5D4hecQKNO' => 
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
        'as' => 'generated::4B0O1m5D4hecQKNO',
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
    'generated::IBtng170gNyfeY5c' => 
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
        'as' => 'generated::IBtng170gNyfeY5c',
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
    'generated::oNADdJ6OJ2nwun87' => 
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
        'as' => 'generated::oNADdJ6OJ2nwun87',
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
    'generated::JEwe5BmC5kSHcy12' => 
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
        'as' => 'generated::JEwe5BmC5kSHcy12',
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
    'generated::UwvrbKfHz3kdqrfR' => 
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
        'as' => 'generated::UwvrbKfHz3kdqrfR',
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
    'generated::ournZVgSCglOgorp' => 
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
        'as' => 'generated::ournZVgSCglOgorp',
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
    'generated::o398xuJajA73YrUw' => 
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
        'as' => 'generated::o398xuJajA73YrUw',
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
    'generated::Mg6LgG914ThZdq4y' => 
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
        'as' => 'generated::Mg6LgG914ThZdq4y',
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
    'generated::cUSrh014luIZa1US' => 
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
        'as' => 'generated::cUSrh014luIZa1US',
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
    'generated::VCzpZevxtIxILLYU' => 
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
        'as' => 'generated::VCzpZevxtIxILLYU',
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
    'generated::ZbM8gyeS487xnYQf' => 
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
        'as' => 'generated::ZbM8gyeS487xnYQf',
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
    'generated::eU9cXb9co4aoDD37' => 
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
        'as' => 'generated::eU9cXb9co4aoDD37',
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
    'generated::WvSeAtBQ4fOJCSpf' => 
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
        'as' => 'generated::WvSeAtBQ4fOJCSpf',
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
    'generated::88AyZsdkMjEW12hP' => 
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
        'as' => 'generated::88AyZsdkMjEW12hP',
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
    'generated::fLIOfAVF8dRolgB8' => 
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
        'as' => 'generated::fLIOfAVF8dRolgB8',
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
    'generated::l6mBN0HDOaxvwfPr' => 
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
        'as' => 'generated::l6mBN0HDOaxvwfPr',
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
    'generated::TQmguJW3BpwhCnB3' => 
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
        'as' => 'generated::TQmguJW3BpwhCnB3',
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
    'generated::AA7fxDKuChXbmths' => 
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
        'as' => 'generated::AA7fxDKuChXbmths',
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
    'generated::xnBk12lDfgRDSqPk' => 
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
        'as' => 'generated::xnBk12lDfgRDSqPk',
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
    'generated::wYG9G3O9Xx8Rmo9k' => 
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
        'as' => 'generated::wYG9G3O9Xx8Rmo9k',
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
    'generated::meUDFevQQJMad5uS' => 
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
        'as' => 'generated::meUDFevQQJMad5uS',
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
    'generated::vSQylMmEW8bhXoUn' => 
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
        'as' => 'generated::vSQylMmEW8bhXoUn',
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
    'generated::c5BbWv03Sh7WpAC3' => 
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
        'as' => 'generated::c5BbWv03Sh7WpAC3',
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
    'generated::xQX9SunfaCx7NFxJ' => 
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
        'as' => 'generated::xQX9SunfaCx7NFxJ',
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
    'generated::bYo1CK2DxcEpSHWi' => 
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
        'as' => 'generated::bYo1CK2DxcEpSHWi',
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
    'generated::6NoFcmAipEFRizb5' => 
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
        'as' => 'generated::6NoFcmAipEFRizb5',
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
    'generated::eH5Avck00XfoVqh0' => 
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
        'as' => 'generated::eH5Avck00XfoVqh0',
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
    'generated::MDfMgpLD73VjHnzV' => 
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
        'as' => 'generated::MDfMgpLD73VjHnzV',
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
    'generated::hcDOW37pN90LpxAv' => 
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
        'as' => 'generated::hcDOW37pN90LpxAv',
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
    'generated::qGISAf37rmvK20uk' => 
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
        'as' => 'generated::qGISAf37rmvK20uk',
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
    'generated::tGGlPkk5bUslDJKT' => 
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
        'as' => 'generated::tGGlPkk5bUslDJKT',
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
    'generated::q0p6ERyVtVwpsYeT' => 
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
        'as' => 'generated::q0p6ERyVtVwpsYeT',
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
    'generated::XbZXxM504GxcAlsu' => 
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
        'as' => 'generated::XbZXxM504GxcAlsu',
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
    'generated::NVPYAcpwOX0xIov2' => 
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
        'as' => 'generated::NVPYAcpwOX0xIov2',
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
    'generated::kVsgEF1ev1MCh2jT' => 
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
        'as' => 'generated::kVsgEF1ev1MCh2jT',
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
    'generated::kTNtgx4V8I76jgR1' => 
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
        'as' => 'generated::kTNtgx4V8I76jgR1',
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
    'generated::fEML8wQRoqXIXGWw' => 
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
        'as' => 'generated::fEML8wQRoqXIXGWw',
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
    'generated::uQfpCZXrLFljkKz9' => 
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
        'as' => 'generated::uQfpCZXrLFljkKz9',
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
    'generated::xyRcWabkKbh3UiGW' => 
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
        'as' => 'generated::xyRcWabkKbh3UiGW',
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
    'generated::huGLpjkcmh5gQgon' => 
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
        'as' => 'generated::huGLpjkcmh5gQgon',
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
    'generated::ZkT3SrCNPKIbTOCS' => 
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
        'as' => 'generated::ZkT3SrCNPKIbTOCS',
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
    'generated::oSA1All5uRsaNbVT' => 
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
        'as' => 'generated::oSA1All5uRsaNbVT',
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
    'generated::kY3vvH79gY7aqhiV' => 
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
        'as' => 'generated::kY3vvH79gY7aqhiV',
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
    'generated::mcB6Mh5Sq12XRLIO' => 
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
        'as' => 'generated::mcB6Mh5Sq12XRLIO',
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
    'generated::x6ByS8wPQynaFDzv' => 
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
        'as' => 'generated::x6ByS8wPQynaFDzv',
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
    'generated::v0xiB0qmL77qO7WU' => 
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
        'as' => 'generated::v0xiB0qmL77qO7WU',
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
    'generated::AWRVpUfgpBy4ZqHS' => 
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
        'as' => 'generated::AWRVpUfgpBy4ZqHS',
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
    'generated::YNEgUspGbbXpQb5w' => 
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
        'as' => 'generated::YNEgUspGbbXpQb5w',
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
    'generated::b1Np0BOOc4EGP8CF' => 
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
        'as' => 'generated::b1Np0BOOc4EGP8CF',
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
    'generated::U7CGv2CZwVEpMoD3' => 
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
        'as' => 'generated::U7CGv2CZwVEpMoD3',
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
    'generated::fprQVjs0PXlJIbW2' => 
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
        'as' => 'generated::fprQVjs0PXlJIbW2',
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
    'generated::4WpcCpWrJFMHVVSc' => 
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
        'as' => 'generated::4WpcCpWrJFMHVVSc',
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
    'generated::2pG938iTzKnPvNpk' => 
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
        'as' => 'generated::2pG938iTzKnPvNpk',
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
    'generated::HjsEnvOtX3Mezn33' => 
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
        'as' => 'generated::HjsEnvOtX3Mezn33',
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
    'generated::qAG9Sk97i9Eba4XJ' => 
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
        'as' => 'generated::qAG9Sk97i9Eba4XJ',
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
    'generated::drszjtqR6RRFXvix' => 
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
        'as' => 'generated::drszjtqR6RRFXvix',
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
    'generated::gsRDdi0GmEKbgaxT' => 
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
        'as' => 'generated::gsRDdi0GmEKbgaxT',
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
    'generated::oNxpEpN3TfadbhmK' => 
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
          2 => 'auth:api',
          3 => 'permission:view-permissions',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\PermissionController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::oNxpEpN3TfadbhmK',
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
    'generated::fhkMgnnLtidvCevt' => 
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
        'as' => 'generated::fhkMgnnLtidvCevt',
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
    'generated::iKf0omTV2NZU41GE' => 
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
        'as' => 'generated::iKf0omTV2NZU41GE',
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
    'generated::9ycGVa1oWMmNaS3r' => 
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
        'as' => 'generated::9ycGVa1oWMmNaS3r',
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
    'generated::9PpmmahxaKvSr6fK' => 
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
        'as' => 'generated::9PpmmahxaKvSr6fK',
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
    'generated::5ilh7Lq4C0zmYSpw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/report-templates-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportTemplateController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportTemplateController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5ilh7Lq4C0zmYSpw',
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
    'generated::CGwdv3SarOAdLpQu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/report-templates-save',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\ReportTemplateController@save',
        'controller' => 'App\\Http\\Controllers\\Api\\ReportTemplateController@save',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::CGwdv3SarOAdLpQu',
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
    'generated::B41Luult6hUxxNzH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/web/telegram-connection/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@checkConnectTelegram',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@checkConnectTelegram',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::B41Luult6hUxxNzH',
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
    'generated::7I3GmbFYgY7FKJwL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/web/telegram-connection/link',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@getTelegramConnectLink',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@getTelegramConnectLink',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::7I3GmbFYgY7FKJwL',
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
    'generated::hy2kkNkSPqM7HD8c' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram-connection/disconnect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@disConnectBot',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@disConnectBot',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hy2kkNkSPqM7HD8c',
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
    'generated::Y3Xca1D5gRzWzxNx' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram-connection/unlink-group',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@unlinkTelegramGroup',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@unlinkTelegramGroup',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Y3Xca1D5gRzWzxNx',
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
    'generated::GzA08csX2leAqcxT' => 
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
        'as' => 'generated::GzA08csX2leAqcxT',
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
    'generated::f73pwWvBqU0VQLIy' => 
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
        'as' => 'generated::f73pwWvBqU0VQLIy',
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
    'generated::x4KXOcFsvU9MVv3O' => 
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
        'as' => 'generated::x4KXOcFsvU9MVv3O',
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
    'generated::y8dlT2oRQCKBV6bA' => 
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
        'as' => 'generated::y8dlT2oRQCKBV6bA',
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
    'generated::rNnffrP1nxOT6zCu' => 
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
        'as' => 'generated::rNnffrP1nxOT6zCu',
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
    'generated::TwsZZ3Pk1aITw1nW' => 
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
        'as' => 'generated::TwsZZ3Pk1aITw1nW',
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
    'generated::HoCz0wWDXzG0pjpg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/school-dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\DashboardController@summary',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\DashboardController@summary',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::HoCz0wWDXzG0pjpg',
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
    'generated::PQxVSUsTSK2qtMta' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/attendance-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-attendance|add-attendance',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@getAttendanceData',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@getAttendanceData',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::PQxVSUsTSK2qtMta',
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
    'generated::hn45m0i6qAy3LCTF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/attendance-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-attendance|edit-attendance',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hn45m0i6qAy3LCTF',
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
    'generated::y7QVls1ogDK18bK9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/attendance-report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-attendance',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@report',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AttendanceController@report',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::y7QVls1ogDK18bK9',
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
    'generated::IwvTHoirmkVUbgLo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-score-entry|add-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@getScoreData',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@getScoreData',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::IwvTHoirmkVUbgLo',
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
    'generated::tTAcg7Nm9jFAXikH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-score-entry|edit-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::tTAcg7Nm9jFAXikH',
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
    'generated::sjMKz9r2Rfwp041S' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-month-header-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-score-entry|edit-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@saveMonthHeader',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryController@saveMonthHeader',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::sjMKz9r2Rfwp041S',
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
    'generated::N2rjWCOvDIEGxy6q' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-entry-setting-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-score-entry|approve-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@showSetting',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@showSetting',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::N2rjWCOvDIEGxy6q',
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
    'generated::Is7DqlwzbWRvqg54' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-entry-setting-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:approve-score-entry|edit-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@storeSetting',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@storeSetting',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Is7DqlwzbWRvqg54',
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
    'generated::w0U7GJO6xUThx1TM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-entry-status-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-score-entry|approve-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@statusList',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryStatusController@statusList',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::w0U7GJO6xUThx1TM',
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
    'generated::6MfYZb1BcHzz5S1H' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grade-subject-order-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-score-entry|add-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeSubjectOrderController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeSubjectOrderController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::6MfYZb1BcHzz5S1H',
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
    'generated::1O4AlfHNIOBvgOt4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/grade-subject-order-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-score-entry|edit-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeSubjectOrderController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeSubjectOrderController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::1O4AlfHNIOBvgOt4',
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
    'generated::MmfclfrBWp5ROZqb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-english-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-score-entry|add-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryEnglishController@getScoreData',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryEnglishController@getScoreData',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::MmfclfrBWp5ROZqb',
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
    'generated::nabWA8kqE4Vf7899' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/score-english-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-score-entry|edit-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryEnglishController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScoreEntryEnglishController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::nabWA8kqE4Vf7899',
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
    'generated::VbLJfU202J5ZMK9C' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-period-lists-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodListController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodListController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::VbLJfU202J5ZMK9C',
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
    'generated::JE9kMBdIZWXmeKL8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-period-lists-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:edit-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodListController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodListController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JE9kMBdIZWXmeKL8',
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
    'generated::AX1bgodyuOfctP3v' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::AX1bgodyuOfctP3v',
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
    'generated::Lh824T5f3MdL53l0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Lh824T5f3MdL53l0',
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
    'generated::umzOmpIJaEOKW1hJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::umzOmpIJaEOKW1hJ',
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
    'generated::50Hw1oZnQO4jVWGl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:edit-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::50Hw1oZnQO4jVWGl',
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
    'generated::CGFfuZwDNj32uPp1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:delete-term-periods',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::CGFfuZwDNj32uPp1',
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
    'generated::SN79vXPcShRhAhCr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/term-periods-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TermPeriodController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::SN79vXPcShRhAhCr',
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
    'generated::wrSixlyoti3hhTYA' => 
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
          2 => 'permission:add-subject-activity-types',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::wrSixlyoti3hhTYA',
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
    'generated::ziLVivfzzU3c7Qnz' => 
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
          2 => 'permission:view-subject-activity-types',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ziLVivfzzU3c7Qnz',
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
    'generated::O3DTogd5VfuTLgg7' => 
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
        'as' => 'generated::O3DTogd5VfuTLgg7',
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
    'generated::Un96Q8VQ6J33zCHt' => 
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
          2 => 'permission:edit-subject-activity-types',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Un96Q8VQ6J33zCHt',
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
    'generated::IEuaErdAbtB6dphp' => 
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
          2 => 'permission:change-active-subject-activity-types',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::IEuaErdAbtB6dphp',
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
    'generated::E02OZ2DGYJQ4YWwf' => 
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
          2 => 'permission:delete-subject-activity-types',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectActivityTypeController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::E02OZ2DGYJQ4YWwf',
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
    'generated::wqNi1dFKFDzRBWG4' => 
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
        'as' => 'generated::wqNi1dFKFDzRBWG4',
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
    'generated::lq3MV5XvCoBioIg3' => 
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
          2 => 'permission:add-teacher-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::lq3MV5XvCoBioIg3',
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
    'generated::NSvE3ZMhIGUtngEQ' => 
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
          2 => 'permission:view-teacher-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NSvE3ZMhIGUtngEQ',
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
    'generated::c716PkBI2H7e0a3p' => 
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
        'as' => 'generated::c716PkBI2H7e0a3p',
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
    'generated::skdo8598ir6my16C' => 
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
          2 => 'permission:delete-teacher-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete_subject',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete_subject',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::skdo8598ir6my16C',
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
    'generated::cQN8gujxHixC66g9' => 
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
          2 => 'permission:edit-teacher-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::cQN8gujxHixC66g9',
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
    'generated::kiVja1Mpd8VSjjAi' => 
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
          2 => 'permission:delete-teacher-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::kiVja1Mpd8VSjjAi',
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
    'generated::C6xF9d0OXUVPsQ0R' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subject-class',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@subjectClass',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherClassController@subjectClass',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::C6xF9d0OXUVPsQ0R',
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
    'generated::NFJuvn2HegmXdhOu' => 
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
          2 => 'permission:add-subjects',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NFJuvn2HegmXdhOu',
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
    'generated::vudV25pnGUNXllDE' => 
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
          2 => 'permission:view-subjects',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::vudV25pnGUNXllDE',
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
    'generated::y5SI8mRSZwpMb1tm' => 
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
        'as' => 'generated::y5SI8mRSZwpMb1tm',
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
    'generated::2SzfILNZ1agruPAl' => 
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
          2 => 'permission:edit-subjects',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::2SzfILNZ1agruPAl',
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
    'generated::TpXIEOhs6jEp3vSJ' => 
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
          2 => 'permission:change-active-subjects',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TpXIEOhs6jEp3vSJ',
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
    'generated::S13oYYXGe5FAPNJl' => 
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
          2 => 'permission:delete-subjects',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::S13oYYXGe5FAPNJl',
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
    'generated::QBZ0N32GUmEkNfOQ' => 
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
        'as' => 'generated::QBZ0N32GUmEkNfOQ',
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
    'generated::ZPwwc0jXs1H59O6f' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/subejects-by-day',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@subjectByDay',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\SubjectController@subjectByDay',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ZPwwc0jXs1H59O6f',
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
    'generated::nU4PGBjHuk3f1Cdq' => 
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
          2 => 'permission:add-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::nU4PGBjHuk3f1Cdq',
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
    'generated::em6aJtq4SyzfPUPI' => 
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
          2 => 'permission:view-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::em6aJtq4SyzfPUPI',
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
    'generated::E3IexmV5VyvQ9Mqk' => 
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
        'as' => 'generated::E3IexmV5VyvQ9Mqk',
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
    'generated::ZSmMnsPOihNG623Y' => 
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
          2 => 'permission:edit-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ZSmMnsPOihNG623Y',
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
    'generated::78Zs4NicImpD8K39' => 
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
          2 => 'permission:change-active-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::78Zs4NicImpD8K39',
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
    'generated::qMqEOJVugl2GqOnI' => 
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
          2 => 'permission:delete-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qMqEOJVugl2GqOnI',
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
    'generated::mHdVT1teCx3nFoyh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-delete-many',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:delete-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentController@deleteMany',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentController@deleteMany',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::mHdVT1teCx3nFoyh',
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
    'generated::U07c0iEIEXZMJ5MH' => 
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
        'as' => 'generated::U07c0iEIEXZMJ5MH',
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
    'generated::sCqsd85Wodgik9B3' => 
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
          2 => 'permission:add-curriculums',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::sCqsd85Wodgik9B3',
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
    'generated::7XuhEp5fRE1XzPmQ' => 
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
          2 => 'permission:view-curriculums',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::7XuhEp5fRE1XzPmQ',
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
    'generated::qqN1CbayuAG3ji39' => 
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
        'as' => 'generated::qqN1CbayuAG3ji39',
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
    'generated::MO3qn3uJIGeT4hY6' => 
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
          2 => 'permission:edit-curriculums',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::MO3qn3uJIGeT4hY6',
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
    'generated::YOM1jZFaBMQLYg3O' => 
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
        'as' => 'generated::YOM1jZFaBMQLYg3O',
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
    'generated::qfkNy54VZs0thLMh' => 
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
          2 => 'permission:change-active-curriculums',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::qfkNy54VZs0thLMh',
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
    'generated::LPIxtV3XAyg0dONl' => 
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
          2 => 'permission:delete-curriculums',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\CurriculumController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::LPIxtV3XAyg0dONl',
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
    'generated::liNPztoMYhGpqJ7T' => 
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
          2 => 'permission:add-years',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::liNPztoMYhGpqJ7T',
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
    'generated::iUYLZJNLkzudM1Sx' => 
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
          2 => 'permission:view-years',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::iUYLZJNLkzudM1Sx',
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
    'generated::E8oFl3qZkWcynSxd' => 
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
        'as' => 'generated::E8oFl3qZkWcynSxd',
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
    'generated::hOgFhxyCPkKuYCJR' => 
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
          2 => 'permission:edit-years',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hOgFhxyCPkKuYCJR',
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
    'generated::rmLzQX1lYKDRwR5h' => 
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
        'as' => 'generated::rmLzQX1lYKDRwR5h',
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
    'generated::sj84uEHyLE2foSjb' => 
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
          2 => 'permission:change-active-years',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::sj84uEHyLE2foSjb',
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
    'generated::dAzJ8t60mnR9uDil' => 
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
          2 => 'permission:delete-years',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\YearController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\YearController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::dAzJ8t60mnR9uDil',
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
    'generated::61YQ5NODSF9tTUND' => 
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
          2 => 'permission:enroll-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@studentNotYetEnrollCurriculum',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@studentNotYetEnrollCurriculum',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::61YQ5NODSF9tTUND',
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
    'generated::AHey2xhvgu3PGJcE' => 
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
          2 => 'permission:enroll-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::AHey2xhvgu3PGJcE',
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
    'generated::jOkJDuRo7YEjiVIN' => 
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
          2 => 'permission:view-students',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::jOkJDuRo7YEjiVIN',
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
    'generated::ZbbZn0Fzqvu5hiwT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/students-curriculums-disable',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentCurriculumController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ZbbZn0Fzqvu5hiwT',
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
    'generated::T3eDWBJXupGfXyRp' => 
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
          2 => 'permission:add-education-levels',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::T3eDWBJXupGfXyRp',
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
    'generated::PS6h5WffAQXNG77y' => 
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
          2 => 'permission:view-education-levels',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::PS6h5WffAQXNG77y',
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
    'generated::zez6gefcaiQXOvKV' => 
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
        'as' => 'generated::zez6gefcaiQXOvKV',
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
    'generated::JywEBaJdzfwJNKT0' => 
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
          2 => 'permission:edit-education-levels',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JywEBaJdzfwJNKT0',
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
    'generated::ghq6Yqglc5t52CFG' => 
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
        'as' => 'generated::ghq6Yqglc5t52CFG',
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
    'generated::4RvAAnF42RRKlnS3' => 
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
          2 => 'permission:change-active-education-levels',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::4RvAAnF42RRKlnS3',
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
    'generated::Hy42N4ggnC6tFVDL' => 
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
          2 => 'permission:delete-education-levels',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\EducationLevelController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Hy42N4ggnC6tFVDL',
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
    'generated::5p1gjrzK3Gn9g4VK' => 
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
          2 => 'permission:add-rooms',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::5p1gjrzK3Gn9g4VK',
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
    'generated::YE0wqJMDlkP37YIX' => 
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
          2 => 'permission:view-rooms',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YE0wqJMDlkP37YIX',
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
    'generated::yUFO6M5RncSm3Agk' => 
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
        'as' => 'generated::yUFO6M5RncSm3Agk',
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
    'generated::YxBfsF5ZYCvoVFub' => 
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
          2 => 'permission:edit-rooms',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YxBfsF5ZYCvoVFub',
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
    'generated::ARAFqrODZC5bgJY5' => 
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
        'as' => 'generated::ARAFqrODZC5bgJY5',
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
    'generated::NYk1cHMvlV8PjtJX' => 
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
          2 => 'permission:change-active-rooms',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::NYk1cHMvlV8PjtJX',
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
    'generated::XdpF1v1cRnmQewlK' => 
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
          2 => 'permission:delete-rooms',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\RoomController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\RoomController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::XdpF1v1cRnmQewlK',
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
    'generated::JJj2ErD4ZeHZ2pP3' => 
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
          2 => 'permission:add-grades',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JJj2ErD4ZeHZ2pP3',
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
    'generated::QLXRBRNEX48j1PY7' => 
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
          2 => 'permission:view-grades',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::QLXRBRNEX48j1PY7',
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
    'generated::zzSQ4mJ2FCpyqyQX' => 
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
        'as' => 'generated::zzSQ4mJ2FCpyqyQX',
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
    'generated::9Jo9yN2rir8EN704' => 
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
          2 => 'permission:edit-grades',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::9Jo9yN2rir8EN704',
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
    'generated::NdXS2W0GYI43UqBT' => 
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
        'as' => 'generated::NdXS2W0GYI43UqBT',
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
    'generated::1sYM1i2V3sRDl2M6' => 
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
          2 => 'permission:change-active-grades',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::1sYM1i2V3sRDl2M6',
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
    'generated::T48dsy35dvBtLgXM' => 
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
          2 => 'permission:delete-grades',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradeController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradeController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::T48dsy35dvBtLgXM',
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
    'generated::3RtR7O6nsfatSJLv' => 
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
          2 => 'permission:add-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::3RtR7O6nsfatSJLv',
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
    'generated::TYM9tF4WKrtFp8Yi' => 
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
          2 => 'permission:view-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TYM9tF4WKrtFp8Yi',
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
    'generated::pOGROzTyg5oFcXp3' => 
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
        'as' => 'generated::pOGROzTyg5oFcXp3',
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
    'generated::fGxPLAtqOt2OZEoT' => 
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
          2 => 'permission:edit-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::fGxPLAtqOt2OZEoT',
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
    'generated::HWnQe3TaU8Fj7x0L' => 
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
        'as' => 'generated::HWnQe3TaU8Fj7x0L',
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
    'generated::Wxb9RKFNtCUIlSwv' => 
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
          2 => 'permission:change-active-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Wxb9RKFNtCUIlSwv',
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
    'generated::7iviLK1yhrFzZY9g' => 
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
          2 => 'permission:delete-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::7iviLK1yhrFzZY9g',
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
    'generated::SAgGwMnISMZdgW0e' => 
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
          2 => 'permission:view-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@detail',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@detail',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::SAgGwMnISMZdgW0e',
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
    'generated::9DFQn4uldBs5fSym' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/classes-teacher',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ClassController@teacherClass',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ClassController@teacherClass',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::9DFQn4uldBs5fSym',
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
    'generated::TKTvu64LIcDSXzw3' => 
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
        'as' => 'generated::TKTvu64LIcDSXzw3',
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
    'generated::WN6E3MpCfK1emv1i' => 
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
          2 => 'permission:add-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::WN6E3MpCfK1emv1i',
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
    'generated::g81C6JOSaMZr1dUN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:import-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@import',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@import',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::g81C6JOSaMZr1dUN',
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
    'generated::ZdGQxWWLMLGnIeyq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-import-template',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:import-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@importTemplate',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@importTemplate',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ZdGQxWWLMLGnIeyq',
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
    'generated::N3i1CAMMaCIjTTpZ' => 
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
          2 => 'permission:view-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::N3i1CAMMaCIjTTpZ',
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
    'generated::nBVYfTW9cXQJeOw0' => 
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
        'as' => 'generated::nBVYfTW9cXQJeOw0',
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
    'generated::iuPf6zfgQJT0TgQz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/teachers-detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@detail',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@detail',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::iuPf6zfgQJT0TgQz',
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
    'generated::RaNYXhYXuzQ27Bns' => 
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
          2 => 'permission:edit-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::RaNYXhYXuzQ27Bns',
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
    'generated::ONLqHnRcbTwB8EAk' => 
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
        'as' => 'generated::ONLqHnRcbTwB8EAk',
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
    'generated::Kcb956sjpGc7K1Ry' => 
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
          2 => 'permission:change-active-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@disable',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@disable',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Kcb956sjpGc7K1Ry',
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
    'generated::nWqKBsWvs3dtuGvi' => 
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
          2 => 'permission:delete-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\TeacherController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::nWqKBsWvs3dtuGvi',
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
    'generated::UDHk5AUA4yCgBYxY' => 
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
          2 => 'permission:add-student-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@studentNotYetEnrollClass',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@studentNotYetEnrollClass',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::UDHk5AUA4yCgBYxY',
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
    'generated::AyDhYYCMeLHqVuT8' => 
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
          2 => 'permission:add-student-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::AyDhYYCMeLHqVuT8',
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
    'generated::Mh5yvSnEVx7W6XqT' => 
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
          2 => 'permission:view-student-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Mh5yvSnEVx7W6XqT',
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
    'generated::iBHAXEeN9B9YUcWE' => 
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
          2 => 'permission:view-grading-rules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::iBHAXEeN9B9YUcWE',
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
    'generated::8x4sH9QwK4jvBEJs' => 
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
          2 => 'permission:add-grading-rules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::8x4sH9QwK4jvBEJs',
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
    'generated::pS0rGkg6OHqq3QBX' => 
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
          2 => 'permission:delete-grading-rules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\GradingRuleController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::pS0rGkg6OHqq3QBX',
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
    'generated::QWlJWEYeqxzqatR1' => 
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
        'as' => 'generated::QWlJWEYeqxzqatR1',
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
    'generated::QB6BfTunpqCj5wWV' => 
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
          2 => 'permission:add-assessments',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::QB6BfTunpqCj5wWV',
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
    'generated::JPM6JQ88Rw8pCCn2' => 
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
          2 => 'permission:delete-assessments',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\AssessmentController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::JPM6JQ88Rw8pCCn2',
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
    'generated::tZiFXuFVJwYlhgir' => 
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
          2 => 'permission:add-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::tZiFXuFVJwYlhgir',
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
    'generated::vCBXPTDevDXySTb2' => 
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
          2 => 'permission:view-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::vCBXPTDevDXySTb2',
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
    'generated::qBjzursfGJT5Y0Z4' => 
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
        'as' => 'generated::qBjzursfGJT5Y0Z4',
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
    'generated::hgStd4GJDdMAcQCW' => 
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
          2 => 'permission:edit-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::hgStd4GJDdMAcQCW',
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
    'generated::T6EDVwluBwSgAgTQ' => 
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
          2 => 'permission:edit-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::T6EDVwluBwSgAgTQ',
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
    'generated::C6tF0ecVyKQ7xSq3' => 
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
          2 => 'permission:edit-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentFamilyController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::C6tF0ecVyKQ7xSq3',
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
    'generated::U2D3i6gZfUkUmqVj' => 
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
        'as' => 'generated::U2D3i6gZfUkUmqVj',
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
    'generated::1c43Q8t0MaQNxrLd' => 
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
          2 => 'permission:edit-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::1c43Q8t0MaQNxrLd',
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
    'generated::SckUHiiOhHX69Vvo' => 
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
          2 => 'permission:edit-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::SckUHiiOhHX69Vvo',
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
    'generated::tC90DqJ84DHTpvMP' => 
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
          2 => 'permission:delete-families',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\FamilyMemberController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::tC90DqJ84DHTpvMP',
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
    'generated::DiK345Ejlfp0Uge3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/schedules-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-schedules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@list',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::DiK345Ejlfp0Uge3',
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
    'generated::pBAC4tg2pffpbjCS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/schedules-store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:add-schedules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@store',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::pBAC4tg2pffpbjCS',
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
    'generated::fsYypxhz1c3sQu2T' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/schedules-show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@show',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::fsYypxhz1c3sQu2T',
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
    'generated::TvlPjwB4Rbko5QKs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/schedules-update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:edit-schedules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@update',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::TvlPjwB4Rbko5QKs',
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
    'generated::ZbYkrRTwRunDV78r' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/schedules-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:delete-schedules',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ScheduleController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::ZbYkrRTwRunDV78r',
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
    'generated::fQFmWG2nUNNyMPto' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/days-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\DayController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\DayController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::fQFmWG2nUNNyMPto',
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
    'generated::W5aVNmru9k7Hpvye' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/shift-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\ShiftController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\ShiftController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::W5aVNmru9k7Hpvye',
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
    'generated::H2WGKIs2fMy11xFq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/months-all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\MonthController@all',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\MonthController@all',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::H2WGKIs2fMy11xFq',
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
    'generated::YrjxT7uQjtPkqB6F' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@webhook',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@webhook',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::YrjxT7uQjtPkqB6F',
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
    'generated::Qb6rXcunHtnvlMZb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram-connection/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@webhook',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@webhook',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::Qb6rXcunHtnvlMZb',
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
    'generated::k82Hswob6aCf1Opc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram-connection/send-message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::k82Hswob6aCf1Opc',
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
    'generated::CUhFDRD2SVSeVKz5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/telegram/permission-request',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@sendPermissionRequest',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@sendPermissionRequest',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::CUhFDRD2SVSeVKz5',
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
    'generated::hBwZnODw9rC3IrH8' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@login',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::hBwZnODw9rC3IrH8',
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
    'generated::5aABMKAvuLbTLEUp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/report-student-individual',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@showReport',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@showReport',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::5aABMKAvuLbTLEUp',
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
    'generated::8co788eb7rsfPsIx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/permission-request/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@viewrequest',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@viewrequest',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::8co788eb7rsfPsIx',
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
    'generated::XgQw4kdwThDEmj8Q' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/permission-request/{id}/{type}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@updaterequest',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@updaterequest',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::XgQw4kdwThDEmj8Q',
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
    'generated::w6OspfnXt6OwyGAk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/notifications/permission',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\FcmController@sendNotification',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\FcmController@sendNotification',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::w6OspfnXt6OwyGAk',
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
    'generated::YOvuU4NxpQTVqTnC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/notifications/attendance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\FcmController@sendNotiToAtt',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\FcmController@sendNotiToAtt',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::YOvuU4NxpQTVqTnC',
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
    'generated::ftDroGHfvy5Mxk0S' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@webhook',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@webhook',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::ftDroGHfvy5Mxk0S',
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
    'generated::pCJSAMg4KGKfspWc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram-connection/webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@webhook',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@webhook',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::pCJSAMg4KGKfspWc',
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
    'generated::aprx2pKu2XxunX0p' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/telegram-connection/link',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@getTelegramConnectLink',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@getTelegramConnectLink',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::aprx2pKu2XxunX0p',
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
    'generated::emukdO5vR8QMmdNR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/telegram-connection/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@checkConnectTelegram',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@checkConnectTelegram',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::emukdO5vR8QMmdNR',
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
    'generated::le7kKplntAUkQhF3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram-connection/send-message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:view-teachers',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::le7kKplntAUkQhF3',
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
    'generated::vmG5PbDhyx2sB8s9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram-connection/disconnect',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@disConnectBot',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@disConnectBot',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::vmG5PbDhyx2sB8s9',
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
    'generated::4HtVhh52WHCBP1Wv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram-connection/unlink-group',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@unlinkTelegramGroup',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@unlinkTelegramGroup',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::4HtVhh52WHCBP1Wv',
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
    'generated::WYrm3gZ1B1sdKalI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\LoginAppController@logout',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::WYrm3gZ1B1sdKalI',
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
    'generated::LCSQCcsBZ2h9KWB5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/telegram/permission-request',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@sendPermissionRequest',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramController@sendPermissionRequest',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::LCSQCcsBZ2h9KWB5',
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
    'generated::RpjKABED49k4nWWV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/device-token',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\UserDeviceTokenController@saveDeviceToken',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\UserDeviceTokenController@saveDeviceToken',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::RpjKABED49k4nWWV',
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
    'generated::P8KtAw0llxUehFff' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@sendPermission',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@sendPermission',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::P8KtAw0llxUehFff',
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
    'generated::xxw7mPwSeH23Z6Wj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/permission-request',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@requestpermission',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\PermissionController@requestpermission',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::xxw7mPwSeH23Z6Wj',
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
    'generated::rdBSreDQBg9IxpNd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/students-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\StudentController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\StudentController@list',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::rdBSreDQBg9IxpNd',
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
    'generated::dahNobrENH9o0i5N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/classes-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\StudentController@studentClass',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\StudentController@studentClass',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::dahNobrENH9o0i5N',
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
    'generated::Cq35QSjLP1NoowyY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/curriculums-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@curriculum_list',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@curriculum_list',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::Cq35QSjLP1NoowyY',
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
    'generated::P2oZeG5xibmd2v5W' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/years-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@year_list',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@year_list',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::P2oZeG5xibmd2v5W',
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
    'generated::zg2L4fBYaDIyfaAs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/app/report-code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@getCode',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\GeneralInfoController@getCode',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::zg2L4fBYaDIyfaAs',
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
    'generated::ury5C3mtrh6cECHo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/family-classes-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\ListClassController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\ListClassController@list',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::ury5C3mtrh6cECHo',
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
    'generated::m1Cu3jueRETIDdxN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/academic-years',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\AcademicController@years',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\AcademicController@years',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::m1Cu3jueRETIDdxN',
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
    'generated::DDWvD85PuPq4PgLj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/app/curriculums',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\AcademicController@curriculums',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\AcademicController@curriculums',
        'namespace' => NULL,
        'prefix' => 'api/app',
        'where' => 
        array (
        ),
        'as' => 'generated::DDWvD85PuPq4PgLj',
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
    'generated::VA7yPkulZTzKVn2N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/clear-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:285:"function () {
    \\Artisan::call(\'route:clear\');
    \\Artisan::call(\'cache:clear\');
    \\Artisan::call(\'optimize\');
    \\Artisan::call(\'view:clear\');
    \\Artisan::call(\'config:clear\');
    \\Artisan::call(\'clear-compiled\');
    \\Artisan::call(\'migrate\');
    return "Clear Complete";
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000001950000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VA7yPkulZTzKVn2N',
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
    'generated::TXWEcOVSqwlSbax5' => 
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
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"000000000000056d0000000000000000";}}',
        'as' => 'generated::TXWEcOVSqwlSbax5',
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
    'generated::DfHBOpj88jNj4d4P' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000067a0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::DfHBOpj88jNj4d4P',
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
    'generated::IFCwmzMVlSwDUbRs' => 
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
        'as' => 'generated::IFCwmzMVlSwDUbRs',
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
    'generated::0yqxs6NDniK1nNvf' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000067d0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0yqxs6NDniK1nNvf',
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
    'generated::XhsXX5zceXopqsge' => 
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
        'as' => 'generated::XhsXX5zceXopqsge',
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
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000006870000000000000000";}}',
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
