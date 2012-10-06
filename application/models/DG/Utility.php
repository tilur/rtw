<?php

namespace DG;

class Utility
{
    public static function massage_form_data($form_data)
    {
        foreach ($form_data AS $key => $data) {
            if (isset($data['name']) && !isset($data['extra']['id'])) {
                $data['extra']['id'] = $data['name'];
            }

            if (!isset($data['name']) && isset($data['extra']['id'])) {
                $data['name'] = $data['extra']['id'];
            }

            if (!isset($data['name']) && !isset($data['extra']['id'])) {
                $data['name'] = $data['extra']['id'] = $key;
            }

            if (!isset($data['selected'])) {
                $data['selected'] = '';
            }

            if (!isset($data['value'])) {
                $data['value'] = '';
            }

            if (!isset($data['extra'])) {
                $data['extra'] = '';
            }

            $form_data[$key] = $data;
        }

        return $form_data;
    }
}