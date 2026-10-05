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
            '_route' => 'generated::Kkm9vkularsNfmob',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::NQ5tjxEDNYFL3WuN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3w51KMSlbtZLjrHw',
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
            '_route' => 'generated::plsVoObH9scY1NVt',
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
            '_route' => 'generated::KNig0Qf7EtutEhuG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::NXKFOpLB8ig10CeH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wlbWmSGbKkteEFub',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::OiYxKv7DvAxEACOa',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::hSuQkVdTKADNoD9i',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::5YL6ixN4wQ2dpWiU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wAKg6frI1PLw7GPq',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GbFjEKIWTCHBC9qR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::vdCoJrX04FAj9uVz',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pcV0CumFb6B6RZXi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Yzi0AOr5ADkKMLdL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mtu0NeehQx5X1Fpn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::disn3HLpZhXXrT3a',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EyzLbyNoLpOnXUzi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::G6W5xXZZ4bQ6CyeH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cVN3MV8kx9wzx1Du',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EUgxmg22PYFt9frg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::5iz02258zoFHwhWj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::TUygy8WNoecnhpJH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::vxOOE9ErXLNQUUSu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SgBBEbf7p7rLZN6m',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::e0ej294oZ9CPgweR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Y52Y3i7ogfsFYrll',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::6VA3NXhR8fSs4zlB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::lIkto888eWO6pT2N',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::9Hyp0OpsQUGOrLXG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::i2xt5j7wEVwjNzJv',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wUOmlpEt6EtBaSdL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::6lIfrm5CmQ2qU9Hj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::YcAVHu8jvXtaTycU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::C5jvq1qE6bfxrzM9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CXuEu7CzJPJgWxeu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::bQRi0CT8Z88nVp7Y',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8brQL1euq0zJLfS0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Jt9KKGZIKj7hoFVn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::s4nEnEnhNGsmJ6lS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::k2kBOBTjfykJmfTX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::07Zl939PuM950XM8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FkwdEzzhUiImFwvV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Q0qsNKh0Zbm5CuxX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::uIxVKKSyECqCHmAE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AESJppgQ4Kv7sqbO',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1NqjLHWRh6fnvsg5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pz25G6DZp4CP7iyc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Xdkz35PI2HwfgOdC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7HBA58rWPqeGB7tL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4oJWN10CC58YIPc1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::a0pDDRHiUDcYy2ge',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::HcZAOdvg4udhQIU9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QpSHiIgZXwd5rzBx',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::kOv2nqutpUSnUHwv',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::o5ymF3DGTyHpvR8g',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3AXqiZqJgb7Siuki',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AnoUTNrWI76ASzY4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MaTsC8HBLg8l4Lip',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::oZSdQA389LY3VLCs',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::XLVjD0GTXfIsU31N',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rmiveXD8MGcfRIcc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::xE9HjA5PaAuFHXgR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::04JM0sxokUcFuKCh',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::2yRQ9i8hm1szuN2D',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::P3cPWROuZD5h8xkI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::yMMYZrOPl3KXlkmG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::scKXunAjt303L3wM',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nX3yBp0p2GqjuC0e',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::aWgXXKkDqqW84nnP',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PMUJRn66OPfquTHr',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KJjENqWYKTUSafEN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CHmfCxlnAKeq4Qp1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0CThKaUf9HF1aLnE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::5Dh0VcmFrQZqX4uX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0Qm0Fx86sl7QM5X0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wqdZXswaB8RVMqc3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::NipcKaoScfQSgvhU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::sYToF348qNX5C7vX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gD8cNAzCz74MU9wF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::a4gV2senihZ8QxMv',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KsWNnGNjrZm1emc4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Pa3RVLPocaLtzi90',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KxmTNEXqNtJcto5r',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wXYPbmX2UrPORmJk',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ygA1iVeZQycMBOYy',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SXSD738rg5FSU9VR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Z0yzorQ04F5TRJWP',
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
            '_route' => 'generated::mNMQk6H5YMZqzOJV',
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
            '_route' => 'generated::YGcOeg11ebzXyAnQ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::O6UdQnPmT7TmVPrn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Mq54BqPN0IeNDgm2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EqNitzkKSWioVYKI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::XoosPX1HyF68T6kQ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::06yRt0tsyZoJoSpN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KqoLyrJ4kJv8J6yB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::S6PTLJaHA2XcQkOV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Z84Fp66sGSZI2GgE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4NX7K9rDJWNmr05g',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1gJnTn6xivVs2X75',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wSVz9OEFepGKCJmO',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7UJqnQWAZboIMTI3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mjwYPHbb5RnbUbAt',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::9Ff4KbiDB3jkDjlz',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::S5CVBKAhef3XPBz7',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::BQBnSexWrvuj97GV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::2Ux47eGC7kCxyW29',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PvOBmglnNA5l2kvj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ypaOYZXae8WdFab4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cbEEJpHTMaynjOiz',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::dpzmVegm3d0m2UJf',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::5oFzTICUTbYsYuN0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cYIrcCXg35RDWKof',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ApZBccSLdBXJmN7P',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::yR2KM7RKEX8tIcif',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gM9uxPmVEBVqnCwc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::BS0eun3BfTVqpKfa',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::BrzpHtQTEqkWxnB7',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0tcUL2lO5d62IFbY',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PuvvziQaA07vZoeE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1fgafktraGtfwaMj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QJHjA1f1V1SVgH59',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::DuQfVEsl12GiZf4d',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::TW7i3rsKT75NaN0A',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::LuejaR22g7bXB0cF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mN8hr56HkFjYdsLu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::UzEI7fY2PAe55105',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::TW93OvYEqPde0sgX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ScCKN0IPYAP81X0h',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::iay8UsMKqQQKJvve',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::LgPe45dslUz2R2tn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AHT2SC2j5vX3i5qw',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::t5diEL2fmji9vEdz',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::HdcS15VCtcciwy5p',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wU9ZQ4nWjQWh1gGn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AyE76G5DypRnbSQm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Umz7ZsFQzZ2iqoAN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::acf45YXDlViWcAqa',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1wkuecrMsfr09Q4a',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MrKGsExrJwBA58R8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8VOXNPBEGKYtbg4E',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ZaXgxW0FMzGemHDO',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::L8soSeZ8r6Lo472q',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Q57wrAYFtFOmVcYm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::loCLFcJ2DOv5aDtl',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QJZukISTfkGsWgwA',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::IAy7sfM3mvj8nNIj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::RuM97xWFDgp5gQ7s',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gS27GrAeBYpKt6v8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::w1xkDR7nmdoNsImU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ahueSgnKdgH2qb1u',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::tU5VyChjtE9yQciV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1697fCiTB2kMK961',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::HEKDyw6lgnWa9WD0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7MI72LJcA4LMyuAS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::UckWVT4d2tdB9qWV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::dLkdnOlZ71PJDDar',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Fzo4XTZuyZSMbXBC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::OwDFI4TRyfQdqVt9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ek1sfs963aEugqrh',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SRzXkVsbFRaKRKU6',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KBs8YtjB33J4UAfG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::aBGlwmgSse4kTidE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MfFoUza5z4aHbqd8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::DXBeD0O0E7DfMsz4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KS38W2PanSiOkAE2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AUVPP2a1cImGYtX4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4WtRYltgLADWQY4v',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::C6saolHRj3vRUO2Z',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::iy0OYJgt4wbZICQI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::p1EigjEAmC2uHrhG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::VFXYfz6JO2vJhIia',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ZS87nh8LoRts9o03',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::tRZzpzQtf95rv8V1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::07ihdDjHmymfmpGb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ZHrngjEVJEJbiFIN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::d7FDcPfOTBrTSDCS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::t1HJ5OrKLkmH0XEi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::NSFhU6yDzxPn7ytd',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::l7zTrHWlsU7l9VZG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wfHIP0WHsHBpkuV2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SHhJv9PZCObcAY4g',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::uIn4A4YzOTZX4VUp',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CJJtAd9iRWfCLZU3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::a9WwFeDNNlv98NGt',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FkqXdyGMbaRZcJft',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4zEHQ1u7DVdJqrGs',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::XlD3e50vB8XrM0u8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::hzh47D8JDyFq63JJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cWlYfrYbw3FVqlbN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::LPisZGgo267ak1t1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::DDo1dF5HyZfR8zhJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::NKncT7ILDqYPf0bG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::OHVB7cZzLXTdGHj6',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Yz5oDvdBzDu9xppc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::lhnHePZpidnPLAeI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wkcMcIwTlsNVvats',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::t41y8C2UTV8mg2vw',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QWO4OTe4YRIh9Mpk',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FJ6AanmG8WNi0VHg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3Nv4XYhloxdaRZ06',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::LLn2bmUiCksiKoWF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cUwJUOCQkdP6lTER',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::M3isFx8keX9NTIe3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::RRBqp2DdRujcgWRm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::yYhHZTL72PleTrsX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::axDhbT3fcaVvFTRm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EVh1uh6jFqJDHnbN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MIbSyo0J4bDUdlGE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Sq239vQ2TiVacw36',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3WqjfPlzCGMLdVPB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/web/student-class-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::L1Uc0mZrkR0y34o2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::S60spHLfnSbUJZ3f',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::TCXxZin5FnLDWXQJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Td6vggIXvP89iyOR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CWK5oKoa8WLswc2r',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0oOuVlX7EVX5eoeI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::sjee5q320BLkNVMI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0lpdP8nVzRECrbKj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::9h3CJc29X5qeRwdl',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::qYGmqvLLGcQwRu0w',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::37NURVL4QuJ197PG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::IAECd7cFKLz8yOaE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SisQmLBM0wGg39vb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MrImlX1CYnpLBo0k',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pYVIcAm18ABjyLUK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::haE87QYRi6q73LDS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::p9jjL6tOWLbjip0n',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::yFNEwIukBSybHjxv',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7j5U7hwHvDNQ5hDB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::fl9Cj4pQPMZxyRnK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::6YlfWADUZZGfecyW',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::xt5l0ftzQLyKHxRL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8bODcFCRQBqjUrzC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::TfUQkKLrncWf0pcT',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ZJKVcUnEV5yzJJjY',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::IRShblRvjZILcIzP',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PckIaoyDrXN75gPU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::usWmiFhA98vMJTeo',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Pp6WoqQJF1QqT8U5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::OyQxVhQCsmvhTvtJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::JJMIwAOgztVgA2gi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3YeOI6c1OTM4UFiT',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::sRd2DG1G588RhLtZ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gI7yrRE8o7UVO8UH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pYcd4kn4JHGwMCsQ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::IGZUqq4Rv3wF7SPd',
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
            '_route' => 'generated::awvRFhFRA9KEwcoy',
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
            '_route' => 'generated::RCLw0KL0uKsP8YxY',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::fzpLMAsWWwXqhUbW',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::RyLP8ZkHFiwnvapc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::V9Hwy8ZJPHoXdYMK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::T2rSkrARKBhM9Bte',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mC3ULofdAbK9vlUj',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PTpo1CnTet8FZHWy',
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
            '_route' => 'generated::GvY2FziKvM615yJ3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::kqHFRKyGWMQxcGUN',
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
            '_route' => 'generated::26bX3PLrmrcF0mZI',
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
            '_route' => 'generated::DCZUzeQNptGA5fGl',
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
            '_route' => 'generated::g01yhnAeDCModZnL',
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
            '_route' => 'generated::fKFGtqARIHA5HjkN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::xzIR7e1ikGCJs6zW',
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
            '_route' => 'generated::jq6glzcbYrpOEvE9',
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
            '_route' => 'generated::5HfemuE1cK6j7EE6',
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
            '_route' => 'generated::SKDCN2cQuGcec336',
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
            '_route' => 'generated::anPnBMuUu9jUrWCT',
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
            '_route' => 'generated::owtwnLlGuCBQQDAY',
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
            '_route' => 'generated::k4x2PIvKUWN4Dlal',
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
            '_route' => 'generated::4EYrJz7aFYfvdT2G',
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
            '_route' => 'generated::GM8gWdQlMNEu9Oay',
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
            '_route' => 'generated::SsVYjV1OefMcldND',
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
            '_route' => 'generated::3VIDKi3oYgxbzl3G',
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
    'generated::Kkm9vkularsNfmob' => 
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
        'as' => 'generated::Kkm9vkularsNfmob',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NQ5tjxEDNYFL3WuN' => 
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
        'as' => 'generated::NQ5tjxEDNYFL3WuN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3w51KMSlbtZLjrHw' => 
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
        'as' => 'generated::3w51KMSlbtZLjrHw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::plsVoObH9scY1NVt' => 
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
        'as' => 'generated::plsVoObH9scY1NVt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KNig0Qf7EtutEhuG' => 
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
        'as' => 'generated::KNig0Qf7EtutEhuG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NXKFOpLB8ig10CeH' => 
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
        'as' => 'generated::NXKFOpLB8ig10CeH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wlbWmSGbKkteEFub' => 
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
        'as' => 'generated::wlbWmSGbKkteEFub',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OiYxKv7DvAxEACOa' => 
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
        'as' => 'generated::OiYxKv7DvAxEACOa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hSuQkVdTKADNoD9i' => 
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
        'as' => 'generated::hSuQkVdTKADNoD9i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5YL6ixN4wQ2dpWiU' => 
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
        'as' => 'generated::5YL6ixN4wQ2dpWiU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wAKg6frI1PLw7GPq' => 
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
        'as' => 'generated::wAKg6frI1PLw7GPq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GbFjEKIWTCHBC9qR' => 
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
        'as' => 'generated::GbFjEKIWTCHBC9qR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vdCoJrX04FAj9uVz' => 
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
        'as' => 'generated::vdCoJrX04FAj9uVz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pcV0CumFb6B6RZXi' => 
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
        'as' => 'generated::pcV0CumFb6B6RZXi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Yzi0AOr5ADkKMLdL' => 
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
        'as' => 'generated::Yzi0AOr5ADkKMLdL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mtu0NeehQx5X1Fpn' => 
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
        'as' => 'generated::mtu0NeehQx5X1Fpn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::disn3HLpZhXXrT3a' => 
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
        'as' => 'generated::disn3HLpZhXXrT3a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EyzLbyNoLpOnXUzi' => 
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
        'as' => 'generated::EyzLbyNoLpOnXUzi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::G6W5xXZZ4bQ6CyeH' => 
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
        'as' => 'generated::G6W5xXZZ4bQ6CyeH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cVN3MV8kx9wzx1Du' => 
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
        'as' => 'generated::cVN3MV8kx9wzx1Du',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EUgxmg22PYFt9frg' => 
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
        'as' => 'generated::EUgxmg22PYFt9frg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5iz02258zoFHwhWj' => 
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
        'as' => 'generated::5iz02258zoFHwhWj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TUygy8WNoecnhpJH' => 
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
        'as' => 'generated::TUygy8WNoecnhpJH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vxOOE9ErXLNQUUSu' => 
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
        'as' => 'generated::vxOOE9ErXLNQUUSu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SgBBEbf7p7rLZN6m' => 
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
        'as' => 'generated::SgBBEbf7p7rLZN6m',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::e0ej294oZ9CPgweR' => 
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
        'as' => 'generated::e0ej294oZ9CPgweR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y52Y3i7ogfsFYrll' => 
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
        'as' => 'generated::Y52Y3i7ogfsFYrll',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6VA3NXhR8fSs4zlB' => 
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
        'as' => 'generated::6VA3NXhR8fSs4zlB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lIkto888eWO6pT2N' => 
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
        'as' => 'generated::lIkto888eWO6pT2N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9Hyp0OpsQUGOrLXG' => 
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
        'as' => 'generated::9Hyp0OpsQUGOrLXG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i2xt5j7wEVwjNzJv' => 
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
        'as' => 'generated::i2xt5j7wEVwjNzJv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wUOmlpEt6EtBaSdL' => 
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
        'as' => 'generated::wUOmlpEt6EtBaSdL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6lIfrm5CmQ2qU9Hj' => 
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
        'as' => 'generated::6lIfrm5CmQ2qU9Hj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YcAVHu8jvXtaTycU' => 
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
        'as' => 'generated::YcAVHu8jvXtaTycU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::C5jvq1qE6bfxrzM9' => 
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
        'as' => 'generated::C5jvq1qE6bfxrzM9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CXuEu7CzJPJgWxeu' => 
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
        'as' => 'generated::CXuEu7CzJPJgWxeu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bQRi0CT8Z88nVp7Y' => 
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
        'as' => 'generated::bQRi0CT8Z88nVp7Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8brQL1euq0zJLfS0' => 
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
        'as' => 'generated::8brQL1euq0zJLfS0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jt9KKGZIKj7hoFVn' => 
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
        'as' => 'generated::Jt9KKGZIKj7hoFVn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::s4nEnEnhNGsmJ6lS' => 
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
        'as' => 'generated::s4nEnEnhNGsmJ6lS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k2kBOBTjfykJmfTX' => 
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
        'as' => 'generated::k2kBOBTjfykJmfTX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::07Zl939PuM950XM8' => 
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
        'as' => 'generated::07Zl939PuM950XM8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FkwdEzzhUiImFwvV' => 
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
        'as' => 'generated::FkwdEzzhUiImFwvV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q0qsNKh0Zbm5CuxX' => 
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
        'as' => 'generated::Q0qsNKh0Zbm5CuxX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uIxVKKSyECqCHmAE' => 
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
        'as' => 'generated::uIxVKKSyECqCHmAE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AESJppgQ4Kv7sqbO' => 
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
        'as' => 'generated::AESJppgQ4Kv7sqbO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1NqjLHWRh6fnvsg5' => 
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
        'as' => 'generated::1NqjLHWRh6fnvsg5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pz25G6DZp4CP7iyc' => 
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
        'as' => 'generated::pz25G6DZp4CP7iyc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Xdkz35PI2HwfgOdC' => 
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
        'as' => 'generated::Xdkz35PI2HwfgOdC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7HBA58rWPqeGB7tL' => 
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
        'as' => 'generated::7HBA58rWPqeGB7tL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4oJWN10CC58YIPc1' => 
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
        'as' => 'generated::4oJWN10CC58YIPc1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a0pDDRHiUDcYy2ge' => 
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
        'as' => 'generated::a0pDDRHiUDcYy2ge',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HcZAOdvg4udhQIU9' => 
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
        'as' => 'generated::HcZAOdvg4udhQIU9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QpSHiIgZXwd5rzBx' => 
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
        'as' => 'generated::QpSHiIgZXwd5rzBx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kOv2nqutpUSnUHwv' => 
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
        'as' => 'generated::kOv2nqutpUSnUHwv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o5ymF3DGTyHpvR8g' => 
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
        'as' => 'generated::o5ymF3DGTyHpvR8g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3AXqiZqJgb7Siuki' => 
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
        'as' => 'generated::3AXqiZqJgb7Siuki',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AnoUTNrWI76ASzY4' => 
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
        'as' => 'generated::AnoUTNrWI76ASzY4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MaTsC8HBLg8l4Lip' => 
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
        'as' => 'generated::MaTsC8HBLg8l4Lip',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oZSdQA389LY3VLCs' => 
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
        'as' => 'generated::oZSdQA389LY3VLCs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XLVjD0GTXfIsU31N' => 
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
        'as' => 'generated::XLVjD0GTXfIsU31N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rmiveXD8MGcfRIcc' => 
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
        'as' => 'generated::rmiveXD8MGcfRIcc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xE9HjA5PaAuFHXgR' => 
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
        'as' => 'generated::xE9HjA5PaAuFHXgR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::04JM0sxokUcFuKCh' => 
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
        'as' => 'generated::04JM0sxokUcFuKCh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2yRQ9i8hm1szuN2D' => 
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
        'as' => 'generated::2yRQ9i8hm1szuN2D',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P3cPWROuZD5h8xkI' => 
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
        'as' => 'generated::P3cPWROuZD5h8xkI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yMMYZrOPl3KXlkmG' => 
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
        'as' => 'generated::yMMYZrOPl3KXlkmG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::scKXunAjt303L3wM' => 
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
        'as' => 'generated::scKXunAjt303L3wM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nX3yBp0p2GqjuC0e' => 
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
        'as' => 'generated::nX3yBp0p2GqjuC0e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aWgXXKkDqqW84nnP' => 
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
        'as' => 'generated::aWgXXKkDqqW84nnP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PMUJRn66OPfquTHr' => 
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
        'as' => 'generated::PMUJRn66OPfquTHr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KJjENqWYKTUSafEN' => 
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
        'as' => 'generated::KJjENqWYKTUSafEN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CHmfCxlnAKeq4Qp1' => 
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
        'as' => 'generated::CHmfCxlnAKeq4Qp1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0CThKaUf9HF1aLnE' => 
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
        'as' => 'generated::0CThKaUf9HF1aLnE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5Dh0VcmFrQZqX4uX' => 
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
        'as' => 'generated::5Dh0VcmFrQZqX4uX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0Qm0Fx86sl7QM5X0' => 
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
        'as' => 'generated::0Qm0Fx86sl7QM5X0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wqdZXswaB8RVMqc3' => 
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
        'as' => 'generated::wqdZXswaB8RVMqc3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NipcKaoScfQSgvhU' => 
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
        'as' => 'generated::NipcKaoScfQSgvhU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sYToF348qNX5C7vX' => 
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
        'as' => 'generated::sYToF348qNX5C7vX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gD8cNAzCz74MU9wF' => 
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
        'as' => 'generated::gD8cNAzCz74MU9wF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a4gV2senihZ8QxMv' => 
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
        'as' => 'generated::a4gV2senihZ8QxMv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KsWNnGNjrZm1emc4' => 
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
        'as' => 'generated::KsWNnGNjrZm1emc4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Pa3RVLPocaLtzi90' => 
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
        'as' => 'generated::Pa3RVLPocaLtzi90',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KxmTNEXqNtJcto5r' => 
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
        'as' => 'generated::KxmTNEXqNtJcto5r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wXYPbmX2UrPORmJk' => 
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
        'as' => 'generated::wXYPbmX2UrPORmJk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ygA1iVeZQycMBOYy' => 
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
        'as' => 'generated::ygA1iVeZQycMBOYy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SXSD738rg5FSU9VR' => 
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
        'as' => 'generated::SXSD738rg5FSU9VR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z0yzorQ04F5TRJWP' => 
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
        'as' => 'generated::Z0yzorQ04F5TRJWP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mNMQk6H5YMZqzOJV' => 
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
        'as' => 'generated::mNMQk6H5YMZqzOJV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YGcOeg11ebzXyAnQ' => 
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
        'as' => 'generated::YGcOeg11ebzXyAnQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O6UdQnPmT7TmVPrn' => 
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
        'as' => 'generated::O6UdQnPmT7TmVPrn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Mq54BqPN0IeNDgm2' => 
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
        'as' => 'generated::Mq54BqPN0IeNDgm2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EqNitzkKSWioVYKI' => 
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
        'as' => 'generated::EqNitzkKSWioVYKI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XoosPX1HyF68T6kQ' => 
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
        'as' => 'generated::XoosPX1HyF68T6kQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::06yRt0tsyZoJoSpN' => 
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
        'as' => 'generated::06yRt0tsyZoJoSpN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KqoLyrJ4kJv8J6yB' => 
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
        'as' => 'generated::KqoLyrJ4kJv8J6yB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::S6PTLJaHA2XcQkOV' => 
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
        'as' => 'generated::S6PTLJaHA2XcQkOV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z84Fp66sGSZI2GgE' => 
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
        'as' => 'generated::Z84Fp66sGSZI2GgE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4NX7K9rDJWNmr05g' => 
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
        'as' => 'generated::4NX7K9rDJWNmr05g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1gJnTn6xivVs2X75' => 
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
        'as' => 'generated::1gJnTn6xivVs2X75',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wSVz9OEFepGKCJmO' => 
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
        'as' => 'generated::wSVz9OEFepGKCJmO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7UJqnQWAZboIMTI3' => 
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
        'as' => 'generated::7UJqnQWAZboIMTI3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mjwYPHbb5RnbUbAt' => 
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
        'as' => 'generated::mjwYPHbb5RnbUbAt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9Ff4KbiDB3jkDjlz' => 
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
        'as' => 'generated::9Ff4KbiDB3jkDjlz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::S5CVBKAhef3XPBz7' => 
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
        'as' => 'generated::S5CVBKAhef3XPBz7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BQBnSexWrvuj97GV' => 
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
        'as' => 'generated::BQBnSexWrvuj97GV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2Ux47eGC7kCxyW29' => 
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
        'as' => 'generated::2Ux47eGC7kCxyW29',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PvOBmglnNA5l2kvj' => 
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
        'as' => 'generated::PvOBmglnNA5l2kvj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ypaOYZXae8WdFab4' => 
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
        'as' => 'generated::ypaOYZXae8WdFab4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cbEEJpHTMaynjOiz' => 
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
        'as' => 'generated::cbEEJpHTMaynjOiz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dpzmVegm3d0m2UJf' => 
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
        'as' => 'generated::dpzmVegm3d0m2UJf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5oFzTICUTbYsYuN0' => 
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
        'as' => 'generated::5oFzTICUTbYsYuN0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cYIrcCXg35RDWKof' => 
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
        'as' => 'generated::cYIrcCXg35RDWKof',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ApZBccSLdBXJmN7P' => 
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
        'as' => 'generated::ApZBccSLdBXJmN7P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yR2KM7RKEX8tIcif' => 
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
        'as' => 'generated::yR2KM7RKEX8tIcif',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gM9uxPmVEBVqnCwc' => 
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
        'as' => 'generated::gM9uxPmVEBVqnCwc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BS0eun3BfTVqpKfa' => 
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
        'as' => 'generated::BS0eun3BfTVqpKfa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BrzpHtQTEqkWxnB7' => 
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
        'as' => 'generated::BrzpHtQTEqkWxnB7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0tcUL2lO5d62IFbY' => 
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
        'as' => 'generated::0tcUL2lO5d62IFbY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PuvvziQaA07vZoeE' => 
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
        'as' => 'generated::PuvvziQaA07vZoeE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1fgafktraGtfwaMj' => 
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
        'as' => 'generated::1fgafktraGtfwaMj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QJHjA1f1V1SVgH59' => 
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
        'as' => 'generated::QJHjA1f1V1SVgH59',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DuQfVEsl12GiZf4d' => 
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
        'as' => 'generated::DuQfVEsl12GiZf4d',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TW7i3rsKT75NaN0A' => 
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
        'as' => 'generated::TW7i3rsKT75NaN0A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LuejaR22g7bXB0cF' => 
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
        'as' => 'generated::LuejaR22g7bXB0cF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mN8hr56HkFjYdsLu' => 
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
        'as' => 'generated::mN8hr56HkFjYdsLu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UzEI7fY2PAe55105' => 
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
        'as' => 'generated::UzEI7fY2PAe55105',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TW93OvYEqPde0sgX' => 
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
        'as' => 'generated::TW93OvYEqPde0sgX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ScCKN0IPYAP81X0h' => 
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
        'as' => 'generated::ScCKN0IPYAP81X0h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iay8UsMKqQQKJvve' => 
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
        'as' => 'generated::iay8UsMKqQQKJvve',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LgPe45dslUz2R2tn' => 
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
        'as' => 'generated::LgPe45dslUz2R2tn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AHT2SC2j5vX3i5qw' => 
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
        'as' => 'generated::AHT2SC2j5vX3i5qw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t5diEL2fmji9vEdz' => 
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
        'as' => 'generated::t5diEL2fmji9vEdz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HdcS15VCtcciwy5p' => 
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
        'as' => 'generated::HdcS15VCtcciwy5p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wU9ZQ4nWjQWh1gGn' => 
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
        'as' => 'generated::wU9ZQ4nWjQWh1gGn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AyE76G5DypRnbSQm' => 
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
        'as' => 'generated::AyE76G5DypRnbSQm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Umz7ZsFQzZ2iqoAN' => 
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
        'as' => 'generated::Umz7ZsFQzZ2iqoAN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::acf45YXDlViWcAqa' => 
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
        'as' => 'generated::acf45YXDlViWcAqa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1wkuecrMsfr09Q4a' => 
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
        'as' => 'generated::1wkuecrMsfr09Q4a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MrKGsExrJwBA58R8' => 
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
        'as' => 'generated::MrKGsExrJwBA58R8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8VOXNPBEGKYtbg4E' => 
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
        'as' => 'generated::8VOXNPBEGKYtbg4E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZaXgxW0FMzGemHDO' => 
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
        'as' => 'generated::ZaXgxW0FMzGemHDO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L8soSeZ8r6Lo472q' => 
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
        'as' => 'generated::L8soSeZ8r6Lo472q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q57wrAYFtFOmVcYm' => 
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
        'as' => 'generated::Q57wrAYFtFOmVcYm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::loCLFcJ2DOv5aDtl' => 
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
        'as' => 'generated::loCLFcJ2DOv5aDtl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QJZukISTfkGsWgwA' => 
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
        'as' => 'generated::QJZukISTfkGsWgwA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IAy7sfM3mvj8nNIj' => 
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
        'as' => 'generated::IAy7sfM3mvj8nNIj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RuM97xWFDgp5gQ7s' => 
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
        'as' => 'generated::RuM97xWFDgp5gQ7s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gS27GrAeBYpKt6v8' => 
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
        'as' => 'generated::gS27GrAeBYpKt6v8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::w1xkDR7nmdoNsImU' => 
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
        'as' => 'generated::w1xkDR7nmdoNsImU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ahueSgnKdgH2qb1u' => 
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
        'as' => 'generated::ahueSgnKdgH2qb1u',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tU5VyChjtE9yQciV' => 
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
        'as' => 'generated::tU5VyChjtE9yQciV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1697fCiTB2kMK961' => 
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
        'as' => 'generated::1697fCiTB2kMK961',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HEKDyw6lgnWa9WD0' => 
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
        'as' => 'generated::HEKDyw6lgnWa9WD0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7MI72LJcA4LMyuAS' => 
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
        'as' => 'generated::7MI72LJcA4LMyuAS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UckWVT4d2tdB9qWV' => 
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
        'as' => 'generated::UckWVT4d2tdB9qWV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dLkdnOlZ71PJDDar' => 
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
        'as' => 'generated::dLkdnOlZ71PJDDar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Fzo4XTZuyZSMbXBC' => 
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
        'as' => 'generated::Fzo4XTZuyZSMbXBC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OwDFI4TRyfQdqVt9' => 
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
        'as' => 'generated::OwDFI4TRyfQdqVt9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ek1sfs963aEugqrh' => 
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
        'as' => 'generated::ek1sfs963aEugqrh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SRzXkVsbFRaKRKU6' => 
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
        'as' => 'generated::SRzXkVsbFRaKRKU6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KBs8YtjB33J4UAfG' => 
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
        'as' => 'generated::KBs8YtjB33J4UAfG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aBGlwmgSse4kTidE' => 
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
        'as' => 'generated::aBGlwmgSse4kTidE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MfFoUza5z4aHbqd8' => 
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
        'as' => 'generated::MfFoUza5z4aHbqd8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DXBeD0O0E7DfMsz4' => 
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
        'as' => 'generated::DXBeD0O0E7DfMsz4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KS38W2PanSiOkAE2' => 
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
        'as' => 'generated::KS38W2PanSiOkAE2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AUVPP2a1cImGYtX4' => 
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
        'as' => 'generated::AUVPP2a1cImGYtX4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4WtRYltgLADWQY4v' => 
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
        'as' => 'generated::4WtRYltgLADWQY4v',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::C6saolHRj3vRUO2Z' => 
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
        'as' => 'generated::C6saolHRj3vRUO2Z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iy0OYJgt4wbZICQI' => 
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
        'as' => 'generated::iy0OYJgt4wbZICQI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p1EigjEAmC2uHrhG' => 
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
        'as' => 'generated::p1EigjEAmC2uHrhG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VFXYfz6JO2vJhIia' => 
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
        'as' => 'generated::VFXYfz6JO2vJhIia',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZS87nh8LoRts9o03' => 
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
        'as' => 'generated::ZS87nh8LoRts9o03',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tRZzpzQtf95rv8V1' => 
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
        'as' => 'generated::tRZzpzQtf95rv8V1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::07ihdDjHmymfmpGb' => 
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
        'as' => 'generated::07ihdDjHmymfmpGb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZHrngjEVJEJbiFIN' => 
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
        'as' => 'generated::ZHrngjEVJEJbiFIN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::d7FDcPfOTBrTSDCS' => 
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
        'as' => 'generated::d7FDcPfOTBrTSDCS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t1HJ5OrKLkmH0XEi' => 
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
        'as' => 'generated::t1HJ5OrKLkmH0XEi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NSFhU6yDzxPn7ytd' => 
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
        'as' => 'generated::NSFhU6yDzxPn7ytd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::l7zTrHWlsU7l9VZG' => 
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
        'as' => 'generated::l7zTrHWlsU7l9VZG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wfHIP0WHsHBpkuV2' => 
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
        'as' => 'generated::wfHIP0WHsHBpkuV2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SHhJv9PZCObcAY4g' => 
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
        'as' => 'generated::SHhJv9PZCObcAY4g',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uIn4A4YzOTZX4VUp' => 
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
        'as' => 'generated::uIn4A4YzOTZX4VUp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CJJtAd9iRWfCLZU3' => 
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
        'as' => 'generated::CJJtAd9iRWfCLZU3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a9WwFeDNNlv98NGt' => 
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
        'as' => 'generated::a9WwFeDNNlv98NGt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FkqXdyGMbaRZcJft' => 
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
        'as' => 'generated::FkqXdyGMbaRZcJft',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4zEHQ1u7DVdJqrGs' => 
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
        'as' => 'generated::4zEHQ1u7DVdJqrGs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XlD3e50vB8XrM0u8' => 
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
        'as' => 'generated::XlD3e50vB8XrM0u8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hzh47D8JDyFq63JJ' => 
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
        'as' => 'generated::hzh47D8JDyFq63JJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cWlYfrYbw3FVqlbN' => 
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
        'as' => 'generated::cWlYfrYbw3FVqlbN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LPisZGgo267ak1t1' => 
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
        'as' => 'generated::LPisZGgo267ak1t1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DDo1dF5HyZfR8zhJ' => 
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
        'as' => 'generated::DDo1dF5HyZfR8zhJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NKncT7ILDqYPf0bG' => 
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
        'as' => 'generated::NKncT7ILDqYPf0bG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OHVB7cZzLXTdGHj6' => 
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
        'as' => 'generated::OHVB7cZzLXTdGHj6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Yz5oDvdBzDu9xppc' => 
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
        'as' => 'generated::Yz5oDvdBzDu9xppc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lhnHePZpidnPLAeI' => 
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
        'as' => 'generated::lhnHePZpidnPLAeI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wkcMcIwTlsNVvats' => 
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
        'as' => 'generated::wkcMcIwTlsNVvats',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t41y8C2UTV8mg2vw' => 
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
        'as' => 'generated::t41y8C2UTV8mg2vw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QWO4OTe4YRIh9Mpk' => 
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
        'as' => 'generated::QWO4OTe4YRIh9Mpk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FJ6AanmG8WNi0VHg' => 
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
        'as' => 'generated::FJ6AanmG8WNi0VHg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3Nv4XYhloxdaRZ06' => 
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
        'as' => 'generated::3Nv4XYhloxdaRZ06',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LLn2bmUiCksiKoWF' => 
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
        'as' => 'generated::LLn2bmUiCksiKoWF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cUwJUOCQkdP6lTER' => 
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
        'as' => 'generated::cUwJUOCQkdP6lTER',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::M3isFx8keX9NTIe3' => 
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
        'as' => 'generated::M3isFx8keX9NTIe3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RRBqp2DdRujcgWRm' => 
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
        'as' => 'generated::RRBqp2DdRujcgWRm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yYhHZTL72PleTrsX' => 
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
        'as' => 'generated::yYhHZTL72PleTrsX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::axDhbT3fcaVvFTRm' => 
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
        'as' => 'generated::axDhbT3fcaVvFTRm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EVh1uh6jFqJDHnbN' => 
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
        'as' => 'generated::EVh1uh6jFqJDHnbN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MIbSyo0J4bDUdlGE' => 
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
        'as' => 'generated::MIbSyo0J4bDUdlGE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Sq239vQ2TiVacw36' => 
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
        'as' => 'generated::Sq239vQ2TiVacw36',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3WqjfPlzCGMLdVPB' => 
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
        'as' => 'generated::3WqjfPlzCGMLdVPB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L1Uc0mZrkR0y34o2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/web/student-class-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
          2 => 'permission:delete-student-classes',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\School\\StudentClassController@delete',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::L1Uc0mZrkR0y34o2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::S60spHLfnSbUJZ3f' => 
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
        'as' => 'generated::S60spHLfnSbUJZ3f',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TCXxZin5FnLDWXQJ' => 
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
        'as' => 'generated::TCXxZin5FnLDWXQJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Td6vggIXvP89iyOR' => 
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
        'as' => 'generated::Td6vggIXvP89iyOR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CWK5oKoa8WLswc2r' => 
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
        'as' => 'generated::CWK5oKoa8WLswc2r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0oOuVlX7EVX5eoeI' => 
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
        'as' => 'generated::0oOuVlX7EVX5eoeI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sjee5q320BLkNVMI' => 
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
        'as' => 'generated::sjee5q320BLkNVMI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0lpdP8nVzRECrbKj' => 
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
        'as' => 'generated::0lpdP8nVzRECrbKj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9h3CJc29X5qeRwdl' => 
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
        'as' => 'generated::9h3CJc29X5qeRwdl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qYGmqvLLGcQwRu0w' => 
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
        'as' => 'generated::qYGmqvLLGcQwRu0w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::37NURVL4QuJ197PG' => 
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
        'as' => 'generated::37NURVL4QuJ197PG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IAECd7cFKLz8yOaE' => 
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
        'as' => 'generated::IAECd7cFKLz8yOaE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SisQmLBM0wGg39vb' => 
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
        'as' => 'generated::SisQmLBM0wGg39vb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MrImlX1CYnpLBo0k' => 
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
        'as' => 'generated::MrImlX1CYnpLBo0k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pYVIcAm18ABjyLUK' => 
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
        'as' => 'generated::pYVIcAm18ABjyLUK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::haE87QYRi6q73LDS' => 
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
        'as' => 'generated::haE87QYRi6q73LDS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p9jjL6tOWLbjip0n' => 
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
        'as' => 'generated::p9jjL6tOWLbjip0n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yFNEwIukBSybHjxv' => 
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
        'as' => 'generated::yFNEwIukBSybHjxv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7j5U7hwHvDNQ5hDB' => 
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
        'as' => 'generated::7j5U7hwHvDNQ5hDB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fl9Cj4pQPMZxyRnK' => 
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
        'as' => 'generated::fl9Cj4pQPMZxyRnK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6YlfWADUZZGfecyW' => 
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
        'as' => 'generated::6YlfWADUZZGfecyW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xt5l0ftzQLyKHxRL' => 
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
        'as' => 'generated::xt5l0ftzQLyKHxRL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8bODcFCRQBqjUrzC' => 
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
        'as' => 'generated::8bODcFCRQBqjUrzC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TfUQkKLrncWf0pcT' => 
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
        'as' => 'generated::TfUQkKLrncWf0pcT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZJKVcUnEV5yzJJjY' => 
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
        'as' => 'generated::ZJKVcUnEV5yzJJjY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IRShblRvjZILcIzP' => 
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
        'as' => 'generated::IRShblRvjZILcIzP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PckIaoyDrXN75gPU' => 
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
        'as' => 'generated::PckIaoyDrXN75gPU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::usWmiFhA98vMJTeo' => 
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
          2 => 'permission:view-teachers|view-score-entry|approve-score-entry',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'controller' => 'App\\Http\\Controllers\\Api\\App\\TelegramConnectionController@sendMessageToChat',
        'namespace' => NULL,
        'prefix' => 'api/web',
        'where' => 
        array (
        ),
        'as' => 'generated::usWmiFhA98vMJTeo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Pp6WoqQJF1QqT8U5' => 
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
        'as' => 'generated::Pp6WoqQJF1QqT8U5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OyQxVhQCsmvhTvtJ' => 
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
        'as' => 'generated::OyQxVhQCsmvhTvtJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JJMIwAOgztVgA2gi' => 
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
        'as' => 'generated::JJMIwAOgztVgA2gi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SsVYjV1OefMcldND' => 
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
        'as' => 'generated::SsVYjV1OefMcldND',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3VIDKi3oYgxbzl3G' => 
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
        'as' => 'generated::3VIDKi3oYgxbzl3G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3YeOI6c1OTM4UFiT' => 
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
        'as' => 'generated::3YeOI6c1OTM4UFiT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sRd2DG1G588RhLtZ' => 
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
        'as' => 'generated::sRd2DG1G588RhLtZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gI7yrRE8o7UVO8UH' => 
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
        'as' => 'generated::gI7yrRE8o7UVO8UH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pYcd4kn4JHGwMCsQ' => 
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
        'as' => 'generated::pYcd4kn4JHGwMCsQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IGZUqq4Rv3wF7SPd' => 
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
        'as' => 'generated::IGZUqq4Rv3wF7SPd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::awvRFhFRA9KEwcoy' => 
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
        'as' => 'generated::awvRFhFRA9KEwcoy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RCLw0KL0uKsP8YxY' => 
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
        'as' => 'generated::RCLw0KL0uKsP8YxY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fzpLMAsWWwXqhUbW' => 
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
        'as' => 'generated::fzpLMAsWWwXqhUbW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RyLP8ZkHFiwnvapc' => 
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
        'as' => 'generated::RyLP8ZkHFiwnvapc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V9Hwy8ZJPHoXdYMK' => 
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
        'as' => 'generated::V9Hwy8ZJPHoXdYMK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::T2rSkrARKBhM9Bte' => 
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
        'as' => 'generated::T2rSkrARKBhM9Bte',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mC3ULofdAbK9vlUj' => 
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
        'as' => 'generated::mC3ULofdAbK9vlUj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PTpo1CnTet8FZHWy' => 
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
        'as' => 'generated::PTpo1CnTet8FZHWy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GvY2FziKvM615yJ3' => 
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
        'as' => 'generated::GvY2FziKvM615yJ3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kqHFRKyGWMQxcGUN' => 
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
        'as' => 'generated::kqHFRKyGWMQxcGUN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::26bX3PLrmrcF0mZI' => 
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
        'as' => 'generated::26bX3PLrmrcF0mZI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DCZUzeQNptGA5fGl' => 
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
        'as' => 'generated::DCZUzeQNptGA5fGl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g01yhnAeDCModZnL' => 
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
        'as' => 'generated::g01yhnAeDCModZnL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fKFGtqARIHA5HjkN' => 
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
        'as' => 'generated::fKFGtqARIHA5HjkN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xzIR7e1ikGCJs6zW' => 
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
        'as' => 'generated::xzIR7e1ikGCJs6zW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jq6glzcbYrpOEvE9' => 
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
        'as' => 'generated::jq6glzcbYrpOEvE9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5HfemuE1cK6j7EE6' => 
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
        'as' => 'generated::5HfemuE1cK6j7EE6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SKDCN2cQuGcec336' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000001750000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::SKDCN2cQuGcec336',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::anPnBMuUu9jUrWCT' => 
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
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"00000000000004370000000000000000";}}',
        'as' => 'generated::anPnBMuUu9jUrWCT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::owtwnLlGuCBQQDAY' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005450000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::owtwnLlGuCBQQDAY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k4x2PIvKUWN4Dlal' => 
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
        'as' => 'generated::k4x2PIvKUWN4Dlal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4EYrJz7aFYfvdT2G' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005480000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::4EYrJz7aFYfvdT2G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GM8gWdQlMNEu9Oay' => 
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
        'as' => 'generated::GM8gWdQlMNEu9Oay',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
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
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000005520000000000000000";}}',
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
