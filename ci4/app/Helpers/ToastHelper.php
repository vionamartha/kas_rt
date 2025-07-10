<?php

if (!function_exists('toast_notify')) {
    /**
     * Simpan pesan toast di session flashdata
     * @param string $message Pesan notifikasi
     * @param string $type Tipe notifikasi: success, error, info, warning
     */
    function toast_notify(string $message, string $type = 'success')
    {
        $session = \Config\Services::session();
        $session->setFlashdata('toast_message', $message);
        $session->setFlashdata('toast_type', $type);
    }
}
