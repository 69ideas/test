<?php

namespace App\Traits;


use Illuminate\Http\Request;

trait ImageCast
{
    public function _cast_image($val)
    {
        if (starts_with($val, 'http'))
            return $val;
        elseif ($val != null)
            return public_path($val);
        else
            return null;
    }

    public function _cast_image_public($val)
    {
        if (starts_with($val, 'http'))
            return $val;
        elseif ($val != null)
            return '/' . $val;
        else
            return null;
    }

    public function save_image_without_apply($request_field, Request $request, $record_id = '', $table_name = null)
    {
        $file_holder = $request->file($request_field);
        if ($file_holder && $file_holder->isValid()) {
            $new_file_name = str_random() . '.' . $file_holder->getClientOriginalExtension();
            $new_path = array_filter([
                'upload',
                $table_name === null ? $this->getTable() : $table_name,
                $record_id ?: '',
            ], 'mb_strlen');

            $folder_path = implode('/', $new_path);
            $new_path[] = $new_file_name;
            $new_path = implode('/', $new_path);

            if (!\File::exists($folder_path))
                \File::makeDirectory($folder_path, 0775, true);
            $request->file($request_field)->move(public_path($folder_path), $new_file_name);

            return $new_path;
        }
        return null;
    }

    public function replace_image($field, $request_field, Request $request, $record_id = '', $table_name = null)
    {
        $new_path = $this->save_image_without_apply($request_field, $request, $record_id, $table_name);
        if ($new_path !== null) {
            if ($this->$field && !starts_with($this->$field, 'http'))
                unlink($this->$field);

            $this->$field = $new_path;
        }
    }
}