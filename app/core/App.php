<?php
require_once '../app/services/GoogleCalendarService.php';

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $args = [];
        $calendar_service = new GoogleCalendarService([
            'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/calendar',
            'redirect_uri' => CLIENT_REDIRECT_URL,
            'client_id' => CLIENT_ID,
            'client_secret' => CLIENT_SECRET,
            'access_type' => 'offline',
            'response_type' => 'code',
            'prompt' => 'consent',
        ]);
        array_push($args, $calendar_service);
        $url = $this->parseUrl();
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
            // Get new tokens when access token expires
            if ($this->controller !== 'home') {
                if (!isset($_SESSION['access_token']) && !isset($_COOKIE['refresh_token'])) {
                    header('Location: home');
                }
            }
        }
        require_once '../app/controllers/' . $this->controller . '.php';

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $url_params = $url ? array_values($url) : [];
        $this->params = array_merge($args, $url_params);
        try {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (Exception $e) {
            header('Bad Request', true, 400);
            echo json_encode(array('error' => 1, 'message' => $e->getMessage()));
        }
    }

    public function parseUrl()
    {
        $url = strtok(filter_var(trim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL), '?');
        return explode('/', $url);
    }
}
