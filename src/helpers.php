<?php

if (! function_exists('asset_url')) {
    /**
     * Get the path to a static file.
     *
     * @param  string  $file
     * @return string
     *
     */
    function asset_url($file)
    {
        return config_item('base_url').'/'.$path;
    }

}



if (! function_exists('elixir')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param  string  $file
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function elixir($file)
    {
        static $manifest = null;

        if (is_null($manifest)) {
            $manifest = json_decode(file_get_contents(FCPATH.'build/rev-manifest.json'), true);
        }

        if (isset($manifest[$file])) {
            return asset_url('build/'.$manifest[$file]);
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}
