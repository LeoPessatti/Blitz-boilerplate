<?php
/*
 * Blitz Framework - Small Framework to PHP
 * Copyright (C) 2016 Fernando Batels <luisfbatels@gmail.com>

 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace blitz\vendor\core;

/**
 * Base Controller
 *
 * @author Fernando Batels <luisfbatels@gmail.com>
 */
abstract class Controller {

    private $inputObj;
    private $inputType;

    /**
     * Start process to safe input data
     * 
     * @param type $type
     */
    protected function inputStart($type) {
        $this->inputObj = new \GUMP();
        $this->inputType = $this->inputObj->sanitize($type);
    }

    /**
     * Get data from request
     */
    protected function inputData() {
        return $this->inputObj->run(\GUMP::xss_clean($this->inputType));
    }

    /**
     * Check if input seted content
     * @return boolean
     */
    protected function inputIsSet() {
        if (isset($this->inputType)) {
            return is_array($this->inputType);
        }
        return false;
    }

    /**
     * Add filter in data from request
     */
    protected function inputAddFilter($rules = []) {
        $this->inputObj->filter_rules($rules);
    }

    /**
     * Add validation
     */
    protected function inputAddValidation($rules = []) {
        $this->inputObj->validation_rules($rules);
    }

    /**
     * Check if exists name session.
     * 
     * This method is public to use in router file
     * 
     * @param type $name
     * @return type
     */
    public static function sessionHas($name) {
        return self::sessionGet($name) !== null;
    }

    /**
     * Get data from session
     * @param type $name
     * @return type
     */
    protected function sessionGet($name) {
        self::auxSession();
        return self::$session->get($name);
    }

    /**
     * Set data in session
     * @param type $name
     * @param type $val
     */
    protected function sessionSet($name, $val) {
        self::auxSession();
        self::$session->set($name, $val);
    }

    /**
     * Destroy session
     */
    protected function sessionDestroy() {
        self::auxSession();
        self::$session->destroy();
    }

    private function auxSession() {
        if (self::$session === null) {
            self::$session = new \Bistro\Session\Native;
        }
    }

    private static $session;

    /**
     * Check if request input is ajax
     * @return boolean
     */
    public static function inputIsAjax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Response request
     */
    public static function output($content, $type = 'text/html', $codeHttp = 200) {
        header('X-Powered-By: Blitz Framework ' . \blitz\vendor\Bootstrap::$version . ' - ' . \blitz\vendor\Bootstrap::$settings['app']['author']);
        header('Expires: max-age=0');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Language: ' . \blitz\vendor\Bootstrap::$settings['locale']);
        header('Server: Blitz Framework');
        if ($type !== null) {
            header("Content-type: {$type}; charset=UTF-8");
        }
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $codeHttp . ' ' . \blitz\vendor\Bootstrap::$settings['http_code_list'][$codeHttp] . ' - Blitz Framework  ' . \blitz\vendor\Bootstrap::$version, true, $codeHttp);
        if ($content !== null) {
            echo $content;
        }
    }

    /**
     * Force download
     * @param type $showName
     * @param type $src
     * @param type $length
     * @param type $extension
     * @param type $contentDispositon
     */
    protected function outputDownload($showName, $src, $length, $extension = 'rar', $contentDispositon = 'attachment') {
        $mt = null;
        foreach (\blitz\vendor\Bootstrap::$settings['mime_types_list'] as $key => $value) {
            if ($value === $extension) {
                $mt = $key;
                break;
            }
        }
        self::output(null, $mt);
        header("Content-Disposition: {$contentDispositon};{$showName}={$src}");
        header("Content-Length: {$length}");
    }

    /**
     * Redirect internal app link
     * @param type $to
     * @param type $params
     */
    protected function redirectInternal($to = 'home', $params = []) {
        self::outputRedirect($to, $params, true);
    }

    /**
     * Redirect alias method
     * @param type $to
     * @param type $params
     */
    protected function redirect($to = 'home', $params = []) {
        $this->redirectInternal($to, $params);
    }

    /**
     * 
     * @param type $to
     * @param type $params
     */
    protected function redirectExternal($to, $params = []) {
        self::outputRedirect($to, $params, false);
    }

    /**
     * This method is public to use in router file
     * 
     * @param type $to
     * @param type $params
     * @param type $internal
     * @param type $code
     */
    public static function outputRedirect($to = 'home', $params = [], $internal = false, $code = 307) {
        self::output(null, null, $code);
        if ($internal) {
            $to = \blitz\vendor\core\helpers\Url::to($to, $params);
        }
        header("Location: {$to}");
    }

    /**
     * 
     * @param type $data
     */
    protected function outputJson($data = []) {
        self::output($this->applyToUrl(json_encode($data)), 'application/json');
    }

    /**
     * 
     * @param type $data
     */
    protected function outputTxt($data = '') {
        self::output($this->applyToUrl($data), 'text/plain');
    }

    /**
     * 
     * @param type $content
     * @return type
     */
    protected function applyToUrl($content) {
        return \blitz\vendor\core\helpers\Url::converterUrl($content);
    }

    /**
     * 
     * @param type $page
     * @param type $data
     */
    protected function outputPage($page = 'home', $data = []) {
        $templates = new \League\Plates\Engine(\blitz\vendor\Bootstrap::$settings['app_src'] . '/views/templates');

        $templates->loadExtension(new \League\Plates\Extension\Asset(\blitz\vendor\Bootstrap::$settings['app_src'] . '/views/assets', true));
        foreach (\blitz\vendor\Bootstrap::$settings['pages_groups'] as $key) {
            $templates->addFolder($key, \blitz\vendor\Bootstrap::$settings['app_src'] . '/views/pages/' . $key . '/');
        }
        self::output($this->applyToUrl($templates->render($page, $data)));
    }

    public function actionIndex() {
        self::output('Hello word :)');
    }

}
