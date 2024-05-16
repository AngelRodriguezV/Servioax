--INFO  Running migrations.
--0001_01_01_000000_create_users_table .......................................
create table `users` (
    `id` bigint unsigned not null auto_increment primary key,
    `nombre` varchar(255) not null,
    `apellido_paterno` varchar(255) not null,
    `apellido_materno` varchar(255) not null,
    `email` varchar(255) not null,
    `telefono` varchar(255) not null,
    `email_verified_at` timestamp null,
    `password` varchar(255) not null,
    `remember_token` varchar(100) null,
    `current_team_id` bigint unsigned null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `users`
add unique `users_email_unique`(`email`);

alter table `users`
add unique `users_telefono_unique`(`telefono`);

create table `password_reset_tokens` (
    `email` varchar(255) not null,
    `token` varchar(255) not null,
    `created_at` timestamp null,
    primary key (`email`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `sessions` (
    `id` varchar(255) not null,
    `user_id` bigint unsigned null,
    `ip_address` varchar(45) null,
    `user_agent` text null,
    `payload` longtext not null,
    `last_activity` int not null,
    primary key (`id`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `sessions`
add index `sessions_user_id_index`(`user_id`);

alter table `sessions`
add index `sessions_last_activity_index`(`last_activity`);

--0001_01_01_000001_create_cache_table .......................................
create table `cache` (
    `key` varchar(255) not null,
    `value` mediumtext not null,
    `expiration` int not null,
    primary key (`key`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `cache_locks` (
    `key` varchar(255) not null,
    `owner` varchar(255) not null,
    `expiration` int not null,
    primary key (`key`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

--0001_01_01_000002_create_jobs_table ........................................
create table `jobs` (
    `id` bigint unsigned not null auto_increment primary key,
    `queue` varchar(255) not null,
    `payload` longtext not null,
    `attempts` tinyint unsigned not null,
    `reserved_at` int unsigned null,
    `available_at` int unsigned not null,
    `created_at` int unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `jobs`
add index `jobs_queue_index`(`queue`);

create table `job_batches` (
    `id` varchar(255) not null,
    `name` varchar(255) not null,
    `total_jobs` int not null,
    `pending_jobs` int not null,
    `failed_jobs` int not null,
    `failed_job_ids` longtext not null,
    `options` mediumtext null,
    `cancelled_at` int null,
    `created_at` int not null,
    `finished_at` int null,
    primary key (`id`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

create table `failed_jobs` (
    `id` bigint unsigned not null auto_increment primary key,
    `uuid` varchar(255) not null,
    `connection` text not null,
    `queue` text not null,
    `payload` longtext not null,
    `exception` longtext not null,
    `failed_at` timestamp not null default CURRENT_TIMESTAMP
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `failed_jobs`
add unique `failed_jobs_uuid_unique`(`uuid`);

--2024_03_22_062746_add_two_factor_columns_to_users_table ....................
alter table `users`
    add `two_factor_secret` text null
after `password`,
    add `two_factor_recovery_codes` text null
after `two_factor_secret`,
    add `two_factor_confirmed_at` timestamp null
after `two_factor_recovery_codes`;

--2024_03_22_062800_create_personal_access_tokens_table ......................
create table `personal_access_tokens` (
    `id` bigint unsigned not null auto_increment primary key,
    `tokenable_type` varchar(255) not null,
    `tokenable_id` bigint unsigned not null,
    `name` varchar(255) not null,
    `token` varchar(64) not null,
    `abilities` text null,
    `last_used_at` timestamp null,
    `expires_at` timestamp null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `personal_access_tokens`
add index `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`);

alter table `personal_access_tokens`
add unique `personal_access_tokens_token_unique`(`token`);

--2024_03_22_141551_create_permission_tables .................................
create table `permissions` (
    `id` bigint unsigned not null auto_increment primary key,
    `name` varchar(255) not null,
    `guard_name` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `permissions`
add unique `permissions_name_guard_name_unique`(`name`, `guard_name`);

create table `roles` (
    `id` bigint unsigned not null auto_increment primary key,
    `name` varchar(255) not null,
    `guard_name` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `roles`
add unique `roles_name_guard_name_unique`(`name`, `guard_name`);

create table `model_has_permissions` (
    `permission_id` bigint unsigned not null,
    `model_type` varchar(255) not null,
    `model_id` bigint unsigned not null,
    primary key (`permission_id`, `model_id`, `model_type`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `model_has_permissions`
add index `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`);

alter table `model_has_permissions`
add constraint `model_has_permissions_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade;

create table `model_has_roles` (
    `role_id` bigint unsigned not null,
    `model_type` varchar(255) not null,
    `model_id` bigint unsigned not null,
    primary key (`role_id`, `model_id`, `model_type`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `model_has_roles`
add index `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`);

alter table `model_has_roles`
add constraint `model_has_roles_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade;

create table `role_has_permissions` (
    `permission_id` bigint unsigned not null,
    `role_id` bigint unsigned not null,
    primary key (`permission_id`, `role_id`)
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `role_has_permissions`
add constraint `role_has_permissions_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade;

alter table `role_has_permissions`
add constraint `role_has_permissions_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade;

delete from `cache`
where `key` = 'spatie.permission.cache';

--2024_03_25_022335_create_images_table ......................................
create table `images` (
    `id` bigint unsigned not null auto_increment primary key,
    `url` varchar(255) not null,
    `imageable_id` bigint unsigned not null,
    `imageable_type` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

--2024_03_26_023120_create_categorias_table ..................................
create table `categorias` (
    `id` bigint unsigned not null auto_increment primary key,
    `nombre` varchar(255) not null,
    `descripcion` varchar(255) not null,
    `slug` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

--2024_03_26_023121_create_direcciones_table .................................
create table `direcciones` (
    `id` bigint unsigned not null auto_increment primary key,
    `user_id` bigint unsigned not null,
    `calle` varchar(255) not null,
    `colonia` varchar(255) not null,
    `municipio` varchar(255) not null,
    `estado` varchar(255) not null,
    `num_interior` int null,
    `num_exterior` int not null,
    `codigo_postal` int not null,
    `referencias` varchar(255) not null,
    `entre_calle1` varchar(255) null,
    `entre_calle2` varchar(255) null,
    `latitud` double null,
    `longitud` double null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `direcciones`
add constraint `direcciones_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;

--2024_03_27_174926_create_servicios_table ...................................
create table `servicios` (
    `id` bigint unsigned not null auto_increment primary key,
    `nombre` varchar(255) not null,
    `slug` varchar(255) not null,
    `descripcion` varchar(255) not null,
    `categoria_id` bigint unsigned not null,
    `proveedor_id` bigint unsigned not null,
    `estatus` enum(
        'NUEVA',
        'EN REVISION',
        'ACEPTADA',
        'RECHAZADA',
        'EN PROCESO'
    ) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `servicios`
add constraint `servicios_categoria_id_foreign` foreign key (`categoria_id`) references `categorias` (`id`) on delete cascade;

alter table `servicios`
add constraint `servicios_proveedor_id_foreign` foreign key (`proveedor_id`) references `users` (`id`) on delete cascade;

--2024_03_29_020444_create_solicitudes_table .................................
create table `solicitudes` (
    `id` bigint unsigned not null auto_increment primary key,
    `cliente_id` bigint unsigned not null,
    `servicio_id` bigint unsigned not null,
    `direccion_id` bigint unsigned not null,
    `fecha` date not null,
    `hora` time not null,
    `estatus` enum(
        'NUEVA',
        'EN REVISION',
        'ACEPTADA',
        'RECHAZADA',
        'EN PROCESO',
        'COMPLETADA',
        'CANCELADA'
    ) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `solicitudes`
add constraint `solicitudes_cliente_id_foreign` foreign key (`cliente_id`) references `users` (`id`) on delete cascade;

alter table `solicitudes`
add constraint `solicitudes_servicio_id_foreign` foreign key (`servicio_id`) references `servicios` (`id`) on delete cascade;

alter table `solicitudes`
add constraint `solicitudes_direccion_id_foreign` foreign key (`direccion_id`) references `direcciones` (`id`) on delete cascade;

--2024_04_01_165248_create_valoraciones_table ................................
create table `valoraciones` (
    `id` bigint unsigned not null auto_increment primary key,
    `valoracion` tinyint not null,
    `comentario` varchar(255) not null,
    `user_id` bigint unsigned not null,
    `servicio_id` bigint unsigned not null,
    `created_at` timestamp null,
    `updated_at` timestamp null,
    `estatus` enum('ACTIVA', 'BLOQUEADA', 'REVISION') not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `valoraciones`
add constraint `valoraciones_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;

alter table `valoraciones`
add constraint `valoraciones_servicio_id_foreign` foreign key (`servicio_id`) references `servicios` (`id`) on delete cascade;

--2024_04_06_010853_create_horarios_table ....................................
create table `horarios` (
    `id` bigint unsigned not null auto_increment primary key,
    `proveedor_id` bigint unsigned not null,
    `dia_semana` varchar(255) not null,
    `N` int not null,
    `hora_apertura` time not null,
    `hora_cierre` time not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `horarios`
add constraint `horarios_proveedor_id_foreign` foreign key (`proveedor_id`) references `users` (`id`) on delete cascade;

--2024_04_10_015441_create_notificaciones_table ..............................
create table `notificaciones` (
    `id` bigint unsigned not null auto_increment primary key,
    `user_id` bigint unsigned not null,
    `tipo` enum(
        'solicitud',
        'actualización',
        'recordatorio',
        'mensaje',
        'oferta',
        'alerta',
        'confirmacion',
        'error',
        'aviso'
    ) not null,
    `titulo` varchar(255) not null,
    `mensaje` varchar(255) not null,
    `hora` time not null,
    `fecha` date not null,
    `estatus` enum('leida', 'pendiente', 'no leída', 'archivada') not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `notificaciones`
add constraint `notificaciones_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;

--2024_04_10_024627_create_conversaciones_table ..............................
create table `conversaciones` (
    `id` bigint unsigned not null auto_increment primary key,
    `estatus` enum('activa', 'bloqueada', 'reportada', 'inactiva') not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

--2024_04_10_025133_create_mensajes_table ....................................
create table `mensajes` (
    `id` bigint unsigned not null auto_increment primary key,
    `remitente_id` bigint unsigned not null,
    `conversacion_id` bigint unsigned not null,
    `mensaje` varchar(255) not null,
    `estatus` enum('ENVIADO', 'ENTREGADO', 'LEIDO') not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `mensajes`
add constraint `mensajes_remitente_id_foreign` foreign key (`remitente_id`) references `users` (`id`) on delete cascade;

alter table `mensajes`
add constraint `mensajes_conversacion_id_foreign` foreign key (`conversacion_id`) references `conversaciones` (`id`) on delete cascade;

--2024_04_10_030631_create_reportes_table ....................................
create table `reportes` (
    `id` bigint unsigned not null auto_increment primary key,
    `hora` time not null,
    `fecha` date not null,
    `descripcion` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

--2024_04_29_143922_create_conversacion_user_table ...........................
create table `conversacion_user` (
    `id` bigint unsigned not null auto_increment primary key,
    `conversacion_id` bigint unsigned not null,
    `user_id` bigint unsigned not null,
    `estatus` enum('ACTIVA', 'BLOQUEADA', 'PEPORTADA', 'INACTIVA') not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `conversacion_user`
add constraint `conversacion_user_conversacion_id_foreign` foreign key (`conversacion_id`) references `conversaciones` (`id`) on delete cascade;

alter table `conversacion_user`
add constraint `conversacion_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;

--2024_05_06_045618_create_documentos_table ..................................
create table `documentos` (
    `id` bigint unsigned not null auto_increment primary key,
    `estatus` enum('NUEVA', 'EN REVISION', 'ACEPTADA', 'RECHAZADA') not null,
    `direccion_id` bigint unsigned null,
    `proveedor_id` bigint unsigned not null,
    `url_ine` varchar(255) null,
    `url_domicilio` varchar(255) null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

alter table `documentos`
add constraint `documentos_direccion_id_foreign` foreign key (`direccion_id`) references `direcciones` (`id`) on delete cascade;

alter table `documentos`
add constraint `documentos_proveedor_id_foreign` foreign key (`proveedor_id`) references `users` (`id`) on delete cascade;

--2024_05_12_002526_add_estado_to_categorias_table ...........................
alter table `categorias`
add `estado` tinyint(1) not null default '1';
