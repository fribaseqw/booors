<?php
/*
Plugin Name: AI Content Pro
Description: Gelişmiş E-E-A-T, MUM, SEO ve özgünlük kontrolü yapan yapay zeka destekli otomatik içerik botu.
Version: 1.0
Author: GPT Dev
*/

// Eklenti dosyalarını dahil et
require_once plugin_dir_path(__FILE__) . 'config.php';
require_once plugin_dir_path(__FILE__) . 'includes/content-generator.php';
require_once plugin_dir_path(__FILE__) . 'includes/keyword-fetcher.php';
require_once plugin_dir_path(__FILE__) . 'includes/title-generator.php';
require_once plugin_dir_path(__FILE__) . 'includes/image-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/plagiarism-checker.php';
require_once plugin_dir_path(__FILE__) . 'includes/post-publisher.php';
require_once plugin_dir_path(__FILE__) . 'includes/logger.php';
require_once plugin_dir_path(__FILE__) . 'includes/schema-generator.php';
require_once plugin_dir_path(__FILE__) . 'includes/internal-linker.php';
require_once plugin_dir_path(__FILE__) . 'includes/reporter.php';
require_once plugin_dir_path(__FILE__) . 'cron/cron-handler.php';

add_filter('cron_schedules', 'ai_content_custom_cron_schedules');
function ai_content_custom_cron_schedules($schedules) {
    $schedules['every_minute'] = array(
        'interval' => 60,
        'display'  => __('Her Dakika')
    );
    return $schedules;
}

function ai_content_cron_event() {
    include plugin_dir_path(__FILE__) . 'cron/orchestrator.php';
}

if (!wp_next_scheduled('ai_content_cron_hook')) {
    wp_schedule_event(time(), 'every_minute', 'ai_content_cron_hook');
}

add_action('ai_content_cron_hook', 'ai_content_cron_event');


?>