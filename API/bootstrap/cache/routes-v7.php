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
            '_route' => 'generated::hm0t5TfIhtJhlWNV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::P3gs9pOPnpHIBSIb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4rbsYsXeRl1smFN8',
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
            '_route' => 'generated::rZMH6qsAyVqxx7Ry',
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
            '_route' => 'generated::L3cOSkyCPDHBgqem',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8UF62U5Lb0AP3ZqB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nj8XkTgv4fqbbqln',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::uY2QVMv2dIB1C4Lq',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::iJFawZ3mEakddd2L',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::57WtAYnUpzD8IHm9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Qrm1Q0zlnfUdHeUe',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cx4p4JKD8WU5AqFd',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::WcofeF3twR2qbdD8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::txPibnBDYmFefDdc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::kxO02b8U1rqWXj1q',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Rha8HICZXRhofKOg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::11MXScO3bR0ElSjd',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::UNz5cNv68QI736Bp',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::5egBcpOnKqO5Is8e',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Mi3NJDcpMBXtPiDC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::iCFocFZrlqyd9dKi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Zeixr5MuBCpjSpOC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::vKcy7ymz0EolNB1u',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::HAZsRbcg4JPRtKsL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8M2Uad5tGgsmjK9S',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GRxAhx2DSMnGx9Je',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Z44xZPOe5YIOH3qK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::p2NR7acP8d9k2TWN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rvk71XfL2Iw3Qbt2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Nv9gjiieuQ2LbJNs',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::p0va2InPdgJt7ExS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::eepsdJ52LHd0xYEM',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SfRqTHsZxHH9RrRp',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EBjABVXEXl4y0E3Y',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::BFIe523kJtv9k5bK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::oiAVwKrd1XPP75jR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GLRhT1iwuH41lQU4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CnwTWjEZnD0Ui69t',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::eZkbD4UteGnTr6KI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3Lq3KkKxmTNkdl2X',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ZT71PctPUjSNNpmJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::T5FsI2HKMzCBpnlI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::UsH2AKZs774WJFav',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7gul0w683h52abGK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::upMNxbptF6eMEqUA',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::CHJiJmj0Ob2AQnTk',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mGUBvAgA8VkD3Dv3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::dsIp47B7qQjo2hgn',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::HvcCsNhe6Oji7ypV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Uf40zSUMr09NRg0A',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FkVAWUvs1OfuurnD',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::c5gQHD5orNbjoYhS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::IJUqHx0JQ1mdlZ2x',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::54ber7DnZX218uBb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::fHD2m9qAs0GbTpMF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nxX9qTzcAawduvyO',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::EeRSh87eURYbwcOm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rxY4jjbqDBBziKGN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nlmj30ByEicwMuQ5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GJrfeF0pVOggRRRx',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::n35xTArsUE4Kaloq',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::cBB1gB7yZxxUPciV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::XJr0WiyIVMAY04AX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GRn6lL543oYynsnJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::v4jeUzX8dMGBsTLU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rH5N0ninb1VjLjNL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::vEgHy9LSU2mDiDBa',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ljBlEwh9LPRZlrO9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QxvCHZXogT8z300N',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::yObH3oUZNOTZjYFX',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::vehvNIwEpgZCgnJu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::hICWW9e4jENvpNg5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::lLWxLbuibovyRp8t',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::V4wWoEkhSWc5XhG7',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::2VAIiA0yLJVXCuUV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::DvU6uCgnEuNohSyW',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Lt3GKubCvi9cULfQ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::jSFeqp5q92LtadOm',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MOWlkiLwYIW0uBhM',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::UYwxAMM9MXLQYKYz',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::k6XmsGNwMHWkyTOi',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Jdv47v7kLayYm1Eb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Xo2YaznmfrgSYds7',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FOcVaT1Si5fDwQtL',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::sfDbCfzkl1wbWDml',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::aUZm7FqcByf0kliI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::65Zg8RX30OBjSOiV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pt32dne6faWpCyoA',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KVQa3Lo3iYpmvaha',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3wiPIVyJ4TTrFrm5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QtKQOKhKkhTkc3L1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::U0kNAq0txFr1sYBb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::90L33nnUrrKPjuBo',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::x8h4dGTPCHbdtHG0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::mwVwftyJZu60smrW',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::wZICLOHjDjOU6qqN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MfYAPkFpZUp1PJVK',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0tMUlaLOENp2slw5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Ftkvv6rvOP4ZxtQg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::SlCaTdcqRdi4aAhM',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gXjD0VZ8WVJrmCBo',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0a6HFkR94OP9ysEb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nqsyx71Z0in3gXKS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::FE3G5fhUqoiKXhah',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rW0nx6byLmmkmEcU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::E6p0UEfPyAriQih2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::oP2BmFQ3ftTXZ5vA',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::pm5r7VSPMIwKgUWp',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::2WBRIpth6CXWNCMH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0g4iaoLBUe8Ngc0J',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::WwuPO1rq6zxlEm60',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7grZrsm20XaRRZHZ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::WFOJkDKywGZkWG2E',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::34A1kK7e7DYtolIF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::H658D1l720dNTdv4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::XVNK6RIRh07Zu9e3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::E9cywKIlzg1MqNcB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QaYQBXbtoub5MGlt',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::PoC9rqcFyhydhZFY',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::kNohR650ZSGX0yKB',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gxdx8OXIOYwVTVMU',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8xHIstCdQrO0m3Ww',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::saVajU8VTxrddt8Z',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0f5uvt13ZmqwozfR',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::qrI5KMKtcCEMaUaI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::dbuVYdm0xWBIZLsu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::9gMrrVgKn8iTAGfO',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ze9F8wUme03GR3F1',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gOekKFzcWTc9696P',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::eGyd59tXDSjVhc1P',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::fRNztl7ADlX4gLr2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::oozlQFPHSMT1XStc',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::gEHBjV4DuJxPKyt3',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nRpAOtM6YY1WJgRx',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::ferZ9eSS49MD45f7',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::BpdVg7BPjce3jJvu',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::bMgCzciWIu56Wqmg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::nIPsGkmEgImwjb9K',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QHCDlzx5cDbAE0tN',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::0BKMcs1ZqerI4X69',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::hn0RDONfo9E4vD7O',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::x23lbHTkRtYLnIR0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::H7wbip6p5SPeyzrF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4my8l6nEmCCsc0R5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Q43Xw55QFaIDOW3o',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GFVrohy4VWToMNCQ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Rv3YE4aYP1K2V1Vo',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::zfYxARMIoepbeL8N',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QLYKcJy0tlk9cxJp',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::17NxwOvXz35PCILE',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::GDwkNhMIjpF866d9',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MOO3yY760vI1liLI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::RkVBT95oaGcj33mx',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Ixz7Iupc4TvNSGtg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::1gIvQdFbOmg2mJzC',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::YNEuCh3YoahcV17G',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::N4Qdf2jxPkcUJ8o0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Ii13LeN7t521Kz7t',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7BGoU1mlyWYVADn8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::rbkYClcrt0JALQO5',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::bWuMUa0MlPIugJ1c',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::QmWDkqxombwzctZF',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::7oNk8onyUd7tcOwq',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MSAc1w2cJbpinE2i',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::g5uaP4ZRmCrzuLKH',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::icol3vNNNd9aBSVS',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::F41hK7spPMp0J3fb',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::lxs7vlHcNOBbcxwg',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::hUjzr4shG8agPrV8',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::MmlcUpK2Yn0qVIGG',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::Uq6L3ItyjufbNtxk',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::sDN2d92HSx6aOiPJ',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::u5TJi0N3npNg7Yx2',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::3Hi193vwF35h3OIr',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::JswViJAZ8jTVi8XV',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::8dCbLFWD9CA6QWPv',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::4OsBZI5taLVyh6H0',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::AJl3E2mjKaUTt9C4',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::a8I3ZSJOJkEc2tYI',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::kvqwIk8sChE1sSzk',
          ),
          1 => NULL,
          2 => 
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
            '_route' => 'generated::KoqgsNqVmXzfByMA',
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
            '_route' => 'generated::OgZser9QT9EMxhDE',
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
            '_route' => 'generated::ZicVkCRXX1O1MD0r',
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
            '_route' => 'generated::QrhpVZvTmBsbmkIS',
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
            '_route' => 'generated::PHVgqmysOqPyUSTP',
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
    'generated::hm0t5TfIhtJhlWNV' => 
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
        'as' => 'generated::hm0t5TfIhtJhlWNV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::P3gs9pOPnpHIBSIb' => 
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
        'as' => 'generated::P3gs9pOPnpHIBSIb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4rbsYsXeRl1smFN8' => 
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
        'as' => 'generated::4rbsYsXeRl1smFN8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rZMH6qsAyVqxx7Ry' => 
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
        'as' => 'generated::rZMH6qsAyVqxx7Ry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L3cOSkyCPDHBgqem' => 
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
        'as' => 'generated::L3cOSkyCPDHBgqem',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8UF62U5Lb0AP3ZqB' => 
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
        'as' => 'generated::8UF62U5Lb0AP3ZqB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nj8XkTgv4fqbbqln' => 
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
        'as' => 'generated::nj8XkTgv4fqbbqln',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uY2QVMv2dIB1C4Lq' => 
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
        'as' => 'generated::uY2QVMv2dIB1C4Lq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iJFawZ3mEakddd2L' => 
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
        'as' => 'generated::iJFawZ3mEakddd2L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::57WtAYnUpzD8IHm9' => 
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
        'as' => 'generated::57WtAYnUpzD8IHm9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Qrm1Q0zlnfUdHeUe' => 
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
        'as' => 'generated::Qrm1Q0zlnfUdHeUe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cx4p4JKD8WU5AqFd' => 
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
        'as' => 'generated::cx4p4JKD8WU5AqFd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WcofeF3twR2qbdD8' => 
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
        'as' => 'generated::WcofeF3twR2qbdD8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::txPibnBDYmFefDdc' => 
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
        'as' => 'generated::txPibnBDYmFefDdc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kxO02b8U1rqWXj1q' => 
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
        'as' => 'generated::kxO02b8U1rqWXj1q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Rha8HICZXRhofKOg' => 
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
        'as' => 'generated::Rha8HICZXRhofKOg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::11MXScO3bR0ElSjd' => 
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
        'as' => 'generated::11MXScO3bR0ElSjd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UNz5cNv68QI736Bp' => 
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
        'as' => 'generated::UNz5cNv68QI736Bp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5egBcpOnKqO5Is8e' => 
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
        'as' => 'generated::5egBcpOnKqO5Is8e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Mi3NJDcpMBXtPiDC' => 
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
        'as' => 'generated::Mi3NJDcpMBXtPiDC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iCFocFZrlqyd9dKi' => 
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
        'as' => 'generated::iCFocFZrlqyd9dKi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Zeixr5MuBCpjSpOC' => 
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
        'as' => 'generated::Zeixr5MuBCpjSpOC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vKcy7ymz0EolNB1u' => 
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
        'as' => 'generated::vKcy7ymz0EolNB1u',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HAZsRbcg4JPRtKsL' => 
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
        'as' => 'generated::HAZsRbcg4JPRtKsL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8M2Uad5tGgsmjK9S' => 
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
        'as' => 'generated::8M2Uad5tGgsmjK9S',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GRxAhx2DSMnGx9Je' => 
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
        'as' => 'generated::GRxAhx2DSMnGx9Je',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z44xZPOe5YIOH3qK' => 
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
        'as' => 'generated::Z44xZPOe5YIOH3qK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p2NR7acP8d9k2TWN' => 
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
        'as' => 'generated::p2NR7acP8d9k2TWN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rvk71XfL2Iw3Qbt2' => 
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
        'as' => 'generated::rvk71XfL2Iw3Qbt2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Nv9gjiieuQ2LbJNs' => 
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
        'as' => 'generated::Nv9gjiieuQ2LbJNs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p0va2InPdgJt7ExS' => 
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
        'as' => 'generated::p0va2InPdgJt7ExS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eepsdJ52LHd0xYEM' => 
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
        'as' => 'generated::eepsdJ52LHd0xYEM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SfRqTHsZxHH9RrRp' => 
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
        'as' => 'generated::SfRqTHsZxHH9RrRp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EBjABVXEXl4y0E3Y' => 
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
        'as' => 'generated::EBjABVXEXl4y0E3Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BFIe523kJtv9k5bK' => 
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
        'as' => 'generated::BFIe523kJtv9k5bK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oiAVwKrd1XPP75jR' => 
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
        'as' => 'generated::oiAVwKrd1XPP75jR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GLRhT1iwuH41lQU4' => 
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
        'as' => 'generated::GLRhT1iwuH41lQU4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CnwTWjEZnD0Ui69t' => 
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
        'as' => 'generated::CnwTWjEZnD0Ui69t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eZkbD4UteGnTr6KI' => 
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
        'as' => 'generated::eZkbD4UteGnTr6KI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3Lq3KkKxmTNkdl2X' => 
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
        'as' => 'generated::3Lq3KkKxmTNkdl2X',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZT71PctPUjSNNpmJ' => 
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
        'as' => 'generated::ZT71PctPUjSNNpmJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::T5FsI2HKMzCBpnlI' => 
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
        'as' => 'generated::T5FsI2HKMzCBpnlI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UsH2AKZs774WJFav' => 
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
        'as' => 'generated::UsH2AKZs774WJFav',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7gul0w683h52abGK' => 
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
        'as' => 'generated::7gul0w683h52abGK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::upMNxbptF6eMEqUA' => 
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
        'as' => 'generated::upMNxbptF6eMEqUA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CHJiJmj0Ob2AQnTk' => 
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
        'as' => 'generated::CHJiJmj0Ob2AQnTk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mGUBvAgA8VkD3Dv3' => 
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
        'as' => 'generated::mGUBvAgA8VkD3Dv3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dsIp47B7qQjo2hgn' => 
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
        'as' => 'generated::dsIp47B7qQjo2hgn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HvcCsNhe6Oji7ypV' => 
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
        'as' => 'generated::HvcCsNhe6Oji7ypV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Uf40zSUMr09NRg0A' => 
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
        'as' => 'generated::Uf40zSUMr09NRg0A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FkVAWUvs1OfuurnD' => 
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
        'as' => 'generated::FkVAWUvs1OfuurnD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::c5gQHD5orNbjoYhS' => 
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
        'as' => 'generated::c5gQHD5orNbjoYhS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IJUqHx0JQ1mdlZ2x' => 
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
        'as' => 'generated::IJUqHx0JQ1mdlZ2x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::54ber7DnZX218uBb' => 
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
        'as' => 'generated::54ber7DnZX218uBb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fHD2m9qAs0GbTpMF' => 
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
        'as' => 'generated::fHD2m9qAs0GbTpMF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nxX9qTzcAawduvyO' => 
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
        'as' => 'generated::nxX9qTzcAawduvyO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EeRSh87eURYbwcOm' => 
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
        'as' => 'generated::EeRSh87eURYbwcOm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rxY4jjbqDBBziKGN' => 
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
        'as' => 'generated::rxY4jjbqDBBziKGN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nlmj30ByEicwMuQ5' => 
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
        'as' => 'generated::nlmj30ByEicwMuQ5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GJrfeF0pVOggRRRx' => 
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
        'as' => 'generated::GJrfeF0pVOggRRRx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::n35xTArsUE4Kaloq' => 
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
        'as' => 'generated::n35xTArsUE4Kaloq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cBB1gB7yZxxUPciV' => 
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
        'as' => 'generated::cBB1gB7yZxxUPciV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XJr0WiyIVMAY04AX' => 
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
        'as' => 'generated::XJr0WiyIVMAY04AX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GRn6lL543oYynsnJ' => 
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
        'as' => 'generated::GRn6lL543oYynsnJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::v4jeUzX8dMGBsTLU' => 
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
        'as' => 'generated::v4jeUzX8dMGBsTLU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rH5N0ninb1VjLjNL' => 
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
        'as' => 'generated::rH5N0ninb1VjLjNL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vEgHy9LSU2mDiDBa' => 
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
        'as' => 'generated::vEgHy9LSU2mDiDBa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ljBlEwh9LPRZlrO9' => 
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
        'as' => 'generated::ljBlEwh9LPRZlrO9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QxvCHZXogT8z300N' => 
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
        'as' => 'generated::QxvCHZXogT8z300N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yObH3oUZNOTZjYFX' => 
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
        'as' => 'generated::yObH3oUZNOTZjYFX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vehvNIwEpgZCgnJu' => 
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
        'as' => 'generated::vehvNIwEpgZCgnJu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hICWW9e4jENvpNg5' => 
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
        'as' => 'generated::hICWW9e4jENvpNg5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lLWxLbuibovyRp8t' => 
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
        'as' => 'generated::lLWxLbuibovyRp8t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::V4wWoEkhSWc5XhG7' => 
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
        'as' => 'generated::V4wWoEkhSWc5XhG7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2VAIiA0yLJVXCuUV' => 
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
        'as' => 'generated::2VAIiA0yLJVXCuUV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DvU6uCgnEuNohSyW' => 
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
        'as' => 'generated::DvU6uCgnEuNohSyW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Lt3GKubCvi9cULfQ' => 
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
        'as' => 'generated::Lt3GKubCvi9cULfQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jSFeqp5q92LtadOm' => 
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
        'as' => 'generated::jSFeqp5q92LtadOm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MOWlkiLwYIW0uBhM' => 
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
        'as' => 'generated::MOWlkiLwYIW0uBhM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UYwxAMM9MXLQYKYz' => 
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
        'as' => 'generated::UYwxAMM9MXLQYKYz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k6XmsGNwMHWkyTOi' => 
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
        'as' => 'generated::k6XmsGNwMHWkyTOi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jdv47v7kLayYm1Eb' => 
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
        'as' => 'generated::Jdv47v7kLayYm1Eb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Xo2YaznmfrgSYds7' => 
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
        'as' => 'generated::Xo2YaznmfrgSYds7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FOcVaT1Si5fDwQtL' => 
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
        'as' => 'generated::FOcVaT1Si5fDwQtL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sfDbCfzkl1wbWDml' => 
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
        'as' => 'generated::sfDbCfzkl1wbWDml',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aUZm7FqcByf0kliI' => 
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
        'as' => 'generated::aUZm7FqcByf0kliI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::65Zg8RX30OBjSOiV' => 
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
        'as' => 'generated::65Zg8RX30OBjSOiV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pt32dne6faWpCyoA' => 
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
        'as' => 'generated::pt32dne6faWpCyoA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KVQa3Lo3iYpmvaha' => 
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
        'as' => 'generated::KVQa3Lo3iYpmvaha',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3wiPIVyJ4TTrFrm5' => 
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
        'as' => 'generated::3wiPIVyJ4TTrFrm5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QtKQOKhKkhTkc3L1' => 
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
        'as' => 'generated::QtKQOKhKkhTkc3L1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::U0kNAq0txFr1sYBb' => 
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
        'as' => 'generated::U0kNAq0txFr1sYBb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::90L33nnUrrKPjuBo' => 
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
        'as' => 'generated::90L33nnUrrKPjuBo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x8h4dGTPCHbdtHG0' => 
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
        'as' => 'generated::x8h4dGTPCHbdtHG0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mwVwftyJZu60smrW' => 
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
        'as' => 'generated::mwVwftyJZu60smrW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wZICLOHjDjOU6qqN' => 
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
        'as' => 'generated::wZICLOHjDjOU6qqN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MfYAPkFpZUp1PJVK' => 
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
        'as' => 'generated::MfYAPkFpZUp1PJVK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0tMUlaLOENp2slw5' => 
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
        'as' => 'generated::0tMUlaLOENp2slw5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ftkvv6rvOP4ZxtQg' => 
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
        'as' => 'generated::Ftkvv6rvOP4ZxtQg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SlCaTdcqRdi4aAhM' => 
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
        'as' => 'generated::SlCaTdcqRdi4aAhM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gXjD0VZ8WVJrmCBo' => 
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
        'as' => 'generated::gXjD0VZ8WVJrmCBo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0a6HFkR94OP9ysEb' => 
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
        'as' => 'generated::0a6HFkR94OP9ysEb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nqsyx71Z0in3gXKS' => 
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
        'as' => 'generated::nqsyx71Z0in3gXKS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FE3G5fhUqoiKXhah' => 
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
        'as' => 'generated::FE3G5fhUqoiKXhah',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rW0nx6byLmmkmEcU' => 
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
        'as' => 'generated::rW0nx6byLmmkmEcU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::E6p0UEfPyAriQih2' => 
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
        'as' => 'generated::E6p0UEfPyAriQih2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oP2BmFQ3ftTXZ5vA' => 
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
        'as' => 'generated::oP2BmFQ3ftTXZ5vA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pm5r7VSPMIwKgUWp' => 
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
        'as' => 'generated::pm5r7VSPMIwKgUWp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2WBRIpth6CXWNCMH' => 
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
        'as' => 'generated::2WBRIpth6CXWNCMH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0g4iaoLBUe8Ngc0J' => 
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
        'as' => 'generated::0g4iaoLBUe8Ngc0J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WwuPO1rq6zxlEm60' => 
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
        'as' => 'generated::WwuPO1rq6zxlEm60',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7grZrsm20XaRRZHZ' => 
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
        'as' => 'generated::7grZrsm20XaRRZHZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WFOJkDKywGZkWG2E' => 
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
        'as' => 'generated::WFOJkDKywGZkWG2E',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::34A1kK7e7DYtolIF' => 
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
        'as' => 'generated::34A1kK7e7DYtolIF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H658D1l720dNTdv4' => 
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
        'as' => 'generated::H658D1l720dNTdv4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XVNK6RIRh07Zu9e3' => 
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
        'as' => 'generated::XVNK6RIRh07Zu9e3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::E9cywKIlzg1MqNcB' => 
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
        'as' => 'generated::E9cywKIlzg1MqNcB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QaYQBXbtoub5MGlt' => 
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
        'as' => 'generated::QaYQBXbtoub5MGlt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PoC9rqcFyhydhZFY' => 
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
        'as' => 'generated::PoC9rqcFyhydhZFY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kNohR650ZSGX0yKB' => 
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
        'as' => 'generated::kNohR650ZSGX0yKB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gxdx8OXIOYwVTVMU' => 
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
        'as' => 'generated::gxdx8OXIOYwVTVMU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8xHIstCdQrO0m3Ww' => 
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
        'as' => 'generated::8xHIstCdQrO0m3Ww',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::saVajU8VTxrddt8Z' => 
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
        'as' => 'generated::saVajU8VTxrddt8Z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0f5uvt13ZmqwozfR' => 
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
        'as' => 'generated::0f5uvt13ZmqwozfR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qrI5KMKtcCEMaUaI' => 
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
        'as' => 'generated::qrI5KMKtcCEMaUaI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dbuVYdm0xWBIZLsu' => 
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
        'as' => 'generated::dbuVYdm0xWBIZLsu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9gMrrVgKn8iTAGfO' => 
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
        'as' => 'generated::9gMrrVgKn8iTAGfO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ze9F8wUme03GR3F1' => 
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
        'as' => 'generated::ze9F8wUme03GR3F1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gOekKFzcWTc9696P' => 
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
        'as' => 'generated::gOekKFzcWTc9696P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eGyd59tXDSjVhc1P' => 
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
        'as' => 'generated::eGyd59tXDSjVhc1P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fRNztl7ADlX4gLr2' => 
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
        'as' => 'generated::fRNztl7ADlX4gLr2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oozlQFPHSMT1XStc' => 
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
        'as' => 'generated::oozlQFPHSMT1XStc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::gEHBjV4DuJxPKyt3' => 
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
        'as' => 'generated::gEHBjV4DuJxPKyt3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nRpAOtM6YY1WJgRx' => 
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
        'as' => 'generated::nRpAOtM6YY1WJgRx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ferZ9eSS49MD45f7' => 
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
        'as' => 'generated::ferZ9eSS49MD45f7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BpdVg7BPjce3jJvu' => 
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
        'as' => 'generated::BpdVg7BPjce3jJvu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bMgCzciWIu56Wqmg' => 
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
        'as' => 'generated::bMgCzciWIu56Wqmg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nIPsGkmEgImwjb9K' => 
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
        'as' => 'generated::nIPsGkmEgImwjb9K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QHCDlzx5cDbAE0tN' => 
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
        'as' => 'generated::QHCDlzx5cDbAE0tN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0BKMcs1ZqerI4X69' => 
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
        'as' => 'generated::0BKMcs1ZqerI4X69',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hn0RDONfo9E4vD7O' => 
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
        'as' => 'generated::hn0RDONfo9E4vD7O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::x23lbHTkRtYLnIR0' => 
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
        'as' => 'generated::x23lbHTkRtYLnIR0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H7wbip6p5SPeyzrF' => 
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
        'as' => 'generated::H7wbip6p5SPeyzrF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4my8l6nEmCCsc0R5' => 
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
        'as' => 'generated::4my8l6nEmCCsc0R5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Q43Xw55QFaIDOW3o' => 
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
        'as' => 'generated::Q43Xw55QFaIDOW3o',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GFVrohy4VWToMNCQ' => 
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
        'as' => 'generated::GFVrohy4VWToMNCQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Rv3YE4aYP1K2V1Vo' => 
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
        'as' => 'generated::Rv3YE4aYP1K2V1Vo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zfYxARMIoepbeL8N' => 
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
        'as' => 'generated::zfYxARMIoepbeL8N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QLYKcJy0tlk9cxJp' => 
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
        'as' => 'generated::QLYKcJy0tlk9cxJp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::17NxwOvXz35PCILE' => 
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
        'as' => 'generated::17NxwOvXz35PCILE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GDwkNhMIjpF866d9' => 
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
        'as' => 'generated::GDwkNhMIjpF866d9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MOO3yY760vI1liLI' => 
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
        'as' => 'generated::MOO3yY760vI1liLI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RkVBT95oaGcj33mx' => 
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
        'as' => 'generated::RkVBT95oaGcj33mx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ixz7Iupc4TvNSGtg' => 
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
        'as' => 'generated::Ixz7Iupc4TvNSGtg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1gIvQdFbOmg2mJzC' => 
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
        'as' => 'generated::1gIvQdFbOmg2mJzC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YNEuCh3YoahcV17G' => 
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
        'as' => 'generated::YNEuCh3YoahcV17G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::N4Qdf2jxPkcUJ8o0' => 
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
        'as' => 'generated::N4Qdf2jxPkcUJ8o0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ii13LeN7t521Kz7t' => 
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
        'as' => 'generated::Ii13LeN7t521Kz7t',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7BGoU1mlyWYVADn8' => 
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
        'as' => 'generated::7BGoU1mlyWYVADn8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rbkYClcrt0JALQO5' => 
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
        'as' => 'generated::rbkYClcrt0JALQO5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bWuMUa0MlPIugJ1c' => 
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
        'as' => 'generated::bWuMUa0MlPIugJ1c',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QmWDkqxombwzctZF' => 
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
        'as' => 'generated::QmWDkqxombwzctZF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7oNk8onyUd7tcOwq' => 
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
        'as' => 'generated::7oNk8onyUd7tcOwq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MSAc1w2cJbpinE2i' => 
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
        'as' => 'generated::MSAc1w2cJbpinE2i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g5uaP4ZRmCrzuLKH' => 
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
        'as' => 'generated::g5uaP4ZRmCrzuLKH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::icol3vNNNd9aBSVS' => 
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
        'as' => 'generated::icol3vNNNd9aBSVS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F41hK7spPMp0J3fb' => 
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
        'as' => 'generated::F41hK7spPMp0J3fb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lxs7vlHcNOBbcxwg' => 
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
        'as' => 'generated::lxs7vlHcNOBbcxwg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hUjzr4shG8agPrV8' => 
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
        'as' => 'generated::hUjzr4shG8agPrV8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MmlcUpK2Yn0qVIGG' => 
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
        'as' => 'generated::MmlcUpK2Yn0qVIGG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Uq6L3ItyjufbNtxk' => 
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
        'as' => 'generated::Uq6L3ItyjufbNtxk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sDN2d92HSx6aOiPJ' => 
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
        'as' => 'generated::sDN2d92HSx6aOiPJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u5TJi0N3npNg7Yx2' => 
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
        'as' => 'generated::u5TJi0N3npNg7Yx2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3Hi193vwF35h3OIr' => 
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
        'as' => 'generated::3Hi193vwF35h3OIr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JswViJAZ8jTVi8XV' => 
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
        'as' => 'generated::JswViJAZ8jTVi8XV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::8dCbLFWD9CA6QWPv' => 
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
        'as' => 'generated::8dCbLFWD9CA6QWPv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4OsBZI5taLVyh6H0' => 
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
        'as' => 'generated::4OsBZI5taLVyh6H0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AJl3E2mjKaUTt9C4' => 
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
        'as' => 'generated::AJl3E2mjKaUTt9C4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a8I3ZSJOJkEc2tYI' => 
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
        'as' => 'generated::a8I3ZSJOJkEc2tYI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kvqwIk8sChE1sSzk' => 
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
        'as' => 'generated::kvqwIk8sChE1sSzk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KoqgsNqVmXzfByMA' => 
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
        'as' => 'generated::KoqgsNqVmXzfByMA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OgZser9QT9EMxhDE' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000004cc0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OgZser9QT9EMxhDE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZicVkCRXX1O1MD0r' => 
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
        'as' => 'generated::ZicVkCRXX1O1MD0r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QrhpVZvTmBsbmkIS' => 
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
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000004cf0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QrhpVZvTmBsbmkIS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PHVgqmysOqPyUSTP' => 
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
        'as' => 'generated::PHVgqmysOqPyUSTP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
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
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000004d90000000000000000";}}',
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
