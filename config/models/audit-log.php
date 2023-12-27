<?php

return [
    'model'             => 'AuditLog',
    'controller'        => 'AuditLogController',
    'route_name'        => 'audit-logs',
    'route_path'        => 'audit-logs',
    'route_view'        => 'audit-logs',
    'permissions'       => [
        'access'        => 'audit_log_access',
        'create'        => '',
        'show'          => 'audit_log_show',
        'edit'          => '',
        'delete'        => '',
    ],
    'singular'          => 'audit_log',
    'plural'            => 'audit_logs',
];
